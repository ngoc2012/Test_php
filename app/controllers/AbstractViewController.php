<?php
namespace App\controllers;

use App\views\ViewFactory;
use App\views\ViewInterface;

/**
* Base controller class to handle view rendering
*/
abstract class AbstractViewController {


	// =================
	// === Variables ===
	// =================

	/* @var ViewInterface renderer instance */
	private $view;


	// ===================
	// === Constructor ===
	// ===================

	/**
	* Constructor:
	* - Get the renderer instance from ViewFactory
	* @param string $viewType
	* @return void
	*/
	public function __construct($viewType = 'smarty') {
		$this->view = ViewFactory::create($viewType);
	}


	// ========================
	// === Abstract Methods ===
	// ========================

	/**
	* Abstract init method to be implemented by subclasses
	*/
	abstract public function init();


	// =========================
	// === Public Methods ======
	// =========================

	/**
	* View getter
	* @return ViewInterface
	*/
	public function getView() {
		return $this->view;
	}

}
