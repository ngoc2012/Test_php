<?php
namespace App\Models;

class City {
    private $id;
    private $name;
    private $country;
    private $latitude;
    private $longitude;

    public function __construct($id, $name, $country, $latitude, $longitude) {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getCountry() {
        return $this->country;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }
}
?>