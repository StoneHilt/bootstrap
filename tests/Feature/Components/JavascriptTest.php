<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components;

use StoneHilt\Bootstrap\Components\Javascript;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class JavascriptTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components
 */
class JavascriptTest extends FeatureTestCase
{
    /**
     * @return void
     */
    public function test_render()
    {
        $config = config('stonehilt.bootstrap');

        $view = $this->component(Javascript::class, []);

        $view->assertSee(
            str_replace('{version}', $config['version'], $config['js_source']),
            false
        );
    }

    /**
     * @return void
     */
    public function test_render_localUrl()
    {
        $config = [
            'version'   => '1.2.3',
            'js_source' => 'https://localhost/boostrap/{version}/bootstrap.js',
        ];

        config(['stonehilt.bootstrap' => $config]);

        $view = $this->component(Javascript::class, []);

        $view->assertSee(
            str_replace('{version}', $config['version'], $config['js_source']),
            false
        );
    }

    /**
     * @return void
     */
    public function test_render_localPath()
    {
        $config = [
            'version'   => '1.2.3',
            'js_source' => 'vendor/js.css',
        ];

        config(['stonehilt.bootstrap' => $config]);

        $view = $this->component(Javascript::class, []);

        $view->assertSee('http://localhost/vendor/bootstrap/js/bootstrap.bundle.min.js', false);
    }
}