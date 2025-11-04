<?php
namespace App\Views;

require_once __DIR__ . '/SmartyView.php';


class ViewFactory
{
    public static function create($type = 'smarty')
    {
        switch (strtolower($type)) {
            case 'smarty':
                return new SmartyView();
            default:
                error_log("Unknown view type: $type. Defaulting to SmartyView.");
                return new SmartyView();
        }
    }
}
