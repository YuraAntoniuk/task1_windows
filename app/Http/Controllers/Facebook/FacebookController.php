<?php

namespace App\Http\Controllers\Facebook;

use Illuminate\Http\Request;
use App\Repositories\PostRepositoryInterface;

class FacebookController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function createPost(Request $request)
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
}
