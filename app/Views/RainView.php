<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/rain.tpl.class.php';
require_once __DIR__ . '/ViewInterface.php';

/**
 * Renderer class using RainTPL
 */
class RainView implements ViewInterface {

    /* @var \RainTPL instance */
    protected $tpl;

    /**
     * Constructor and RainTPL configuration
     */
    public function __construct() {
        $baseDir = realpath(__DIR__ . '/../..');

        \RainTPL::configure("base_url", '/');
        \RainTPL::configure("tpl_dir", $baseDir . "/templates/");
        \RainTPL::configure("cache_dir", $baseDir . "/templates_c/");
        \RainTPL::configure("tpl_ext", "tpl");

        $this->tpl = new \RainTPL;
    }

    /**
     * Render a template directly to output.
     *
     * @param string $template Template file name
     * @param array $data Associative array to assign
     * @return void
     */
    public function render($template, array $data = []) {
        $fileNameRaintpl = pathinfo($template, PATHINFO_FILENAME) . '.raintpl';
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }

        // return string from draw()
        $this->tpl->draw($fileNameRaintpl, false);

    }
}
