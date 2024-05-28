<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ListGroupTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class ListGroupTest extends FeatureTestCase
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
        $providerData = [];

        foreach (['component.list-group.simple', 'component.list-group.simple_slots'] as $view) {
            $providerData[] = [
                'view' => $view,
                'data' => [
                    'items' => [
                        'First',
                        'Second',
                        'Third'
                    ],
                ],
                'expects' => [
                    '<ul class="list-group">',
                    '<li class="list-group-item">First</li>',
                    '<li class="list-group-item">Second</li>',
                    '<li class="list-group-item">Third</li>',
                    '</ul>',
                ],
            ];
        }

        $providerData[] = [
            'view' => 'component.list-group.numbered',
            'data' => [
                'items' => [
                    'First',
                    'Second',
                    'Third'
                ],
            ],
            'expects' => [
                '<ul class="list-group list-group-numbered">',
                '<li class="list-group-item">First</li>',
                '<li class="list-group-item">Second</li>',
                '<li class="list-group-item">Third</li>',
                '</ul>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.list-group.type_ol',
            'data' => [
                'items' => [
                    'First',
                    'Second',
                    'Third'
                ],
            ],
            'expects' => [
                '<ol class="list-group list-group-numbered">',
                '<li class="list-group-item">First</li>',
                '<li class="list-group-item">Second</li>',
                '<li class="list-group-item">Third</li>',
                '</ol>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.list-group.type_button',
            'data' => [
                'items' => [
                    'First',
                    'Second',
                    'Third'
                ],
            ],
            'expects' => [
                '<div class="list-group">',
                '<button class="list-group-item" type="button">First</button>',
                '<button class="list-group-item" type="button">Second</button>',
                '<button class="list-group-item" type="button">Third</button>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.list-group.type_a',
            'data' => [
                'items' => [
                    'First',
                    'Second',
                    'Third'
                ],
            ],
            'expects' => [
                '<div class="list-group">',
                '<a class="list-group-item" href="#">First</a>',
                '<a class="list-group-item" href="#">Second</a>',
                '<a class="list-group-item" href="#">Third</a>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.list-group.type_a_with_href',
            'data' => [
                'items' => [
                    ['href' => 'http://example.com/first', 'id' => 'first-item', 'html' => 'First'],
                    ['href' => '/second', 'id' => 'second-item', 'html' => 'Second'],
                    ['href' => 'https://sub.example.com/third', 'id' => 'third-item', 'html' => 'Third'],
                ],
            ],
            'expects' => [
                '<div class="list-group">',
                '<a class="list-group-item" href="http://example.com/first" id="first-item">First</a>',
                '<a class="list-group-item" href="/second" id="second-item">Second</a>',
                '<a class="list-group-item" href="https://sub.example.com/third" id="third-item">Third</a>',
                '</div>',
            ],
        ];

        foreach (['checkbox', 'radio'] as $type) {
            $providerData[] = [
                'view' => sprintf('component.list-group.type_%s', $type),
                'data' => [
                    'items' => [
                        'input-a' => 'First',
                        'input-b' => 'Second',
                        'input-c' => 'Third'
                    ],
                ],
                'expects' => [
                    '<ul class="list-group">',
                    '<li class="list-group-item">',
                    sprintf('<input type="%s" class="form-check-input me-1" id="input-a">', $type),
                    '<label class="form-check-label" for="input-a">First</label>',
                    '</li>',
                    '<li class="list-group-item">',
                    sprintf('<input type="%s" class="form-check-input me-1" id="input-b">', $type),
                    '<label class="form-check-label" for="input-b">Second</label>',
                    '</li>',
                    '<li class="list-group-item">',
                    sprintf('<input type="%s" class="form-check-input me-1" id="input-c">', $type),
                    '<label class="form-check-label" for="input-c">Third</label>',
                    '</li>',
                    '</ul>',
                ],
            ];
        }

        return $providerData;
    }
}