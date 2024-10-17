<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Form;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ControlGroupTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Form
 */
class ControlGroupTest extends FeatureTestCase
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
        $name            = static::faker()->slug(2);
        $altInputName    = static::faker()->slug(2);
        $btnContent      = static::faker()->words(2, true);
        $label           = static::faker()->words(2, true);
        $textareaContent = static::faker()->text();
        $id              = static::faker()->slug(2);

        return [
            [
                'view' => 'form.control_group.span_input',
                'data' => [
                    'inputName' => $name,
                    'spanContent' => '$',
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    '<span class="input-group-text">$</span>',
                    sprintf('<input class="form-control" name="%s" type="text">', $name),
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.input_span',
                'data' => [
                    'inputName' => $name,
                    'spanContent' => '%',
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    sprintf('<input class="form-control" name="%s" type="text">', $name),
                    '<span class="input-group-text">%</span>',
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.input_button',
                'data' => [
                    'inputName' => $name,
                    'buttonContent' => $btnContent,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    sprintf('<input class="form-control" name="%s" type="text">', $name),
                    sprintf('<button class="btn" type="button">%s</button>', $btnContent),
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.span_input_button',
                'data' => [
                    'inputName'     => $name,
                    'spanContent'   => '$',
                    'buttonContent' => $btnContent,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    '<span class="input-group-text">$</span>',
                    sprintf('<input class="form-control" name="%s" type="text">', $name),
                    sprintf('<button class="btn" type="button" id="group-btn-id">%s</button>', $btnContent),
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.span_input_input',
                'data' => [
                    'inputName' => $name,
                    'spanContent' => 'Login',
                    'altInputName' => $altInputName,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    '<span class="input-group-text">Login</span>',
                    sprintf('<input class="form-control" name="%s" type="text">', $name),
                    sprintf('<input class="form-control" name="%s" type="password">', $altInputName),
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.span_textarea',
                'data' => [
                    'textareaName'    => $name,
                    'spanContent'     => 'Description',
                    'textareaContent' => $textareaContent
                ],
                'expects' => [
                    '<div class="mb-3">',
                    '<div class="input-group">',
                    '<span class="input-group-text">Description</span>',
                    sprintf('<textarea class="form-control" name="%s" rows="3">%s</textarea>', $name, $textareaContent),
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'form.control_group.horizontal_input_button',
                'data' => [
                    'label'         => $label,
                    'id'            => $id,
                    'inputName'     => $name,
                    'buttonContent' => $btnContent,
                ],
                'expects' => [
                    '<div class="mb-3">',
                    sprintf('<label for="%s" class="col-sm-2 col-form-label">%s</label>', $id, $label),
                    '<div class="col-sm-10 input-group">',
                    sprintf('<input class="form-control" id="%s" name="%s" type="text">', $id, $name),
                    sprintf('<button class="btn" type="button">%s</button>', $btnContent),
                    '</div>',
                    '</div>',
                ],
            ],
        ];
    }
}