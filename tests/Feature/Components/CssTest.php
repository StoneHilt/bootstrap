<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components;

use StoneHilt\Bootstrap\Components\Css;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class CssTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components
 */
class CssTest extends FeatureTestCase
{
    /**
     * @return void
     */
    public function test_render()
    {
        $config = config('stonehilt.bootstrap');

        $view = $this->component(Css::class, []);

        $view->assertSee(
            str_replace('{version}', $config['version'], $config['css_source']),
            false
        );

        $view->assertSee(
            str_replace('{version}', $config['icons_version'], $config['icons_source']),
            false
        );
    }

    /**
     * @return void
     */
    public function test_render_localUrl()
    {
        $config = [
            'version'       => '1.2.3',
            'icons_version' => '2.3.4',
            'css_source'    => 'https://localhost/boostrap/{version}/bootstrap.css',
            'icons_source'  => 'https://localhost/boostrap/{version}/icons.css',
        ];

        config(['stonehilt.bootstrap' => $config]);

        $view = $this->component(Css::class, []);

        $view->assertSee(
            str_replace('{version}', $config['version'], $config['css_source']),
            false
        );

        $view->assertSee(
            str_replace('{version}', $config['icons_version'], $config['icons_source']),
            false
        );
    }

    /**
     * @return void
     */
    public function test_render_localPath()
    {
        $config = [
            'version'       => '1.2.3',
            'icons_version' => '2.3.4',
            'css_source'    => 'vendor/bootstrap.css',
            'icons_source'  => 'vendor/icons.css',
        ];

        config(['stonehilt.bootstrap' => $config]);

        $view = $this->component(Css::class, []);

        $view->assertSee('http://localhost/vendor/bootstrap/css/bootstrap.min.css', false);
        $view->assertSee('http://localhost/vendor/bootstrap/icons/bootstrap-icons.css', false);
    }
}