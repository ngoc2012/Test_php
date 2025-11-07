<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/rain.tpl.class.php';

use App\Views\ViewInterface;
use RainTPL;
use Exception;
use RuntimeException;

/**
 * Renderer class using RainTPL
 */
class RainView implements ViewInterface {


    // =================
    // === Variables ===
    // =================

    /* @var RainTPL instance */
    private $tpl;


    // ====================
    // === Constructors ===
    // ====================

    /**
     * Constructor and RainTPL configuration
     */
    public function __construct() {
        $baseDir = realpath(__DIR__ . '/../..');

        RainTPL::configure("base_url", '/');
        RainTPL::configure("tpl_dir", $baseDir . "/templates/");
        RainTPL::configure("cache_dir", $baseDir . "/templates_c/");
        RainTPL::configure("tpl_ext", "tpl");

        $this->tpl = new RainTPL;
    }


    // ======================
    // === Public methods ===
    // ======================
    
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

        try {
            $this->tpl->draw($fileNameRaintpl, false);
        } catch (Exception $e) {
            throw new RuntimeException("Failed to render template: " . $e->getMessage());
        }
    }
}
