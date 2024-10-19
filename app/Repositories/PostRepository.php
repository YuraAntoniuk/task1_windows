<?php

namespace App\Repositories;

use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Http;

class PostRepository implements PostRepositoryInterface
{

    protected $base_url;
    protected $page_id;
    protected $app_id;
    protected $secret;
    protected $page_token;

    public function proccesAccessToken($userToken)
    {
        // TODO: Implement proccesAccessToken() method.
    }

    public function __construct()
    {
        $this->base_url = 'https://graph.facebook.com/';
        $this->page_id = config('services.facebook.page_id');
        $this->app_id = config('services.facebook.client_id');
        $this->secret = config('services.facebook.client_secret');
    }

    public function setPageToken($token)
    {
        \Log::info('Setting page token: ' . $token);

        // Store the token in session for persistence
        session(['facebook_page_token' => $token]);

        $this->page_token = $token;
    }

    public function getPageToken()
    {
        if (!$this->page_token) {
            $this->page_token = session('facebook_page_token');

            // If there's still no token, log an error and throw an exception
            if (!$this->page_token) {
                \Log::error('Page token not found');
                throw new \Exception('Page token is missing.');
            }
        }
    }

    public function getPosts()
    {
        $this->getPageToken();

        $url = $this->base_url . $this->page_id . '/posts?access_token=' . $this->page_token;

        $response = Http::get($url);

        $data = json_decode($response->body());

        return $data->data ?? [];
    }

    public function createPost($data, $imagePaths)
    {
        // TODO: Implement createPost() method.
    }

    public function deletePost($id)
    {
        // TODO: Implement deletePost() method.
    }

    public function updatePost($id, $content)
    {
        // TODO: Implement updatePost() method.
    }

    public function uploadImage($imagePaths)
    {
        // TODO: Implement uploadImage() method.
    }
}
