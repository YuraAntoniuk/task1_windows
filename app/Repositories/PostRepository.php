<?php

namespace App\Repositories;

use App\Repositories\PostRepositoryInterface;

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
        // TODO: Implement setPageToken() method.
    }

    public function getPageToken()
    {
        // TODO: Implement getPageToken() method.
    }

    public function getPosts()
    {
        // TODO: Implement getPosts() method.
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
