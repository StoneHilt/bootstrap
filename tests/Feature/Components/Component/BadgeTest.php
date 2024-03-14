<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use StoneHilt\Bootstrap\Components\Component\Badge;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class BadgeTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class BadgeTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string $variant
     * @param string|null $position
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function test_render(
        string $variant,
        ?string $position,
        ?array $attributes,
        ?string $slot,
        string $expectOpening
    ) {

        $view = $this->nullSafeComponent(
            Badge::class,
            [
                'variant'  => $variant,
                'position' => $position,
            ],
            $attributes,
            $slot
        );

        $view->assertSeeInOrder(
            [$expectOpening, $slot ?? '', '</span>'],
            false
        );
    }

    /**
     * @return array[]
     * @throws \ReflectionException
     */
    public static function provider_render(): array
    {
        $slotContent = self::faker()->name();

        $providerData = [];

        $positionMappings = [
            'top-start'    => 'top-0 start-0',
            'top-end'      => 'top-0 start-100',
            'bottom-start' => 'top-100 start-0',
            'bottom-end'   => 'top-100 start-100',
        ];

        $variants = static::baseVariants();

        foreach ($variants as $variant) {
            $providerData[] = [
                'variant'       => $variant,
                'position'      => null,
                'attributes'    => null,
                'slot'          => $slotContent,
                'expectOpening' => sprintf(
                    '<span class="badge bg-%s">',
                    $variant
                ),
            ];

            foreach ($positionMappings as $position => $classes) {
                $providerData[] = [
                    'variant'       => $variant,
                    'position'      => $position,
                    'attributes'    => null,
                    'slot'          => $slotContent,
                    'expectOpening' => sprintf(
                        '<span class="position-absolute %s translate-middle badge bg-%s">',
                        $classes,
                        $variant
                    ),
                ];
            }
        }

        $providerData[] = [
            'variant'       => 'primary',
            'position'      => 'top-start',
            'attributes'    => ['id' => 'This-id'],
            'slot'          => $slotContent,
            'expectOpening' => sprintf(
                '<span class="position-absolute %s translate-middle badge bg-primary" id="This-id">',
                $positionMappings['top-start'],
            ),
        ];

        return $providerData;
    }
}
