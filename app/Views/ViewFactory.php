<?php
namespace App\Views;

class ViewFactory
{
    public static function create($type = 'smarty')
    {
        switch (strtolower($type)) {
            case 'smarty':
                require_once __DIR__ . '/SmartyView.php';
                return new SmartyView();
            case 'raintpl':
                require_once __DIR__ . '/RainView.php';
                return new RainView();
            default:
                error_log("Unknown view type: $type. Defaulting to SmartyView.");
                return new SmartyView();
        }
    }
}
