<?php declare(strict_types=1);

namespace App;

use App\Models\Location;
use App\Models\Weather;
use GuzzleHttp\Client;

class Api
{
    private string $apiKey;
    private Client $client;
    private const API_URL = "http://api.openweathermap.org/";

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function getLocation($city): ?Location
    {
        $response = $this->client->request('GET', self::API_URL . "/geo/1.0/direct?q=$city&limit=1&appid=$this->apiKey");
        $response = json_decode($response->getBody()->getContents(), true);
        if (!$response) {
            return null;
        }
        return new Location(
            $response[0]["name"],
            $response[0]["lat"],
            $response[0]["lon"]
        );
    }

    public function getWeather(Location $city): ?Weather
    {
        $response = $this->client->request('GET', self::API_URL . "/data/2.5/weather?lat={$city->getLatitude()}&lon={$city->getLongitude()}&appid=$this->apiKey&units=metric");
        $response = json_decode($response->getBody()->getContents(), true);
        if (!$response) {
            return null;
        }
        return new Weather(
            $response["main"]["temp"],
            $response["weather"][0]["description"],
            $response["wind"]["speed"],
        );
    }
}