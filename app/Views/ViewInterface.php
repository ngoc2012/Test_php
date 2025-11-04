<?php
namespace App\Views;

interface ViewInterface
{
    /**
     * Render a template directly to output.
     *
     * @param string $template Template file name
     * @param array $data Variables to assign
     * @return void
     */
    public function render($template, array $data = []);
}
