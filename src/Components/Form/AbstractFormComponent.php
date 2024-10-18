<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\HasHorizontalLayoutWithLabel;
use StoneHilt\Bootstrap\Components\Traits\ResponsiveSizes;

/**
 * Class AbstractFormComponent
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
abstract class AbstractFormComponent extends Base
{
    use HasHorizontalLayoutWithLabel;
    use ResponsiveSizes;

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
        public bool $horizontal = false,
        public string|array $horizontalWidth = 'sm-10',
        public string|array $wrapperClass = 'mb-3',
    ) {
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
        if (isset($this->label) && !$attributes->has('id')) {
            $attributes['id'] = uniqid($this->name ?? '');
        }

        if (!$attributes->has('name')) {
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
