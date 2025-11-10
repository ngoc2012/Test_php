<?php
namespace App\Views;

require_once __DIR__ . '/../../libs/smarty/Smarty.class.php';

use App\Views\ViewInterface;
use Smarty;
use Exception;
use RuntimeException;

/**
 * Renderer class using Smarty
 */
class SmartyView implements ViewInterface {


    // =================
    // === Variables ===
    // =================

    /* @var Smarty instance */
    private $smarty;


    // ====================
    // === Constructors ===
    // ====================

    /**
     * Constructor and Smarty configuration
     */
    public function __construct() {
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(__DIR__ . '/../../templates/');
        $this->smarty->setCompileDir(__DIR__ . '/../../templates_c/');
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
        try {
            $this->smarty->assign("container", $container);
            $this->smarty->display($template);
        } catch (Exception $e) {
            throw new RuntimeException("Failed to render template: " . $e->getMessage());
        }
    }

    /**
     * Fetch a template directly to string.
     *
     * @param string $template Template file name
     * @param array $data Associative array to assign
     * @return string
     */
    public function fetch($template, array $data = []) {
        foreach ($data as $key => $value) {
            $this->smarty->assign($key, $value);
        }
        try {
            return $this->smarty->fetch($template);
        } catch (Exception $e) {
            throw new RuntimeException("Failed to render template: " . $e->getMessage());
        }
    }
}
