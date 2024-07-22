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
     * @var array|string[]
     */
    protected static array $sizes = [
        null,
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    /**
     * @dataProvider provider_view
     * @param string $view
     * @param array $data
     * @param array $expects
     * @return void
     */
    public function test_view(string $view, array $data, array $expects)
    {
        $this->viewOnlySees($this->view($view, $data), $expects, false);
    }

    /**
     * @return array[]
     */
    public static function provider_view(): array
    {
        $faker = static::faker();

        $label    = $faker->words(3, true);
        $name     = $faker->slug(2);
        $id       = $faker->slug(1);
        $datalist = $faker->words();

        $providerData = [
            [
                'view' => 'form.control.no_label',
                'data' => [
                    'name' => $name,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    sprintf('<input class="form-control" type="text" name="%s" >', $name),
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control.text',
                'data' => [
                    'label' => $label,
                    'name'  => $name,
                    'id'    => $id,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    sprintf('<label for="%s" class="form-label">%s</label>', $id, $label),
                    sprintf('<input class="form-control" id="%s" type="text" name="%s" >', $id, $name),
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control.datalist',
                'data' => [
                    'label'    => $label,
                    'name'     => $name,
                    'id'       => $id,
                    'datalist' => $datalist,
                ],
                'expects' => array_merge(
                    [
                        '<div class="mb-3">',
                        sprintf('<label for="%s" class="form-label">%s</label>', $id, $label),
                        sprintf('<input class="form-control" id="%s" type="text" name="%s"  list="%s-datalist" >', $id, $name, $id),
                        sprintf('<datalist id="%s-datalist">', $id),
                    ],
                    array_map(
                        fn($val) => sprintf('<option value="%s">', $val),
                        $datalist
                    ),
                    [
                        '</datalist>',
                        '</div>',
                    ],
                ),
            ],
        ];

        foreach (static::$baseTypes as $type) {
            $providerData[] = [
                'view' => 'form.control.type',
                'data' => [
                    'name' => $name,
                    'type' => $type,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    sprintf('<input class="form-control" type="%s" name="%s" >', $type, $name),
                    '</div>',
                ],
            ];
        }

        $horizontalWidths = [
            [
                'data' => [6],
                'labelClass' => 'col-6',
                'inputWrapperClass' => 'col-6',
            ],
            [
                'data' => [9],
                'labelClass' => 'col-3',
                'inputWrapperClass' => 'col-9',
            ],
            [
                'data' => ['sm-12', 'md-9'],
                'labelClass' => 'col-sm-12 col-md-3',
                'inputWrapperClass' => 'col-sm-12 col-md-9',
            ],
        ];

        foreach ($horizontalWidths as $classes) {
            $providerData[] = [
                'view' => 'form.control.horizontal',
                'data' => [
                    'id'              => $id,
                    'label'           => $label,
                    'name'            => $name,
                    'horizontalWidth' => $classes['data'],
                ],
                'expects' => [
                    '<div class="row mb-3">',
                    sprintf('<label for="%s" class="%s col-form-label">%s</label>', $id, $classes['labelClass'], $label),
                    sprintf('<div class="%s">', $classes['inputWrapperClass']),
                    sprintf('<input class="form-control" id="%s" type="text" name="%s" >', $id, $name),
                    '</div>',
                    '</div>',
                ],
            ];
        }

        foreach (['text', 'email'] as $type) {
            foreach ([null, '', 'test@example.com'] as $value) {
                foreach (static::$sizes as $size) {
                    foreach ([true, false] as $disabled) {
                        foreach ([true, false] as $readonly) {
                            foreach ([true, false] as $plaintext) {
                                foreach ([true, false] as $horizontal) {
                                    foreach ($horizontalWidths as $classes) {
                                        foreach (['', 'mb-3', 'm-2'] as $wrapperClass) {
                                            $providerData[] = [
                                                'view' => 'form.control.all_parameters',
                                                'data' => [
                                                    'type'            => $type,
                                                    'name'            => $name,
                                                    'id'              => $id,
                                                    'value'           => $value,
                                                    'label'           => $label,
                                                    'size'            => $size,
                                                    'disabled'        => $disabled,
                                                    'readonly'        => $readonly,
                                                    'plaintext'       => $plaintext,
                                                    'horizontal'      => $horizontal,
                                                    'horizontalWidth' => $classes['data'],
                                                    'datalist'        => $datalist,
                                                    'wrapperClass'    => $wrapperClass,
                                                ],
                                                'expects' => array_merge(
                                                    [
                                                        sprintf('<div class="%s">', static::buildClassList([$horizontal ? 'row' : '', $wrapperClass])),
                                                        sprintf(
                                                            '<label for="%s" class="%s">%s</label>',
                                                            $id,
                                                            $horizontal ? $classes['labelClass'] . ' col-form-label' : 'form-label',
                                                            $label
                                                        ),
                                                        $horizontal ? sprintf('<div class="%s">', $classes['inputWrapperClass']) : null,
                                                        sprintf(
                                                            '<input class="%s%s" id="%s"%s type="%s"%s%s name="%s"  list="%s-datalist" >',
                                                            $plaintext ? 'form-control-plaintext' : 'form-control',
                                                            isset($size) ? ' form-control-' . $size : '',
                                                            $id,
                                                            isset($value) ? ' value="' . $value . '"' : '',
                                                            $type,
                                                            $disabled ? ' disabled="disabled"' : '',
                                                            $readonly ? ' readonly="readonly"' : '',
                                                            $name,
                                                            $id
                                                        ),
                                                        $horizontal ? '</div>' : null,
                                                        sprintf('<datalist id="%s-datalist">', $id),
                                                    ],
                                                    array_map(
                                                        fn($val) => sprintf('<option value="%s">', $val),
                                                        $datalist
                                                    ),
                                                    [
                                                        '</datalist>',
                                                        '</div>',
                                                    ],
                                                ),
                                            ];
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $providerData;
    }

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