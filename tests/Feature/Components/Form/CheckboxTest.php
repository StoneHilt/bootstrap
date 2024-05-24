<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Form;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class CheckboxTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Form
 */
class CheckboxTest extends FeatureTestCase
{
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
        $id       = $faker->slug(2);
        $value    = $faker->optional()->slug(1) ?? $faker->numberBetween();

        $providerData = [];

        $providerData[] = [
            'view' => 'form.checkbox.no_label',
            'data' => [
                'name' => $name,
            ],
            'expects' => [
                '<div class="form-check">',
                sprintf('<input class="form-check-input" type="checkbox" name="%s">', $name),
                '</div>',
            ],
        ];

        foreach ([true, false] as $checked) {
            $providerData[] = [
                'view' => 'form.checkbox.general',
                'data' => [
                    'name'    => $name,
                    'label'   => $label,
                    'value'   => $value,
                    'id'      => $id,
                    'checked' => $checked,
                ],
                'expects' => [
                    '<div class="form-check">',
                    sprintf(
                        '<input class="form-check-input" id="%s" value="%s" type="checkbox"%s name="%s">',
                        $id,
                        $value,
                        $checked ? ' checked="checked"' : '',
                        $name
                    ),
                    sprintf('<label for="%s" class="form-check-label">%s</label>', $id, $label),
                    '</div>',
                ],
            ];

            $providerData[] = [
                'view' => 'form.checkbox.switch',
                'data' => [
                    'name'    => $name,
                    'label'   => $label,
                    'value'   => $value,
                    'id'      => $id,
                    'checked' => $checked,
                ],
                'expects' => [
                    '<div class="form-check form-switch">',
                    sprintf(
                        '<input class="form-check-input" id="%s" value="%s" type="checkbox"%s role="switch" name="%s">',
                        $id,
                        $value,
                        $checked ? ' checked="checked"' : '',
                        $name
                    ),
                    sprintf('<label for="%s" class="form-check-label">%s</label>', $id, $label),
                    '</div>',
                ],
            ];

            // missing size
            foreach ([true, false] as $disabled) {
                foreach ([true, false] as $horizontal) {
                    foreach ([true, false] as $reverse) {
                        foreach (['sm', 'md', 'lg', 'xl', 'xxl', null] as $size) {
                            $providerData[] = [
                                'view' => 'form.checkbox.all_parameters',
                                'data' => [
                                    'name'       => $name,
                                    'label'      => $label,
                                    'value'      => $value,
                                    'id'         => $id,
                                    'checked'    => $checked,
                                    'disabled'   => $disabled,
                                    'horizontal' => $horizontal,
                                    'reverse'    => $reverse,
                                    'size'       => $size,
                                ],
                                'expects' => [
                                    sprintf(
                                        '<div class="form-check%s%s">',
                                        $horizontal ? ' form-check-inline' : '',
                                        $reverse ? ' form-check-reverse' : '',
                                    ),
                                    sprintf(
                                        '<input class="form-check-input%s" id="%s" value="%s" type="checkbox"%s%s name="%s">',
                                        isset($size) ? ' form-control-' . $size : '',
                                        $id,
                                        $value,
                                        $disabled ? ' disabled="disabled"' : '',
                                        $checked ? ' checked="checked"' : '',
                                        $name
                                    ),
                                    sprintf('<label for="%s" class="form-check-label">%s</label>', $id, $label),
                                    '</div>',
                                ],
                            ];
                        }
                    }
                }
            }
        }

        return $providerData;
    }
}