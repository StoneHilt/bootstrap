<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Button
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Button extends Base
{
    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        'button',
        'submit',
        'reset',
    ];

    /**
     * @var array|string[] $tags
     */
    protected static array $tags = [
        'button',
        'a',
        'input',
    ];

    /**
     * @var array|string[] $sizes
     */
    protected static array $sizes = [
        'lg',
        'sm',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.button';

    /**
     * @param string $tag
     * @param string|null $variant
     * @param string|null $size
     * @param bool $outline
     * @param bool $disabled
     * @param string $type
     */
    public function __construct(
        public string $tag = 'button',
        public ?string $variant = null,
        public ?string $size = null,
        public bool $outline = false,
        public bool $disabled = false,
        public string $type = 'button'
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
        $variantClass = sprintf(
            'btn-%s%s',
            $this->outline ? 'outline-' : '',
            $this->variant ?? ''
        );

        $mergedAttributes = [
            'type' => $this->type,
            'disabled' => $this->disabled,
        ];

        return parent::transformAttributes(
            $attributes->merge($mergedAttributes)
                ->class(
                    [
                        'btn',
                        $variantClass => isset($this->variant),
                        ('btn-' . $this->size ?? '') => isset($this->size),
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
            'tag'     => [Rule::in(static::$tags)],
            'type'    => [Rule::in(static::$types)],
            'variant' => ['nullable', Rule::in(static::$variants)],
            'size'    => ['nullable', Rule::in(static::$sizes)],
        ];
    }
}
