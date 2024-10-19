<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function processAccessToken($userToken);

    public function setPageToken($token);

    public function getPageToken();

    public function getPosts();

    public function createPost($data);

    public function deletePost($post_id);

    public function updatePost($id, $content);

    public function uploadImages($imagePaths);
}
