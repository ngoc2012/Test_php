<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/rain.tpl.class.php';

use App\Views\ViewInterface;
use RainTPL;
use Exception;
use RuntimeException;

/**
* Renderer class using RainTPL
*/
class RainView implements ViewInterface {
	
	
	// =================
	// === Variables ===
	// =================
	
	/* @var RainTPL instance */
	private $tpl;
	
	
	// ====================
	// === Constructors ===
	// ====================
	
	/**
	* Constructor and RainTPL configuration
	*/
	public function __construct() {
		
		RainTPL::configure("base_url", '/');
		RainTPL::configure("tpl_dir", __DIR__ . "/../../templates/");
		RainTPL::configure("cache_dir", __DIR__ . "/../../templates_c/");
		RainTPL::configure("tpl_ext", "tpl");
		
		$this->tpl = new RainTPL;
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
		$fileNameRaintpl = pathinfo($theme, PATHINFO_FILENAME) . '.raintpl';
		$this->tpl->assign("container", $container . '.raintpl');
		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}
		try {
			$this->tpl->draw($fileNameRaintpl, false);
		} catch (Exception $e) {
			throw new RuntimeException("Failed to render template: " . $e->getMessage());
		}
	}
}
