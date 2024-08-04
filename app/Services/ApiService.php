<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class ApiService
{

    protected $host;
    protected $apiKey;

    public function __construct()
    {
        $this->host = env('OPEN_WEATHER_API_URL');
        $this->apiKey = env('OPEN_WEATHER_API_KEY');
    }

    public function getWeather($city, $lang)
    {
        $response = Http::withHeaders([
            'X-RapidAPI-Host' => $this->host,
            'X-RapidAPI-Key' => $this->apiKey,
        ])->get('https://' . $this->host . '/city/' . $city . '/' . $lang);

        if ($response->successful()) {
            return $response->json();
        } else {
            return $response->throw();
        }
    }
}
