<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/rain.tpl.class.php';
require_once __DIR__ . '/ViewInterface.php';

use Libs\RainTPL;

class RainView implements ViewInterface
{
    protected $tpl;

    public function __construct()
    {
        $baseDir = realpath(__DIR__ . '/../..');

        RainTPL::configure("base_url", '/');
        // RainTPL::configure("tpl_ext", "tpl");
        RainTPL::configure("tpl_dir", $baseDir . "/templates/");
        RainTPL::configure("cache_dir", $baseDir . "/templates_c/");

        $this->tpl = new RainTPL;
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
            $this->tpl->assign($key, $value);
        }

        $this->tpl->draw($template);
    }
}
