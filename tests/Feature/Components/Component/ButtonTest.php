<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Button;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ButtonTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class ButtonTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string|null $tag
     * @param string|null $variant
     * @param string|null $size
     * @param bool $outline
     * @param bool $disabled
     * @param string|null $type
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @return void
     * @throws Exception
     */
    public function test_render(
        ?string $tag,
        ?string $variant,
        ?string $size,
        ?bool $outline,
        ?bool $disabled,
        ?string $type,
        ?array $attributes,
        ?string $slot,
        string $expectOpening
    ) {

        $view = $this->nullSafeComponent(
            Button::class,
            [
                'tag'      => $tag,
                'variant'  => $variant,
                'size'     => $size,
                'outline'  => $outline,
                'disabled' => $disabled,
                'type'     => $type,
            ],
            $attributes,
            $slot
        );

        $view->assertSeeInOrder(
            [$expectOpening, $slot ?? '', '</' . ($tag ?? 'button') . '>'],
            false
        );
    }

    /**
     * @return array[]
     * @throws \ReflectionException
     */
    public static function provider_render(): array
    {
        $faker = self::faker();

        $providerData = [];

        $providerData[] = [
            'tag'           => null,
            'variant'       => null,
            'size'          => null,
            'outline'       => null,
            'disabled'      => null,
            'type'          => null,
            'attributes'    => null,
            'slot'          => null,
            'expectOpening' => '<button class="btn" type="button">',
        ];

        $variants = static::baseVariants();

        $classes = [0 => 'btn'];

        foreach ([null, false, true] as $disabled) {
            foreach ([null, false, true] as $outline) {
                foreach ($variants as $variant) {
                    $classes[10] = $outline ? 'btn-outline-' . $variant : 'btn-' . $variant;

                    foreach ([null, 'lg', 'sm'] as $size) {
                        if (isset($size)) {
                            $classes[20] = 'btn-' . $size;
                        } else {
                            unset($classes[20]);
                        }

                        $id = $faker->uuid();

                        $providerData[] = [
                            'tag'           => null,
                            'variant'       => $variant,
                            'size'          => $size,
                            'outline'       => $outline,
                            'disabled'      => $disabled,
                            'type'          => null,
                            'attributes'    => ['id' => $id],
                            'slot'          => $faker->words(3, true),
                            'expectOpening' => sprintf(
                                '<button class="%s" type="button"%s id="%s">',
                                implode(' ', $classes),
                                $disabled ? ' disabled="disabled"' : '',
                                $id
                            ),
                        ];
                    }
                }
            }
        }

        return $providerData;
    }
}