<?php

namespace StoneHilt\Bootstrap\Tests\Unit\Components\Component;

use Avastechnology\Iolaus\Traits\InvokeMethod;
use Illuminate\Validation\ValidationException;
use StoneHilt\Bootstrap\Components\Component\Button;
use StoneHilt\Bootstrap\Tests\Unit\UnitTestCase;

/**
 * Class ButtonTest
 *
 * @package StoneHilt\Bootstrap\Tests\Unit\Components\Component
 */
class ButtonTest extends UnitTestCase
{
    use InvokeMethod;

    /**
     * @dataProvider provider_propertyRules
     * @param string $field
     * @param string|null $value
     * @return void
     * @throws \ReflectionException
     */
    public function test_propertyRules(string $field, ?string $value)
    {
        $button = new Button(...[$field => $value]);

        $this->invokeMethod($button, 'validateProperties');

        $this->assertTrue(true);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function provider_propertyRules(): array
    {
        $providerData = [];

        $reflectButton = new \ReflectionClass(Button::class);

        $validatedProperties = [
            'tag'     => 'tags',
            'type'    => 'types',
            'variant' => 'variants',
            'size'    => 'sizes',
        ];

        foreach ($validatedProperties as $property => $optionsProperty) {
            $options = $reflectButton->getProperty($optionsProperty)->getValue();

            foreach ($options as $option) {
                $providerData[] = [
                    'field' => $property,
                    'value' => $option,
                ];
            }
        }

        return $providerData;
    }

    /**
     * @dataProvider provider_propertyRules_invalid
     * @param string $field
     * @param string $value
     * @return void
     * @throws \ReflectionException
     */
    public function test_propertyRules_invalid(string $field, string $value)
    {
        $button = new Button(...[$field => $value]);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage(
            sprintf(
                'The selected %s is invalid',
                $field
            )
        );

        $this->invokeMethod($button, 'validateProperties');
    }

    /**
     * @return array
     */
    public static function provider_propertyRules_invalid(): array
    {
        return [
            [
                'field' => 'tag',
                'value' => 'body',
            ],
            [
                'field' => 'type',
                'value' => 'input',
            ],
            [
                'field' => 'variant',
                'value' => 'bad',
            ],
            [
                'field' => 'size',
                'value' => 'size',
            ],
        ];
    }
}
