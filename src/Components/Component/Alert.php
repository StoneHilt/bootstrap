<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Alert
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Alert extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.alert';

    /**
     * Create a new component instance.
     */
    public function __construct(public string $variant)
    {
        parent::__construct();
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return parent::transformAttributes(
            $attributes->class(
                [
                    'alert',
                    'alert-' . $this->variant
                ]
            )
        );
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'variant' => [Rule::in(static::$variants)]
        ];
    }
}
