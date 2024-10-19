<?php

namespace App\Http\Controllers\Facebook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\PostRepositoryInterface;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function redirect()
    {
        $scopes = [
            'pages_show_list',
            'pages_manage_posts',
            'pages_read_engagement',
            'pages_manage_metadata',
            'public_profile',
            'catalog_management'
        ];
        return Socialite::driver('facebook')->scopes($scopes)->redirect();
    }

    public function handleCallback()
    {
        try {
            // Get user from Socialite
            $user = Socialite::driver('facebook')->user();

            // Process the access token through the repository
            $this->postRepository->processAccessToken($user->token);
            // Once tokens are processed, get posts using the repository
            return redirect()->route('facebook.posts');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showPosts()
    {
        try {
            $posts = $this->postRepository->getPosts();

            // Pass posts to the view
            return view('facebook.index', compact('posts'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createPost()
    {
        return view('facebook.create');
    }

    public function storePost(Request $request)
    {
        try {
            // Get the post message from the request
            $message = $request->input('message');

            // Create the post using the repository
            $post = $this->postRepository->createPost($message);

            return response()->json(['success' => true, 'post' => $post]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createPhotos()
    {
        return view('facebook.upload');
    }


}
