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

        $types         = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'];
        $displays      = [null, 1, 2, 3, 4, 5, 6];
        $secondaryText = [null, $faker->words(5, true)];

        $providerData = [];

        foreach ($types as $type) {
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