<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use Illuminate\Support\HtmlString;
use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Dropdown;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class DropdownTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class DropdownTest extends FeatureTestCase
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

        $providerData[] = [
            'view' => 'component.dropdown.simple',
            'data' => [
                'label' => 'Demo Dropdown',
                'items' => [
                    new HtmlString('<li>First</li>'),
                    new HtmlString('<li>Second</li>'),
                    new HtmlString('<li>Third</li>'),
                ],
            ],
            'expects' => [
                '<div class="dropdown">',
                '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Demo Dropdown</button>',
                '<ul class="dropdown-menu">',
                '<li>First</li>',
                '<li>Second</li>',
                '<li>Third</li>',
                '</ul>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.dropdown.simple_slots',
            'data' => [
                'label' => 'Demo Dropdown',
                'items' => [
                    'First',
                    'Second',
                    'Third'
                ],
            ],
            'expects' => [
                '<div class="dropdown">',
                '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Demo Dropdown</button>',
                '<ul class="dropdown-menu">',
                '<li>',
                '<button class="dropdown-item" type="button">',
                'First',
                '</button>',
                '</li>',
                '<li>',
                '<button class="dropdown-item" type="button">',
                'Second',
                '</button>',
                '</li>',
                '<li>',
                '<button class="dropdown-item" type="button">',
                'Third',
                '</button>',
                '</li>',
                '</ul>',
                '</div>',
            ],
        ];

        return $providerData;
    }

    /**
     * @dataProvider provider_render
     * @param string $label
     * @param string|null $variant
     * @param array|null $items
     * @param string|null $direction
     * @param array|null $attributes
     * @param array $expectedParts
     * @return void
     * @throws Exception
     */
    public function test_render(
        string $label,
        ?string $variant,
        ?string $size = null,
        ?array $items,
        ?string $direction,
        ?array $attributes,
        array $expectedParts,
    ) {
        $view = $this->nullSafeComponent(
            Dropdown::class,
            [
                'label'     => $label,
                'variant'   => $variant,
                'size'      => $size,
                'items'     => $items,
                'direction' => $direction,
            ],
            $attributes
        );

        $this->componentOnlySees($view, $expectedParts, false);
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {
        $faker = static::faker();
        $label = $faker->words(3, true);

        $providerData = [
            [
                'label'         => $label,
                'variant'       => null,
                'size'          => null,
                'items'         => null,
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '</ul>',
                    '</div>',
                ],
            ],
            [
                'label'         => $label,
                'variant'       => null,
                'size'          => null,
                'items'         => [
                    new HtmlString('<li>text</li>')
                ],
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '<li>text</li>',
                    '</ul>',
                    '</div>',
                ],
            ],
            [
                'label'         => $label,
                'variant'       => 'danger',
                'size'          => null,
                'items'         => [
                    new HtmlString('<li>text</li>')
                ],
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-danger dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '<li>text</li>',
                    '</ul>',
                    '</div>',
                ],
            ],
        ];

        $variants = static::baseVariants();

        foreach ($variants as $variant) {
            foreach (['sm' => 'btn-sm', 'md' => '', 'lg' => 'btn-lg'] as $size => $sizeClass) {
                $providerData[] = [
                    'label'         => $label,
                    'variant'       => $variant,
                    'size'          => $size,
                    'items'         => [
                        new HtmlString('<li>text</li>')
                    ],
                    'direction'     => null,
                    'attributes'    => null,
                    'expectedParts' => [
                        '<div class="dropdown">',
                        sprintf(
                            '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="%s">',
                            implode(
                                ' ',
                                array_filter(
                                    [
                                        'btn',
                                        'btn-' . $variant,
                                        $sizeClass,
                                        'dropdown-toggle',
                                    ]
                                )
                            )
                        ),
                        $label,
                        '</button>',
                        '<ul class="dropdown-menu">',
                        '<li>text</li>',
                        '</ul>',
                        '</div>',
                    ],
                ];
            }
        }

        return $providerData;
    }
}