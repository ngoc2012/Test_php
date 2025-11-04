<?php
namespace App\Controllers;

require_once __DIR__ . '/../Views/ViewFactory.php';

use App\Views\ViewFactory;

abstract class BaseController
{
    protected $view;

    public function __construct($viewType = 'smarty')
    {
        $this->view = ViewFactory::create($viewType);
    }

    protected function render($template, $data = [])
    {
        $this->view->render($template, $data);
    }
}
