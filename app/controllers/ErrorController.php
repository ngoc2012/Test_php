<?php
namespace App\controllers;

use App\controllers\AbstractViewController;

/**
* Controller for handling errors pages
*/
class ErrorController extends AbstractViewController {


	// =========================
	// === Public Methods ======
	// =========================

	/**
	* Display an error message.
	* @param string $message
	* @return void
	*/
	public function init($message = null) {
		$this->getView()->render('theme.tpl', 'error', [
			'errorMessage' => $message
		]);
	}

}
