<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Breadcrumb;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class BreadcrumbTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class BreadcrumbTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param array $items
     * @param string|null $current
     * @param string|null $divider
     * @param array|null $attributes
     * @param string $expectOpening
     * @param array $expectedLIs
     * @return void
     * @throws Exception
     */
    public function test_render(
        array $items,
        ?string $current,
        ?string $divider,
        ?array $attributes,
        string $expectOpening,
        array $expectedLIs
    ) {
        $data = [
            'items'   => $items,
            'current' => $current,
            'divider' => $divider,
        ];

        $view = $this->nullSafeComponent(Breadcrumb::class, $data, $attributes);

        $view->assertSeeInOrder(
            array_merge(
                [
                    $expectOpening,
                    '<ol class="breadcrumb">',
                ],
                $expectedLIs,
                [
                    '</ol>',
                    '</nav>'
                ]
            ),
            false
        );
    }

    /**
     * @return array
     */
    public static function provider_render(): array
    {
        $faker = static::faker();

        $itemText = [];
        $itemHref = [];

        for ($i = 0; $i < 4; $i++) {
            $itemText[] = $faker->word();
            $itemHref[] = $faker->url();
        }

        $expectedLIs = [
            sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[0], $itemText[0]),
            sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[1], $itemText[1]),
            sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[2], $itemText[2]),
            sprintf('<li class="breadcrumb-item active" aria-current="page">%s</li>', $itemText[3]),
        ];

        return [
            [
                'items'         => array_combine($itemHref, $itemText),
                'current'       => null,
                'divider'       => null,
                'attributes'    => null,
                'expectOpening' => '<nav aria-label="breadcrumb" >',
                'expectedLIs'   => $expectedLIs,
            ],
            [
                'items'         => array_combine($itemHref, $itemText),
                'current'       => null,
                'divider'       => '|',
                'attributes'    => null,
                'expectOpening' => '<nav aria-label="breadcrumb" style="--bs-breadcrumb-divider: &#039;|&#039;;">',
                'expectedLIs'   => $expectedLIs,
            ],
            [
                'items'         => array_combine($itemHref, $itemText),
                'current'       => 'this page',
                'divider'       => null,
                'attributes'    => null,
                'expectOpening' => '<nav aria-label="breadcrumb" >',
                'expectedLIs'   => [
                    sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[0], $itemText[0]),
                    sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[1], $itemText[1]),
                    sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[2], $itemText[2]),
                    sprintf('<li class="breadcrumb-item"><a href="%s">%s</a></li>', $itemHref[3], $itemText[3]),
                    '<li class="breadcrumb-item active" aria-current="page">this page</li>',
                ],
            ],
            [
                'items'         => array_combine($itemHref, $itemText),
                'current'       => null,
                'divider'       => null,
                'attributes'    => ['id' => 'THE-ID'],
                'expectOpening' => '<nav aria-label="breadcrumb" id="THE-ID">',
                'expectedLIs'   => $expectedLIs,
            ],
        ];
    }
}