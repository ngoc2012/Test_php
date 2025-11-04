<?php
namespace App\Controllers;

require_once __DIR__ . '/../Controllers/BaseController.php';

use App\Controllers\BaseController;

class ErrorController extends BaseController
{
    public function __construct($viewType = 'smarty')
    {
        parent::__construct($viewType);
    }

    public function error($message)
    {
        $this->view->render('error.tpl', ['errorMessage' => $message]);
    }
}
