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
     * @dataProvider provider_render
     * @param string|array|null $width
     * @param string|array|null $order
     * @param string|array|null $offset
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @return void
     * @throws Exception
     */
    public function test_render(
        string|array|null $width,
        string|array|null $order,
        string|array|null $offset,
        ?array $attributes,
        ?string $slot,
        string $expectOpening
    ) {
        $data = [
            'width'  => $width,
            'order'  => $order,
            'offset' => $offset,
        ];

        $view = $this->nullSafeComponent(Col::class, $data, $attributes, $slot);

        $view->assertSeeInOrder(
            [$expectOpening, $slot ?? '', '</div>'],
            false
        );
    }

    public static function provider_render()
    {
        $sizes = ['xs', 'sm', 'md', 'lg', 'xl', 'xxl'];

        $providerData = [
            [
                'width' => null,
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => '<div class="col">',
            ],
            [
                'width' => '',
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => '<div class="col">',
            ],
            [
                'width' => 'md-5',
                'order' => '1',
                'offset' => null,
                'attributes' => null,
                'slot' => 'column content',
                'expectOpening' => '<div class="col-md-5 order-1">',
            ],
            [
                'width' => ['md-5', 'lg-3'],
                'order' => '3',
                'offset' => '2',
                'attributes' => ['id' => 'This-id'],
                'slot' => 'column content',
                'expectOpening' => '<div class="col-md-5 col-lg-3 offset-2 order-3" id="This-id">',
            ],
        ];

        for ($i = 1; $i <= 12; $i++) {
            $providerData[] = [
                'width' => strval($i),
                'order' => null,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col-%s">',
                    strval($i)
                ),
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
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
                ];
            }
        }

        foreach (['1', '2', '3', '4', '5', 'first', 'last'] as $order) {
            $providerData[] = [
                'width' => null,
                'order' => $order,
                'offset' => null,
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col order-%s">',
                    $order
                ),
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
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
                ];
            }
        }

        for ($i = 0; $i <= 11; $i++) {
            $providerData[] = [
                'width' => null,
                'order' => null,
                'offset' => strval($i),
                'attributes' => null,
                'slot' => null,
                'expectOpening' => sprintf(
                    '<div class="col offset-%s">',
                    strval($i)
                ),
            ];

            foreach ($sizes as $size) {
                $providerData[] = [
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
                ];
            }
        }

        return $providerData;
    }
}