<?php
namespace App\Controllers;

require_once __DIR__ . '/../Views/ViewFactory.php';

use App\Views\ViewFactory;

class ViewController
{
    protected $view;

    /**
     * Constructor:
     * - Get the renderer
     * - Connect to database
     * @param mixed $viewType
     */
    public function __construct($viewType = 'smarty')
    {
        $this->view = ViewFactory::create($viewType);
    }

    protected function render($template, $data = [])
    {
        $this->view->render($template, $data);
    }
}
