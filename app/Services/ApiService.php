<?php

namespace App\Services;

use GuzzleHttp\Client;
class ApiService
{


    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('api.base_uri'),
        ]);
    }


    public function getUsers($page = 1)
    {
        $response = $this->client->get('users', [
            'query' => ['page' => $page],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getUser($id)
    {
        $response = $this->client->get("users/{$id}");

        return json_decode($response->getBody(), true);
    }

    public function createUser($name, $job)
    {
        $response = $this->client->post('users', [
            'json' => [
                'name' => $name,
                'job' => $job,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function updateUser($id, $name, $job)
    {
        $response = $this->client->put("users/{$id}", [
            'json' => [
                'name' => $name,
                'job' => $job,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    public function deleteUser($id)
    {
        $response = $this->client->delete("users/{$id}");

        return $response->getStatusCode() === 204;
    }

}
