<?php

namespace StoneHilt\Bootstrap\Tests\Unit\Components\Traits;

use StoneHilt\Bootstrap\Components\Traits\HasHorizontalLayoutWithLabel;
use StoneHilt\Bootstrap\Tests\Unit\UnitTestCase;

/**
 * Class HasHorizontalLayoutWithLabelTest
 *
 * @package StoneHilt\Bootstrap\Tests\Unit\Components\Traits
 */
class HasHorizontalLayoutWithLabelTest extends UnitTestCase
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
        $testClass = $this->generateTestComponent($horizontalWidth);

        $this->assertEquals(
            $expected,
            $testClass->horizontalLabelWidth()
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


    /**
     * @dataProvider provider_horizontalWidth
     * @param string|array $horizontalWidth
     * @param string $expected
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function test_horizontalWidth(string|array $horizontalWidth, string $expected)
    {
        $testClass = $this->generateTestComponent($horizontalWidth);

        $this->assertEquals(
            $expected,
            $testClass->horizontalWidth()
        );
    }

    /**
     * @return array[]
     */
    public static function provider_horizontalWidth(): array
    {
        $providerData = [];

        for ($i = 1; $i <= 11; $i++) {
            $expected = sprintf(
                'col-%s',
                $i
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
            'expected' => 'col-xs-12 col-sm-9 col-md-6 col-lg-3',
        ];

        $providerData[] = [
            'horizontalWidth' => 'xs-12 sm-9 md-6 lg-3',
            'expected' => 'col-xs-12 col-sm-9 col-md-6 col-lg-3',
        ];

        return $providerData;
    }

    /**
     * @param $horizontalWidth
     * @return HasHorizontalLayoutWithLabel
     */
    protected function generateTestComponent($horizontalWidth)
    {
        $testClass = new class {
            use HasHorizontalLayoutWithLabel;
            public $horizontalWidth;
        };

        $testClass->horizontalWidth = $horizontalWidth;

        return $testClass;
    }
}
