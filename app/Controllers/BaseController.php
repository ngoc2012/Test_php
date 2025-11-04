<?php
namespace App\Controllers;

require_once __DIR__ . '/../Core/Database.php';
require_once __DIR__ . '/../Views/ViewFactory.php';

use App\Core\Database;
use App\Views\ViewFactory;

abstract class BaseController
{
    protected $view;
    protected $pdo;

    public function __construct($viewType = 'smarty')
    {
        $this->view = ViewFactory::create($viewType);

        try {
            $this->pdo = Database::getInstance()->connect();
        } catch (Exception $e) {
            error_log($e->getMessage());
            $this->view->render('error.tpl', ['error_message' => 'Sorry, something went wrong with the database: ' . $e->getMessage()]);
            // Stop further execution
            exit;
        }
    }

    protected function render($template, $data = [])
    {
        $this->view->render($template, $data);
    }
}
