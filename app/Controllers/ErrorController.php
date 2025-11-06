<?php
namespace App\Controllers;

use App\Controllers\AbstractViewController;

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
        $this->getView()->render('error.tpl', ['errorMessage' => $message]);
    }
}
