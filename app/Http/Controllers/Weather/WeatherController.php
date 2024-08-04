<?php

namespace App\Http\Controllers\Weather;

use App\Http\Controllers\Controller;
use App\Http\Requests\Weather\CityRequest;
use App\Services\ApiService;


class WeatherController extends Controller
{

    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }
    public function index()
    {
        $languages = [
            'UA',
            'EU',
            'CZ'
        ];
        return view('weather.index', compact('languages'));
    }
    public function getWatherByCity(CityRequest $request)
    {
        try {
            $city = $request->city;
            $lang = $request->lang;
            $weather = $this->apiService->getWeather($city, $lang);
            return view('weather.city', compact('weather', 'city'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
