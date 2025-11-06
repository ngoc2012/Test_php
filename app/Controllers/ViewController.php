<?php
namespace App\Controllers;

use App\Views\ViewFactory;
use App\Views\ViewInterface;

/**
 * Base controller class to handle view rendering
 */
abstract class ViewController {

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
     * Abstract index method to be implemented by subclasses
     */
    abstract public function index();

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
