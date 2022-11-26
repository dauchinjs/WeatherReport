<?php declare(strict_types=1);

namespace App\Controllers;

class WeatherReportController extends BaseController
{
    public function index(): string
    {
        $defaultCity = "Riga";
        $city = $this->api()->getLocation($_GET["city"] ?? $defaultCity);
        $weatherReport = $this->api()->getWeather($city);
        return $this->render('index.html.twig', ['weatherReport' => $weatherReport, 'city' => $city]);
    }
}