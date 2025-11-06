<?php
namespace App\Controllers;

use App\Views\ViewFactory;
use App\Views\ViewInterface;

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

    /* @var ViewInterface renderer instance */
    private $view;

    /**
     * View getter
     * @return ViewInterface
     */
    public function getView() {
        return $this->view;
    }

    /**
     * Constructor:
     * - Get the renderer instance from ViewFactory
     * @param string $viewType
     * @return void
     */
    public function __construct($viewType = 'smarty') {
        $this->view = ViewFactory::create($viewType);
    }
}
