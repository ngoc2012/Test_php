<?php
namespace App\Views;

require_once __DIR__ . '/SmartyView.php';
require_once __DIR__ . '/RainView.php';

class ViewFactory
{
    public static function create($type = 'smarty')
    {
        switch (strtolower($type)) {
            case 'smarty':
                return new SmartyView();
            case 'raintpl':
                return new RainView();
            default:
                error_log("Unknown view type: $type. Defaulting to SmartyView.");
                return new SmartyView();
        }
    }
}
