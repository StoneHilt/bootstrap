<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class NavbarTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class NavbarTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_view
     * @param string $view
     * @param array $data
     * @param array $expects
     * @return void
     */
    public function test_view(string $view, array $data, array $expects)
    {
        $this->viewOnlySees($this->view($view, $data), $expects, false);
    }

    /**
     * @return array[]
     */
    public static function provider_view(): array
    {
        return [
            [
                'view' => 'component.navbar.collapse_left_right',
                'data' => [
                ],
                'expects' => [
                    '<nav class="navbar navbar-expand-lg bg-body-tertiary">',
                    '<div class="container-fluid">',
                    '<span class="navbar-brand mb-0 h1">StoneHilt</span>',
                    '<div class="collapse navbar-collapse" id="testCollapse">',
                    '<ul class="navbar-nav me-auto mb-2 mb-lg-0">',
                    '<li class="nav-item">',
                    '<a aria-current="page" class="nav-link" href="#">Link 1</a>',
                    '</li>',
                    '<li class="nav-item">',
                    '<a aria-current="page" class="nav-link" href="#">Link 2</a>',
                    '</li>',
                    '<li class="nav-item dropdown">',
                    '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">',
                    'Dropdown',
                    '</a>',
                    '<ul class="dropdown-menu">',
                    '<li><a class="dropdown-item" href="#">Action</a></li>',
                    '<li><a class="dropdown-item" href="#">Another action</a></li>',
                    '<li><hr class="dropdown-divider"></li>',
                    '<li><a class="dropdown-item" href="#">Something else here</a></li>',
                    '</ul>',
                    '</li>',
                    '</ul>',
                    'The Collapse',
                    '</div>',
                    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#testCollapse" aria-controls="testCollapse" aria-label="">',
                    '<span class="navbar-toggler-icon"></span>',
                    '</button>',
                    '</div>',
                    '</nav>',
                ],
            ],
        ];
    }
}