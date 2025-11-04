<?php
namespace App\Controllers;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/ViewController.php';
require_once __DIR__ . '/ErrorController.php';

use App\Core\Database;
use Exception;

class BaseController extends ViewController
{
    protected $pdo;

    /**
     * Constructor:
     * - Connect to database
     * @param string $viewType
     */
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);

        try {
            $this->pdo = Database::getInstance()->connect();
        } catch (Exception $e) {
            (new ErrorController())->error($e->getMessage());
            exit;
        }
    }
}
