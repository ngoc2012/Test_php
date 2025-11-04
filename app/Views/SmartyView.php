<?php
namespace App\Views;

require_once __DIR__ . '/../../smarty-libs/Smarty.class.php';
require_once __DIR__ . '/ViewInterface.php';

use Smarty;

class SmartyView implements ViewInterface
{
    protected $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $this->smarty->setCompileDir(__DIR__ . '/../../templates_c/');
        $this->smarty->setCacheDir(__DIR__ . '/../../cache/');
        $this->smarty->setConfigDir(__DIR__ . '/../../config/');
    }

    public function render($template, array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->display($template);
    }

    public function fetch($template, array $data = array())
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return $this->smarty->fetch($template);
    }
}
