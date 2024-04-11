<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Typography;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Typography\Heading;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class HeadingTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Typography
 */
class HeadingTest extends FeatureTestCase
{
    /**
     * @var array|string[] $types
     */
    protected static array $types = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

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
        $content   = static::faker()->text();
        $secondary = static::faker()->text();

        $providerData = [];

        foreach (static::$types as $type) {
            $providerData[] = [
                'view' => 'typography.heading.simple',
                'data' => [
                    'type'    => $type,
                    'content' => $content,
                ],
                'expects' => [
                    sprintf('<%s class="">', $type),
                    $content,
                    sprintf('</%s>', $type),
                ],
            ];

            $providerData[] = [
                'view' => 'typography.heading.secondary_attribute',
                'data' => [
                    'type'      => $type,
                    'content'   => $content,
                    'secondary' => $secondary,
                ],
                'expects' => [
                    sprintf('<%s class="">', $type),
                    $content,
                    sprintf('<small class="text-body-secondary">%s</small>', $secondary),
                    sprintf('</%s>', $type),
                ],
            ];

            $providerData[] = [
                'view' => 'typography.heading.secondary_shifted_right',
                'data' => [
                    'type'      => $type,
                    'content'   => $content,
                    'secondary' => $secondary,
                ],
                'expects' => [
                    sprintf('<%s class="">', $type),
                    $content,
                    sprintf('<small class="text-body-secondary float-end" id="secondary-heading">%s</small>', $secondary),
                    sprintf('</%s>', $type),
                ],
            ];

            for ($i = 1; $i <= 6; $i++) {
                $providerData[] = [
                    'view' => 'typography.heading.type_display',
                    'data' => [
                        'type'    => $type,
                        'display' => $i,
                        'content' => $content,
                    ],
                    'expects' => [
                        sprintf('<%s class="display-%d">', $type, $i),
                        $content,
                        sprintf('</%s>', $type),
                    ],
                ];
            }
        }

        for ($i = 1; $i <= 6; $i++) {
            $providerData[] = [
                'view' => 'typography.heading.display',
                'data' => [
                    'display' => $i,
                    'content' => $content,
                ],
                'expects' => [
                    sprintf('<h1 class="display-%d">', $i),
                    $content,
                    '</h1>',
                ],
            ];
        }

        return $providerData;
    }

    /**
     * @dataProvider provider_render
     * @param string $type
     * @param int|null $display
     * @param string|null $secondary
     * @param array|null $attributes
     * @param string|null $slot
     * @param array $expectedParts
     * @return void
     * @throws Exception
     */
    public function test_render(
        string $type,
        ?int $display,
        ?string $secondary,
        ?array $attributes,
        ?string $slot,
        array $expectedParts
    ) {
        $data = [
            'type'      => $type,
            'display'   => $display,
            'secondary' => $secondary,
        ];

        $view = $this->nullSafeComponent(Heading::class, $data, $attributes, $slot);

        $this->componentOnlySees($view, $expectedParts, false);
    }

    /**
     * @return array
     */
    public static function provider_render(): array
    {
        $faker = static::faker();

        $displays      = [null, 1, 2, 3, 4, 5, 6];
        $secondaryText = [null, $faker->words(5, true)];

        $providerData = [];

        foreach (static::$types as $type) {
            foreach ($displays as $display) {
                foreach ($secondaryText as $secondary) {
                    foreach (['' => null, ' id="This-id"' => ['id' => 'This-id']] as $attributeString => $attributes) {
                        $slot = $faker->words(3, true);
                        $providerData[] = [
                            'type'       => $type,
                            'display'    => $display,
                            'secondary'  => $secondary,
                            'attributes' => $attributes,
                            'slot'       => $slot,
                            'expectedParts' => [
                                sprintf(
                                    '<%s class="%s"%s>',
                                    $type,
                                    isset($display) ? 'display-' . $display : '',
                                    isset($attributes) ? $attributeString : ''
                                ),
                                $slot,
                                isset($secondary) ? sprintf('<small class="text-body-secondary">%s</small>', $secondary) : '',
                                sprintf('</%s>', $type),
                            ],
                        ];
                    }
                }
            }
        }

        return $providerData;
    }
}