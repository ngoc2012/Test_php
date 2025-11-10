<?php
namespace App\Views;

/**
 * Interface for abstract methods of renderers
 */
interface ViewInterface
{
    // ======================
    // === Public Methods ===
    // ======================
    
    /**
     * Render a container to default template directly to output.
     *
     * @param string $template Template file name
     * @param string $container container content
     * @return void
     */
    public function render_main($template, $container);

    /**
     * Render a template to string.
     *
     * @param string $template Template file name
     * @param array $data Variables to assign
     * @return string
     */
    public function fetch($template, array $data = []);
}
