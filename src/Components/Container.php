<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;

/**
 * Class Container
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
class Container extends Base
{
    /**
     * @var array|string[]
     */
    protected static array $types = [
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
        'fluid',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::container';

    /**
     * @param string|null $type
     */
    public function __construct(public ?string $type = null)
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
                    sprintf(
                        'container%s',
                        !empty($this->type) ? '-' . $this->type : ''
                    )
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
            'type' => ['nullable', Rule::in(static::$types)]
        ];
    }
}
