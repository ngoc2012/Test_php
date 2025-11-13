<?php
namespace App\Models;

use App\Models\BaseModel;
use App\Core\Database;
use PDOException;
use Exception;
use InvalidArgumentException;

/**
* City model class
*/
class City extends BaseModel {
	
	
	// =================
	// === Variables ===
	// =================
	
	/* @var string city name */
	private $name;
	
	
	// ===================
	// === Constructor ===
	// ===================
	
	/**
	* Constructor
	* @param int $id
	* @param string $name
	*/
	public function __construct($id = null, $name) {
		parent::__construct($id);
		$this->name = $name;
	}
	
	
	// ======================
	// === Public methods ===
	// ======================
	
	public function getName() {
		return $this->name;
	}
	
	/**
	* Encode the city name for URL usage.
	*
	* @return string The URL-encoded city name.
	*/
	public function encodeCityName() {
		return urlencode($this->name);
	}
	
	
	// ===========================
	// === Data access methods ===
	// ===========================
	
	/**
	* Retrieve all history records for this city.
	* 
	* @throws Exception
	* @return History[]
	*/
	public function getHistories() {
		return History::findAllByCityId($this->getId());
	}
	
	/**
	* Retrieve a city by its ID.
	* @param int $id
	* @throws PDOException
	* @throws InvalidArgumentException
	* @return City
	*/
	public static function findById($id) {
		$database = Database::getInstance()->connect();
		$PDOStatement = $database->query("SELECT * FROM city WHERE id = " . $id );
		if (!$PDOStatement) {
			throw new PDOException("Failed to retrieve city from database.");
		}
		$cityData = $PDOStatement->fetch();
		if (!$cityData) {
			throw new InvalidArgumentException("City with ID '$id' not found.");
		}
		return City::transformDataToCity($cityData);
	}
	
	/**
	* Retrieve a city by its name.
	* @param string $name
	* @throws PDOException
	* @throws InvalidArgumentException
	* @return City
	*/
	public static function findByName($name) {
		$database = Database::getInstance()->connect();
		$PDOStatement = $database->prepare("SELECT * FROM city WHERE name = :name");
		$PDOStatement->bindParam(':name', $name, \PDO::PARAM_STR);
		if (!$PDOStatement->execute()) {
			throw new PDOException("Failed to retrieve city from database.");
		}
		$cityData = $PDOStatement->fetch();
		if (!$cityData) {
			throw new InvalidArgumentException("City with name '$name' not found.");
		}
		return City::transformDataToCity($cityData);
	}
	
	/**
	* Retrieve the most recently visited cities.
	* @param int $limit
	* @throws PDOException
	* @return City[]
	*/
	public static function findLastVisitedCities($limit = 10) {
		$database = Database::getInstance()->connect();
		$limit = (int)$limit;
		$sql = "
			SELECT c.*
			FROM city c
			LEFT JOIN history h ON h.cityId = c.id
			GROUP BY c.id
			ORDER BY MAX(h.createdAt) DESC, c.id ASC
			LIMIT $limit;
		";
		$PDOStatement = $database->query($sql);
		if (!$PDOStatement) {
			throw new PDOException('Failed to retrieve city from database.');
		}
		$cityData = $PDOStatement->fetchAll();
		if (!$cityData) {
			return [];
		}
		$cities = [];
		foreach ($cityData as $row) {
			$cities[] = City::transformDataToCity($row);
		}
		return $cities;
	}
	
	/**
	* Save the city to the database.
	* @param string $cityName
	* @throws PDOException
	* @return City
	*/
	public static function save($cityName) {
		$database = Database::getInstance()->connect();
		$PDOStatement = $database->query("INSERT INTO city (name) VALUES (" . $database->quote($cityName) . ")");
		if (!$PDOStatement) {
			throw new PDOException("Failed to save city to database.");
		}
		$cityId = $database->lastInsertId();
		return self::transformDataToCity([
			"id"=> $cityId,
			"name"=> $cityName,
		]);
	}
	
	// ===========
	// === DTO ===
	// ===========
	
	/**
	* Transform data array to City object
	* @param array $data
	* @throws \InvalidArgumentException
	* @return City
	*/
	public static function transformDataToCity($data) {
		if (!is_array($data)) {
			throw new InvalidArgumentException("Data must be an array to transform to City object.");
		}
		if (!isset($data['name'])) {
			throw new InvalidArgumentException("Missing city name to transform to City object.");
		}
		if (isset($data['id']) && !is_numeric($data['id'])) {
			throw new InvalidArgumentException("City ID must be numeric.");
		}
		return new City(
			isset($data['id']) ? (int) $data['id'] : null,
			$data['name']
		);
	}
}
