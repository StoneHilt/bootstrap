<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Col;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ColTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components
 */
class ColTest extends FeatureTestCase
{
    /**
     * @var array|string[]
     */
    protected static array $tagTested = [
        'div',
        'header',
        'main',
        'section',
    ];

    /**
     * @dataProvider provider_render
     * @param string|null $tag
     * @param string|array|null $width
     * @param string|array|null $order
     * @param string|array|null $offset
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @param string $expectClosing
     * @return void
     * @throws Exception
     */
    public function test_render(
        string|null $tag,
        string|array|null $width,
        string|array|null $order,
        string|array|null $offset,
        ?array $attributes,
        ?string $slot,
        string $expectOpening,
        string $expectClosing
    ) {
        $data = [
            'tag'    => $tag,
            'width'  => $width,
            'order'  => $order,
            'offset' => $offset,
        ];

        $view = $this->nullSafeComponent(Col::class, $data, $attributes, $slot);

        $view->assertSeeInOrder(
            [$expectOpening, $slot ?? '', $expectClosing],
            false
        );
    }

    public static function provider_render()
    {
        $sizes = ['xs', 'sm', 'md', 'lg', 'xl', 'xxl'];

        $providerData = [
            [
                'tag'   => null,
                'width' => null,
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => '<div class="col">',
                'expectClosing' => '</div>',
            ],
            [
                'tag'   => null,
                'width' => '',
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => '<div class="col">',
                'expectClosing' => '</div>',
            ],
            [
                'tag'   => null,
                'width' => 'md-5',
                'order' => '1',
                'offset' => null,
                'attributes' => null,
                'slot' => 'column content',
                'expectOpening' => '<div class="col-md-5 order-1">',
                'expectClosing' => '</div>',
            ],
            [
                'tag'   => null,
                'width' => ['md-5', 'lg-3'],
                'order' => '3',
                'offset' => '2',
                'attributes' => ['id' => 'This-id'],
                'slot' => 'column content',
                'expectOpening' => '<div class="col-md-5 col-lg-3 offset-2 order-3" id="This-id">',
                'expectClosing' => '</div>',
            ],
        ];

        foreach (static::$tagTested as $tag) {
            $providerData[] = [
                'tag'   => $tag,
                'width' => '',
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf('<%s class="col">', $tag),
                'expectClosing' => sprintf('</%s>', $tag),
            ];
        }

        for ($i = 1; $i <= 12; $i++) {
            $providerData[] = [
                'tag'   => null,
                'width' => strval($i),
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col-%s">',
                    strval($i)
                ),
                'expectClosing' => '</div>',
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
                    'tag'   => null,
                    'width' => $size. '-' . $i,
                    'order' => null,
                    'offset' => null,
                    'attributes' => null,
                    'slot' => null,
                    'expectOpening' => sprintf(
                        '<div class="col-%s-%s">',
                        $size,
                        $i
                    ),
                    'expectClosing' => '</div>',
                ];
            }
        }

        foreach (['1', '2', '3', '4', '5', 'first', 'last'] as $order) {
            $providerData[] = [
                'tag'   => null,
                'width' => null,
                'order' => $order,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col order-%s">',
                    $order
                ),
                'expectClosing' => '</div>',
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
                    'tag'   => null,
                    'width' => null,
                    'order' => $size. '-' . $order,
                    'offset' => null,
                    'attributes' => null,
                    'slot' => null,
                    'expectOpening' => sprintf(
                        '<div class="col order-%s-%s">',
                        $size,
                        $order
                    ),
                    'expectClosing' => '</div>',
                ];
            }
        }

        for ($i = 0; $i <= 11; $i++) {
            $providerData[] = [
                'tag'   => null,
                'width' => null,
                'order' => null,
                'offset' => strval($i),
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col offset-%s">',
                    strval($i)
                ),
                'expectClosing' => '</div>',
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
                    'tag'   => null,
                    'width' => null,
                    'order' => null,
                    'offset' => $size. '-' . $i,
                    'attributes' => null,
                    'slot' => null,
                    'expectOpening' => sprintf(
                        '<div class="col offset-%s-%s">',
                        $size,
                        $i
                    ),
                    'expectClosing' => '</div>',
                ];
            }
        }

        return $providerData;
    }
}