<?php
namespace App\views;

require_once __DIR__ . '/../../libs/smarty/Smarty.class.php';

use App\views\ViewInterface;
use Smarty;
use Exception;
use RuntimeException;

/**
* Renderer class using Smarty
*/
class SmartyView implements ViewInterface {


	// =================
	// === Variables ===
	// =================

	/* @var Smarty instance */
	private $smarty;


	// ====================
	// === Constructors ===
	// ====================

	/**
	* Constructor and Smarty configuration
	*/
	public function __construct() {
		$this->smarty = new Smarty();
		$this->smarty->setTemplateDir(__DIR__ . '/../../templates/');
		$this->smarty->setCompileDir(__DIR__ . '/../../templates_c/');
	}


	// ======================
	// === Public methods ===
	// ======================

	/**
	* Render a template with a theme.
	*
	* @param string $theme Theme template file name
	* @param string $container Container template file name
	* @param array $data Variables to assign
	* @return void
	*/
	public function render($theme, $container, array $data = []) {
		$this->smarty->assign("container", $container);
		foreach ($data as $key => $value) {
			$this->smarty->assign($key, $value);
		}
		try {
			$this->smarty->display($theme);
		} catch (Exception $e) {
			throw new RuntimeException("Failed to render template: " . $e->getMessage());
		}
	}
}
