<?php

namespace App\Services;

use App\Repositories\PostRepositoryInterface;
use App\Repositories\PostRepository;

class PostService
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function redirectUser(){
        return $this->postRepository->redirectUser();
    }

    public function handleCallback(){
        return $this->postRepository->handleCallback();
    }

    public function setPageToken($token)
    {
        return $this->postRepository->setPageToken($token);
    }

    public function getPosts(){
        return $this->postRepository->getPosts();
    }

    public function deletePost($id){
        return $this->postRepository->deletePost($id);
    }

}
