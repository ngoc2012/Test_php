<?php
namespace App\Controllers;

require_once __DIR__ . '/../Views/ViewFactory.php';

use App\Views\ViewFactory;

class ViewController {

    /* @var \App\Views\ViewInterface renderer instance */
    protected $view;

    /**
     * Constructor:
     * - Get the renderer instance from ViewFactory
     * @param string $viewType
     * @return void
     */
    public function __construct($viewType = 'smarty') {
        $this->view = ViewFactory::create($viewType);
    }

    /**
     * Render the specified template with data.
     * @param string $template
     * @param array $data Associative array of data to pass to the template
     * @return void
     */
    protected function render($template, $data = []) {
        $this->view->render($template, $data);
    }
}
