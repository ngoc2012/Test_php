<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/smarty/Smarty.class.php';
require_once __DIR__ . '/ViewInterface.php';

use Smarty;

/**
 * Renderer class using Smarty
 */
class SmartyView implements ViewInterface
{
    /* @var Smarty instance */
    protected $smarty;

    /**
     * Constructor and Smarty configuration
     */
    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $this->smarty->setCompileDir(__DIR__ . '/../../templates_c/');
    }

    /**
     * Render a template directly to output.
     *
     * @param string $template Template file name
     * @param array $data Associative array to assign
     * @return void
     */
    public function render($template, array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        $this->smarty->display($template);
    }
}
