<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\View\Component;

/**
 * Class Javascript
 *
 * @package StoneHilt\Bootstrap\Components
 */
class Javascript extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): string
    {
        $config = config('stonehilt.bootstrap');

        if(str_contains($config['js_source'], '://')) {
            $src = str_replace(
                '{version}',
                $config['version'],
                $config['js_source']
            );
        } else {
            $src = asset('vendor/bootstrap/js/bootstrap.bundle.min.js');
        }

        return sprintf(
            '<script src="%s"></script>',
            $src
        );
    }
}
