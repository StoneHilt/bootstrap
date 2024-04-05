<?php

namespace StoneHilt\Bootstrap\Components;

use Closure;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;

/**
 * Class Base
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
abstract class Base extends Component
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::base';

    /**
     * @var array|string[] $variants
     */
    protected static array $variants = [
        'primary',
        'secondary',
        'success',
        'danger',
        'warning',
        'info',
        'light',
        'dark',
    ];

    /**
     * @var array $mapToSlot List of properties that should be mapped to a ComponentSlot instance before rendering
     */
    protected static array $mapToSlot = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @throws ValidationException
     */
    public function render(): View|Closure|string
    {
        $this->validateProperties();

        return function (array $viewData) {
            $viewData = $this->transformViewData($viewData);

            $this->validateAttributes($viewData['attributes']);
            $viewData['attributes'] = $this->transformAttributes($viewData['attributes']);

            return new HtmlString(
                $this->view($this->getView(), $viewData)->render()
            );
        };
    }

    /**
     * Resolve the Blade view or view file that should be used when rendering the component.
     *
     * @return ViewContract|Htmlable|\Closure|string
     * @throws ValidationException
     */
    public function resolveView()
    {
        return $this->render();
    }

    /**
     * @return string
     */
    protected function getView(): string
    {
        return $this->viewName;
    }

    /**
     * @return void
     * @throws ValidationException
     */
    protected function validateProperties(): void
    {
        if (!empty($rules = $this->propertyRules())) {
            $properties = array_intersect_key(
                get_object_vars($this),
                array_flip(static::extractConstructorParameters())
            );

            Validator::validate($properties, $rules);
        }
    }

    /**
     * Override to transform/add view data at render time
     *
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        foreach (static::$mapToSlot as $property) {
            if (!($property instanceof ComponentSlot)) {
                $viewData[$property] = new ComponentSlot(strval($viewData[$property] ?? ''));
            }
        }

        return $viewData;
    }

    /**
     * @param ComponentAttributeBag $attributes
     * @return void
     * @throws ValidationException
     */
    protected function validateAttributes(ComponentAttributeBag $attributes): void
    {
        if (!empty($rules = $this->attributeRules())) {
            Validator::validate($attributes->getAttributes(), $rules);
        }
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return $attributes;
    }

    /**
     * Override to validate the attributes for the given Component
     *
     * Returns array of validation rules to apply to attributes
     * Structure
     *  'attribute' => rule<array|Closure|Rule>
     * @return array
     */
    protected function attributeRules(): array
    {
        return [];
    }

    /**
     * Override to validate the properties for the given Component
     *
     * Returns array of validation rules to apply to attributes
     * Structure
     *  'attribute' => rule<array|Closure|Rule>
     * @return array
     */
    protected function propertyRules(): array
    {
        return [];
    }
}
