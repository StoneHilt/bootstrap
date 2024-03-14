<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use StoneHilt\Bootstrap\Components\Component\Alert;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class AlertTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class AlertTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string $variant
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function test_render(
        string $variant,
        ?array $attributes,
        ?string $slot,
        string $expectOpening
    ) {

        $view = $this->nullSafeComponent(
            Alert::class,
            [
                'variant' => $variant,
            ],
            $attributes,
            $slot
        );

        $view->assertSeeInOrder(
            [$expectOpening, $slot ?? '', '</div>'],
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

        $variants = static::baseVariants();

        foreach ($variants as $variant) {
            $providerData[] = [
                'variant'       => $variant,
                'attributes'    => null,
                'slot'          => $slotContent,
                'expectOpening' => sprintf(
                    '<div role="alert" class="alert alert-%s">',
                    $variant
                ),
            ];
        }

        $providerData[] = [
            'variant'       => 'primary',
            'attributes'    => ['id' => 'This-id'],
            'slot'          => $slotContent,
            'expectOpening' => '<div role="alert" class="alert alert-primary" id="This-id">',
        ];

        return $providerData;
    }
}