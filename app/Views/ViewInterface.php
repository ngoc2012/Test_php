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
     * Render a template with a theme.
     *
     * @param string $theme Theme template file name
     * @param array $data Variables to assign
     * @return void
     */
    public function render($theme, array $data = []);
}
