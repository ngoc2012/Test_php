<?php
namespace App\Models;

require_once __DIR__ . '/City.php';

use App\Models\City;

class CitiesList {
    private $cities = [];

    /**
     * Set the list of cities.
     *
     * @param array $data An array of city data.
     */
    public function setCities(array $data) {
        foreach ($data as $item) {
            $city = new City(
                $item['id'],
                $item['name'],
                $item['country'],
                $item['latitude'],
                $item['longitude']
            );
            $this->cities[] = $city;
        }
    }

    /**
     * Get the list of cities as an array.
     *
     * @return array An array of cities.
     */
    public function toArray() {
        $cities = [];
        foreach ($this->cities as $city) {
            $cities[] = [
                'id' => $city->getId(),
                'name' => $city->getName(),
                'country' => $city->getCountry(),
                'latitude' => $city->getLatitude(),
                'longitude' => $city->getLongitude()
            ];
        }
        return $cities;
    }
}
?>