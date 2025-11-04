<?php
namespace App\Views;

require_once __DIR__ . '/SmartyView.php';


class ViewFactory
{
    public static function create($type = 'smarty')
    {
        switch (strtolower($type)) {
            case 'smarty':
            default:
                return new SmartyView();
        }
    }
}
