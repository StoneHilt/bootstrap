<?php

return [

    'version' => '5.3.3',

    // Null disables the bootstrap icons
    'icons_version' => '1.11.3',

    /**
     * CSS Source
     * Either
     *  url  => embed with "{version}" replaced with version above
     *  path => file path where CSS files can be pulled and published into vendor/bootstrap/css
     *
     * Default: https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist/css/bootstrap.min.css
     */
    'css_source' => 'https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist/css/bootstrap.min.css',

    /**
     * JavaScript Source
     * Either
     *  url  => embed with "{version}" replaced with version above
     *  path => file path where JS files can be pulled and published into vendor/bootstrap/js
     *
     * Default: https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist/js/bootstrap.bundle.min.js
     */
    'js_source' => 'https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist/js/bootstrap.bundle.min.js',

    /**
     * Icons Source
     * Either
     *  null => disables usage of icons
     *  url  => embed with "{version}" replaced with version above
     *  path => file path where Icon CSS files can be pulled and published into vendor/bootstrap/icons
     *
     * Default: https://cdn.jsdelivr.net/npm/bootstrap-icons@{version}/font/bootstrap-icons.min.css
     */
    'icons_source' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@{version}/font/bootstrap-icons.min.css',
];
