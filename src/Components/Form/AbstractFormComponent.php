<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class AbstractFormComponent
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
abstract class AbstractFormComponent extends Base
{
    /**
     * @var array|string[]
     */
    protected static array $sizes = [
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $size = null,
    ) {
        parent::__construct();
    }

    /**
     * @return void
     */
    abstract protected function determineViewByType(): void;

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->determineViewByType();

        return parent::render();
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        if (!$this->attributes->has('id')) {
            $attributes['id'] = uniqid($this->name ?? '');
        }

        if (!$this->attributes->has('name')) {
            $attributes['name'] = $this->name;
        }

        return parent::transformAttributes($attributes);
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'size' => ['nullable', Rule::in(static::$sizes)]
        ];
    }
}
