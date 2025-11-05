<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';

use App\Controllers\ViewController;

/**
 * Controller for handling errors pages
 */
class ErrorController extends ViewController {

    /**
     * Display an error message.
     * @param string $message
     * @return void
     */
    public function error($message) {
        $this->render('error.tpl', ['errorMessage' => $message]);
    }
}
