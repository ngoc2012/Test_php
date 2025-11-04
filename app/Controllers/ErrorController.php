<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/ViewController.php';

use App\Controllers\ViewController;

class ErrorController extends ViewController
{
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);
    }

    /**
     * Display an error message.
     * @param string $message
     * @return void
     */
    public function error($message)
    {
        $this->render('error.tpl', ['errorMessage' => $message]);
    }
}
