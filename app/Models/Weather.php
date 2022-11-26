<?php declare(strict_types=1);

namespace App\Models;

class Weather
{
    private float $temperature;
    private string $weatherDescription;
    private float $windSpeed;

    public function __construct(float $temperature, string $weatherDescription, float $windSpeed)
    {
        $this->temperature = $temperature;
        $this->weatherDescription = $weatherDescription;
        $this->windSpeed = $windSpeed;
    }

    public function getTemperature(): ?float
    {
        return $this->temperature;
    }

    public function getWeatherDescription(): string
    {
        return $this->weatherDescription;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }
}
