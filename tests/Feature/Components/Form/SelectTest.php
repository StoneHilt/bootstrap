<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Form;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class SelectTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Form
 */
class SelectTest extends FeatureTestCase
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
        $label    = static::faker()->words(3, true);
        $name     = static::faker()->slug(2);
        $id       = static::faker()->slug(1);
        $options  = array_combine(
            array_map(fn($word) => strtolower($word), static::faker()->words()),
            array_map(fn($word) => ucfirst($word), static::faker()->words())
        );
        $value = array_rand($options);

        $providerData = [
            [
                'view' => 'form.select.no_label',
                'data' => [
                    'name'    => $name,
                    'options' => $options
                ],
                'expects' => array_merge(
                    [
                        '<div class="mb-3">',
                        sprintf('<select class="form-control" name="%s">', $name),
                    ],
                    array_map(
                        fn($word, $key) => sprintf('<option value="%s" >%s</option>', $key, $word),
                        $options,
                        array_keys($options)
                    ),
                    [
                        '</select>',
                        '</div>',
                    ]
                ),
            ],
            [
                'view' => 'form.select.general',
                'data' => [
                    'label'   => $label,
                    'name'    => $name,
                    'id'      => $id,
                    'options' => $options,
                    'value'   => $value,
                ],
                'expects' => array_merge(
                    [
                        '<div class="mb-3">',
                        sprintf('<label for="%s" class="form-label">%s</label>', $id, $label),
                        sprintf('<select class="form-control" id="%s" name="%s">', $id, $name),
                    ],
                    array_map(
                        function ($word, $key) use ($value) {
                            return sprintf(
                                '<option value="%s" %s>%s</option>',
                                $key,
                                ($key === $value) ? 'selected' : '',
                                $word
                            );
                        },
                        $options,
                        array_keys($options)
                    ),
                    [
                        '</select>',
                        '</div>',
                    ]
                ),
            ],
            [
                'view' => 'form.select.horizontal',
                'data' => [
                    'label'   => $label,
                    'name'    => $name,
                    'id'      => $id,
                    'options' => $options,
                    'value'   => $value,
                ],
                'expects' => array_merge(
                    [
                        '<div class="row mb-3">',
                        sprintf('<label for="%s" class="col-sm-2 col-form-label">%s</label>', $id, $label),
                        '<div class="col-sm-10">',
                        sprintf('<select class="form-control" id="%s" name="%s">', $id, $name),
                    ],
                    array_map(
                        function ($word, $key) use ($value) {
                            return sprintf(
                                '<option value="%s" %s>%s</option>',
                                $key,
                                ($key === $value) ? 'selected' : '',
                                $word
                            );
                        },
                        $options,
                        array_keys($options)
                    ),
                    [
                        '</select>',
                        '</div>',
                        '</div>',
                    ]
                ),
            ],
        ];

        return $providerData;
    }
}
