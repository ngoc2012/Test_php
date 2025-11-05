<?php
spl_autoload_register(function ($className) {
    // Replace namespace separators with slashes
    $classPath = str_replace('\\', '/', $className);

    // Base directories for different namespaces
    $roots = [
        'App'    => dirname(__DIR__) . '/app',                // app/
        'Config' => dirname(__DIR__) . '/config',  // config/
    ];

    foreach ($roots as $namespace => $baseDir) {
        if (strpos($classPath, $namespace . '/') === 0) {
            $relativePath = substr($classPath, strlen($namespace) + 1);
            $file = $baseDir . '/' . $relativePath . '.php';

            if (file_exists($file)) {
                require_once $file;
                return;
            }
        }
    }

    // Optional: log failed autoloads for debugging
    error_log("Autoload failed for class: $className");
});
