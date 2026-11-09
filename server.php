<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * This file allows us to emulate Apache's "mod_rewrite" functionality from the
 * built-in PHP web server. This provides a convenient way to test a Laravel
 * application without having installed a "real" web server software here.
 */

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server.
$public = realpath(__DIR__.'/public');
$file = realpath($public.$uri);

if ($file !== false && str_starts_with($file, $public.DIRECTORY_SEPARATOR) && is_file($file)) {
    if (realpath($_SERVER['DOCUMENT_ROOT'].$uri) === $file) {
        return false;
    }

    $contentType = match (pathinfo($file, PATHINFO_EXTENSION)) {
        'css' => 'text/css',
        'js' => 'text/javascript',
        'png' => 'image/png',
        default => null,
    };

    $assetPath = '~^/(?:build/assets|vendor/adminlte/dist/(?:css|js|assets/img))/[\w.-]+$~D';
    if ($contentType !== null && ($uri === '/logo-its.png' || preg_match($assetPath, $uri))) {
        header('Content-Type: '.$contentType);
        readfile($file);
        return true;
    }
}

require_once __DIR__.'/public/index.php';

