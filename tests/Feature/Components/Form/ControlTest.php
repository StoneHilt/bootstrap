<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Form;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Form\Control;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ControlTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Form
 */
class ControlTest extends FeatureTestCase
{
    protected static array $baseTypes = [
        'text',
        'date',
        'datetime-local',
        'email',
        'file',
        'hidden',
        'month',
        'number',
        'password',
        'range',
        'reset',
        'search',
        'submit',
        'tel',
        'time',
        'url',
        'week',
    ];

    /**
     * @dataProvider provider_render
     * @param string $type
     * @param string $name
     * @param string|null $label
     * @param string|null $size
     * @param bool $disabled
     * @param bool|null $readonly
     * @param bool|null $plaintext
     * @param bool|null $horizontal
     * @param array|null $datalist
     * @param array|null $attributes
     * @param string|null $slot
     * @param array $expectedParts
     * @return void
     * @throws Exception
     */
    public function test_render(
        string $type,
        string $name,
        ?string $label,
        ?string $size,
        ?bool $disabled,
        ?bool $readonly,
        ?bool $plaintext,
        ?bool $horizontal,
        ?array $datalist,
        ?array $attributes,
        ?string $slot,
        array $expectedParts
    ) {

        $view = $this->nullSafeComponent(
            Control::class,
            [
                'type'       => $type,
                'name'       => $name,
                'label'      => $label,
                'size'       => $size,
                'disabled'   => $disabled,
                'readonly'   => $readonly,
                'plaintext'  => $plaintext,
                'horizontal' => $horizontal,
                'datalist'   => $datalist,
            ],
            $attributes,
            $slot
        );

        $this->componentOnlySees($view, $expectedParts, false);
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {
        $faker = self::faker();

        // This will fail if type, name and expectedParts are not set!
        $blankDataSet = [
            'type'          => null,
            'name'          => null,
            'label'         => null,
            'size'          => null,
            'disabled'      => null,
            'readonly'      => null,
            'plaintext'     => null,
            'horizontal'    => null,
            'datalist'      => null,
            'attributes'    => null,
            'slot'          => null,
            'expectedParts' => null,
        ];

        $providerData = [];

        foreach (static::$baseTypes as $type) {
            foreach ([null, true, false] as $plaintext) {
                foreach ([null, true, false] as $disabled) {
                    foreach ([null, true, false] as $readonly) {
                        foreach ([null, 'sm', 'md', 'lg', 'xl', 'xxl',] as $size) {
                            $class = $plaintext ? 'form-control-plaintext' : 'form-control';
                            $class .= isset($size) ? ' form-control-' . $size : '';

                            $providerData[] = array_merge(
                                $blankDataSet,
                                [
                                    'type'          => $type,
                                    'name'          => 'test',
                                    'size'          => $size,
                                    'disabled'      => $disabled,
                                    'readonly'      => $readonly,
                                    'plaintext'     => $plaintext,
                                    'expectedParts' => [
                                        '<div class="mb-3">',
                                        sprintf(
                                            '<input class="%s" type="%s" %s%sname="test" >',
                                            $class,
                                            $type,
                                            $disabled ? 'disabled="disabled" ' : '',
                                            $readonly ? 'readonly="readonly" ' : '',
                                        ),
                                        '</div>',
                                    ],
                                ]
                            );

                            $providerData[] = array_merge(
                                $blankDataSet,
                                [
                                    'type'          => $type,
                                    'name'          => 'test',
                                    'label'         => 'Some Description',
                                    'size'          => $size,
                                    'disabled'      => $disabled,
                                    'readonly'      => $readonly,
                                    'plaintext'     => $plaintext,
                                    'attributes'    => ['id' => 'test-input'],
                                    'expectedParts' => [
                                        '<div class="mb-3">',
                                        '<label for="test-input" class="form-label">Some Description</label>',
                                        sprintf(
                                            '<input class="%s" id="test-input" type="%s" %s%sname="test" >',
                                            $class,
                                            $type,
                                            $disabled ? 'disabled="disabled" ' : '',
                                            $readonly ? 'readonly="readonly" ' : '',
                                        ),
                                        '</div>',
                                    ],
                                ]
                            );
                        }
                    }
                }
            }
        }

        return $providerData;
    }
}