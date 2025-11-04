<?php
namespace App\Models;

use InvalidArgumentException;

class WeatherMetrics {
    private $temperature;
    private $humidity;

    public function __construct($temperature, $humidity) {
        if (!is_numeric($temperature) || !is_numeric($humidity)) {
            throw new InvalidArgumentException("Temperature and humidity must be numeric.");
        }
        $this->temperature = $temperature;
        $this->humidity = $humidity;
    }

    public function toArray() {
        return [
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
        ];
    }
}
?>
