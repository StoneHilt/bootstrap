<?php

namespace StoneHilt\Bootstrap\Tests\Unit\Components\Form;

use StoneHilt\Bootstrap\Components\Form\AbstractFormComponent;
use StoneHilt\Bootstrap\Tests\Unit\UnitTestCase;

/**
 * Class AbstractFormComponentTest
 *
 * @package StoneHilt\Bootstrap\Tests\Unit\Components\Form
 */
class AbstractFormComponentTest extends UnitTestCase
{
    /**
     * @dataProvider provider_horizontalLabelWidth
     * @param string|array $horizontalWidth
     * @param string $expected
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function test_horizontalLabelWidth(string|array $horizontalWidth, string $expected)
    {
        $component = $this->createPartialMock(AbstractFormComponent::class, []);
        $component->horizontalWidth = $horizontalWidth;

        $this->assertEquals(
            $expected,
            $component->horizontalLabelWidth()
        );
    }

    /**
     * @return array[]
     */
    public static function provider_horizontalLabelWidth(): array
    {
        $providerData = [];

        for ($i = 1; $i <= 11; $i++) {
            $expected = sprintf(
                'col-%s',
                12 - $i
            );

            $providerData[] = [
                'horizontalWidth' => [$i],
                'expected' => $expected,
            ];

            // String and array versions should yield same results
            $providerData[] = [
                'horizontalWidth' => strval($i),
                'expected' => $expected,
            ];
        }

        $providerData[] = [
            'horizontalWidth' => [12],
            'expected' => 'col-12',
        ];

        $providerData[] = [
            'horizontalWidth' => '12',
            'expected' => 'col-12',
        ];

        $providerData[] = [
            'horizontalWidth' => ['xs-12', 'sm-9', 'md-6', 'lg-3'],
            'expected' => 'col-xs-12 col-sm-3 col-md-6 col-lg-9',
        ];

        $providerData[] = [
            'horizontalWidth' => 'xs-12 sm-9 md-6 lg-3',
            'expected' => 'col-xs-12 col-sm-3 col-md-6 col-lg-9',
        ];

        return $providerData;
    }
}
