<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Progress;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ProgressTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class ProgressTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param int $value
     * @param int|null $min
     * @param int|null $max
     * @param string|null $label
     * @param array|null $attributes
     * @param int $barWidth
     * @param string $expectOpening
     * @return void
     * @throws Exception
     */
    public function test_render(
        int $value,
        ?int $min,
        ?int $max,
        ?string $label,
        ?array $attributes,
        int $barWidth,
        string $expectOpening
    ) {

        $view = $this->nullSafeComponent(
            Progress::class,
            [
                'value' => $value,
                'min'   => $min,
                'max'   => $max,
                'label' => $label,
            ],
            $attributes
        );

        $view->assertSeeInOrder(
            [
                $expectOpening,
                sprintf(
                    '<div class="progress-bar" style="width: %s%%"></div>',
                    $barWidth
                ),
                '</div>'
            ],
            false
        );
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {
        $providerData = [];

        $ranges = [
            [null, null],
            [0, 100],
            [10, 100],
            [100, 200],
        ];

        foreach ($ranges as $range) {
            $min = $range[0] ?? 0;
            $max = $range[1] ?? 100;

            $values = [
                $min,
                $max,
                intval(($max - $min) / 1)
            ];

            foreach ($values as $value) {
                $barWidth = intval(($value - $min) / ($max - $min) * 100);

                $providerData[] = [
                    'value'         => $value,
                    'min'           => $range[0],
                    'max'           => $range[1],
                    'label'         => null,
                    'attributes'    => null,
                    'barWidth'      => $barWidth,
                    'expectOpening' => sprintf(
                        '<div role="progressbar" class="progress" aria-valuenow="%s" aria-valuemin="%s" aria-valuemax="%s">',
                        $value,
                        $min,
                        $max
                    ),
                ];
            }
        }

        $label = static::faker()->name();

        $providerData[] = [
            'value'         => 125,
            'min'           => 0,
            'max'           => 500,
            'label'         => $label,
            'attributes'    => ['id' => 'This-id'],
            'barWidth'      => 25,
            'expectOpening' => sprintf(
                '<div role="progressbar" class="progress" id="This-id" aria-valuenow="125" aria-valuemin="0" aria-valuemax="500" aria-label="%s">',
                $label
            ),
        ];

        return $providerData;
    }
}