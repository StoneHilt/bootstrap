<?php

namespace StoneHilt\Bootstrap\Tests\Unit\Components;

use Avastechnology\Iolaus\Traits\InvokeMethod;
use StoneHilt\Bootstrap\Components\Col;
use StoneHilt\Bootstrap\Tests\Unit\UnitTestCase;

/**
 * Class ColTest
 *
 * @package StoneHilt\Bootstrap\Tests\Unit\Components
 */
class ColTest extends UnitTestCase
{
    use InvokeMethod;

    /**
     * @dataProvider provider_combineNumberAndXs
     * @param string|array|null $subject
     * @param string|array|null $expectedResult
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception|\ReflectionException
     */
    public function test_combineNumberAndXs(string|array|null $subject, string|array|null $expectedResult)
    {
        $colTest = $this->createPartialMock(Col::class, []);

        $this->assertEqualsCanonicalizing(
            $expectedResult,
            $this->invokeMethod($colTest, 'combineNumberAndXs', [$subject])
        );
    }

    /**
     * @return array
     */
    public static function provider_combineNumberAndXs(): array
    {
        $providerData = [];

        // No impact
        $noImpactSubjects = [
            null,
            '6',
            'xs-6',
            'sm-3',
            'lg-8',
            ['sm-9', 'md-6', 'lg-9'],
            ['xs-12', 'sm-9', 'md-6', 'lg-9'],
            ['12', 'sm-9', 'md-6', 'lg-9'],
        ];

        foreach ($noImpactSubjects as $subject) {
            $providerData[] = [
                'subject'        => $subject,
                'expectedResult' => $subject,
            ];
        }

        $providerData[] = [
            'subject'        => ['12', 'xs-10', 'sm-9', 'lg-9'],
            'expectedResult' => ['12', 'sm-9', 'lg-9'],
        ];

        return $providerData;
    }
}
