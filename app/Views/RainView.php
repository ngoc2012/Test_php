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

        RainTPL::configure("base_url", '/');
        RainTPL::configure("tpl_dir", __DIR__ . "/../../templates/");
        RainTPL::configure("cache_dir", __DIR__ . "/../../templates_c/");
        RainTPL::configure("tpl_ext", "tpl");

        $this->tpl = new RainTPL;
    }


    // ======================
    // === Public methods ===
    // ======================
    
    /**
     * Render a container to default template directly to output.
     *
     * @param string $template Template file name
     * @param string $container container content
     * @return void
     */
    public function render_main($template, $container) {
        $fileNameRaintpl = pathinfo($template, PATHINFO_FILENAME) . '.raintpl';
        try {
            $this->tpl->assign("container", $container);
            $this->tpl->draw($fileNameRaintpl, false);
        } catch (Exception $e) {
            throw new RuntimeException("Failed to render template: " . $e->getMessage());
        }
    }

    /**
     * Fetch a template directly to output.
     *
     * @param string $template Template file name
     * @param array $data Associative array to assign
     * @return string
     */
    public function fetch($template, array $data = []) {
        $fileNameRaintpl = pathinfo($template, PATHINFO_FILENAME) . '.raintpl';
        foreach ($data as $key => $value) {
            $this->tpl->assign($key, $value);
        }
        try {
            $content = $this->tpl->draw($fileNameRaintpl, true);
            return $content;

        } catch (Exception $e) {
            throw new RuntimeException("Failed to render template: " . $e->getMessage());
        }
    }
}
