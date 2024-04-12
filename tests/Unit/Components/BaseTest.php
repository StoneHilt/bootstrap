<?php

namespace StoneHilt\Bootstrap\Tests\Unit\Components;

use Avastechnology\Iolaus\Traits\InvokeMethod;
use Avastechnology\Iolaus\Traits\InvokeSetter;
use Illuminate\View\ComponentSlot;
use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Tests\Unit\UnitTestCase;

/**
 * Class BaseTest
 *
 * @package StoneHilt\Bootstrap\Tests\Unit\Components
 */
class BaseTest extends UnitTestCase
{
    use InvokeMethod;
    use InvokeSetter;

    /**
     * @dataProvider provider_transformViewData
     * @param array $viewData
     * @param array $mapToSlot
     * @param array $expected
     * @return void
     * @throws Exception
     * @throws \ReflectionException
     */
    public function test_transformViewData(array $viewData, array $mapToSlot, array $expected)
    {
        $component = $this->createPartialMock(Base::class, []);
        $this->invokeSetter(Base::class, 'mapToSlot', $mapToSlot);

        $result = $this->invokeMethod($component, 'transformViewData', [$viewData]);

        foreach ($expected as $key => $value) {
            $this->assertEquals(
                $value,
                $result[$key]
            );

            unset($result[$key]);
        }

        $this->assertEmpty($result);
    }

    /**
     * @return array
     */
    public static function provider_transformViewData(): array
    {
        return [
            [
                'viewData' => [],
                'mapToSlot' => [],
                'expected' => [],
            ],
            [
                'viewData' => [],
                'mapToSlot' => ['title'],
                'expected' => [
                    'title' => new ComponentSlot(''),
                ],
            ],
            [
                'viewData' => [
                    'a' => 'abc',
                    'title' => 'The title',
                    'b' => 2.5
                ],
                'mapToSlot' => ['title'],
                'expected' => [
                    'a' => 'abc',
                    'title' => new ComponentSlot('The title'),
                    'b' => 2.5
                ],
            ],
            [
                'viewData' => [
                    'a' => 'abc',
                    'title' => new ComponentSlot('The title', ['x'=> 'X']),
                    'b' => 2.5
                ],
                'mapToSlot' => ['title'],
                'expected' => [
                    'a' => 'abc',
                    'title' => new ComponentSlot('The title', ['x'=> 'X']),
                    'b' => 2.5
                ],
            ],
        ];
    }
}
