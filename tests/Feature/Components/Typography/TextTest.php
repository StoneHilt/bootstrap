<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Typography;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Typography\Text;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class TextTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Typography
 */
class TextTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string|null $type
     * @param string|null $alignment
     * @param string|null $transform
     * @param string|null $weight
     * @param int|null $size
     * @param bool|null $italics
     * @param string|null $color
     * @param string|null $background
     * @param array|null $attributes
     * @param string|null $slot
     * @param array $expectedParts
     * @return void
     * @throws Exception
     */
    public function test_render(
        ?string $type,
        ?string $alignment,
        ?string $transform,
        ?string $weight,
        ?int $size,
        ?bool $italics,
        ?string $color,
        ?string $background,
        ?array $attributes,
        ?string $slot,
        array $expectedParts
    ) {
        $data = [
            'type'       => $type,
            'alignment'  => $alignment,
            'transform'  => $transform,
            'weight'     => $weight,
            'size'       => $size,
            'italics'    => $italics,
            'color'      => $color,
            'background' => $background,
        ];

        $view = $this->nullSafeComponent(Text::class, $data, $attributes, $slot);

        $this->componentOnlySees($view, $expectedParts, false);
    }

    /**
     * @return array
     */
    public static function provider_render(): array
    {
        $faker = static::faker();

        $types       = [null, 'em' => 'em', 'italicized' => 'em'];
        $alignments  = [null, 'start'];
        $transforms  = [null, 'lowercase'];
        $weights     = [null, 'bold'];
        $sizes       = [null, 1, 6];
        $colors      = [null, 'danger', 'light-emphasis'];
        $backgrounds = [null, 'primary', 'info-subtle'];

        $providerData = [];

        foreach ($types as $type => $tag) {
            foreach ($alignments as $alignment) {
                foreach ($transforms as $transform) {
                    foreach ($weights as $weight) {
                        foreach ($sizes as $size) {
                            foreach ($colors as $color) {
                                foreach ($backgrounds as $background) {
                                    foreach ([null, true, false] as $italics) {
                                        $classes = [
                                            isset($alignment)  ? 'text-' . $alignment : null,
                                            isset($transform)  ? 'text-' . $transform : null,
                                            isset($size)       ? 'fs-' . $size : null,
                                            isset($weight)     ? 'fw-' . $weight : null,
                                            isset($color)      ? 'text-' . $color : null,
                                            isset($background) ? 'bg-' . $background : null,
                                            isset($italics)    ? ($italics ? 'fst-italic' : 'fst-normal') : '',
                                        ];

                                        $slot = $faker->words(3, true);
                                        $providerData[] = [
                                            'type'          => isset($tag) ? $type : null,
                                            'alignment'     => $alignment,
                                            'transform'     => $transform,
                                            'weight'        => $weight,
                                            'size'          => $size,
                                            'italics'       => $italics,
                                            'color'         => $color,
                                            'background'    => $background,
                                            'attributes'    => null,
                                            'slot'          => $slot,
                                            'expectedParts' => [
                                                sprintf('<p class="%s">', implode(' ', array_filter($classes))),
                                                isset($tag) ? sprintf('<%s>', $tag) : '',
                                                $slot,
                                                isset($tag) ? sprintf('</%s>', $tag) : '',
                                                '</p>',
                                            ],
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $providerData;
    }
}
