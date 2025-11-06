<?php
namespace App\Controllers;

use App\Views\ViewFactory;

/**
 * Interface for all view controllers.
 */
interface ViewControllerInterface {
    public function index();
}

/**
 * Base controller class to handle view rendering
 */
abstract class ViewController implements ViewControllerInterface {

    /* @var App\Views\ViewInterface renderer instance */
    private $view;

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
