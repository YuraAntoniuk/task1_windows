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

    public function __construct()
    {
        $this->base_url = 'https://graph.facebook.com/v21.0/';
        $this->page_id = config('services.facebook.page_id');
        $this->app_id = config('services.facebook.client_id');
        $this->secret = config('services.facebook.client_secret');
    }
    public function processAccessToken($userToken)
    {
        $long_lived_user_token_url = $this->base_url.'oauth/access_token?grant_type=fb_exchange_token&client_id='.$this->app_id.'&client_secret='.$this->secret.'&fb_exchange_token='.$userToken;

        $user_token_response = Http::get($long_lived_user_token_url);

        if (!$user_token_response->successful()) {
            \Log::error('Error retrieving long-lived user token: ' . $user_token_response->body());
            throw new \Exception('Error retrieving long-lived user token');
        }

        $user_token_response = $user_token_response->json();

        // Get page token
        $page_token_url = $this->base_url.$this->page_id.'?fields=access_token&access_token='.$user_token_response['access_token'];

        $page_token_response = Http::get($page_token_url);

        if (!$page_token_response->successful()) {
            \Log::error('Error retrieving page token: ' . $page_token_response->body());
            throw new \Exception('Error retrieving page token');
        }

        $page_token_response = $page_token_response->json();

        // Set and return the page token
        $this->setPageToken($page_token_response['access_token']);

        return $this->page_token;
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
        $url = $this->base_url.$this->page_id.'/posts?access_token='.$this->page_token;

        $response = Http::get($url);

        $data = json_decode($response->body());
        return $data->data ?? [];
    }

    public function createPost($data, $imagePaths)
    {

        $this->getPageToken();
        $url = $this->base_url . $this->page_id . '/feed';

        // Prepare the payload (the post content)
        $payload = [
            'message' => $data,          // The post message
            'access_token' => $this->page_token  // Page token for authorization
        ];

        // Send POST request to Facebook API to create the post
        $response = Http::post($url, $payload);

        // Handle the response and return
        if ($response->successful()) {
            return $response->json();
        } else {
            \Log::error('Error creating Facebook post: ' . $response->body());
            throw new \Exception('Failed to create post: ' . $response->body());
        }
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
