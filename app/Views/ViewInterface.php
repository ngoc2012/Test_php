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
    public function render($template, array $data = array());

    /**
     * Fetch a rendered template as a string.
     *
     * @param string $template Template file name
     * @param array $data Variables to assign
     * @return string Rendered HTML
     */
    public function fetch($template, array $data = array());
}
