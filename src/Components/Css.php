<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\View\Component;

/**
 * Class Css
 *
 * @package StoneHilt\Bootstrap\Components
 */
class Css extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): string
    {
        $config = config('stonehilt.bootstrap');

        $hrefs = [];

        if(str_contains($config['css_source'], '://')) {
            $hrefs[] = str_replace(
                '{version}',
                $config['version'],
                $config['css_source']
            );
        } else {
            $hrefs[] = asset('vendor/bootstrap/css/bootstrap.min.css');
        }

        if (isset($config['icons_version'])) {
            if(str_contains($config['icons_source'], '://')) {
                $hrefs[] = str_replace(
                    '{version}',
                    $config['icons_version'],
                    $config['icons_source']
                );
            } else {
                $hrefs[] = asset('vendor/bootstrap/icons/bootstrap-icons.css');
            }
        }

        return implode(
            "\n",
            array_map(
                fn ($href) => sprintf('<link href="%s" rel="stylesheet">', $href),
                $hrefs
            )
        );
    }
}
