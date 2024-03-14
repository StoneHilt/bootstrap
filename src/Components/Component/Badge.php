<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Badge
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Badge extends Base
{
    /**
     * @var array|string[] $positions
     */
    protected static array $positions = [
        'top-start',
        'top-end',
        'bottom-start',
        'bottom-end',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.badge';

    /**
     * Create a new component instance.
     */
    public function __construct(public string $variant, public ?string $position = null)
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
            $attributes->class($this->buildClasses())
        );
    }

    /**
     * @return array
     */
    protected function buildClasses(): array
    {
        $classes = [];

        if (isset($this->position)) {
            $classes[] = 'position-absolute';

            $classes[] = match($this->position) {
                'top-start'    => 'top-0 start-0',
                'top-end'      => 'top-0 start-100',
                'bottom-start' => 'top-100 start-0',
                'bottom-end'   => 'top-100 start-100',
            };

            $classes[] = 'translate-middle';
        }

        $classes[] = 'badge';

        $classes[] = 'bg-' . $this->variant;

        return $classes;
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'variant'  => [Rule::in(static::$variants)],
            'position' => ['nullable', Rule::in(static::$positions)]
        ];
    }
}
