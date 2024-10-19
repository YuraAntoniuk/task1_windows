<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function processAccessToken($userToken);

    public function setPageToken($token);

    public function getPageToken();

    public function getPosts();

    public function createPost($data,$imagePaths);

    public function deletePost($id);

    public function updatePost($id, $content);

    public function uploadImage($imagePaths);
}
