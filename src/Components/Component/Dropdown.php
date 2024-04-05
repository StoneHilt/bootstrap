<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Dropdown
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Dropdown extends Base
{
    /**
     * @var array|string[] $types
     */
    protected static array $directions = [
        'down',
        'centered',
        'up',
        'start',
        'end',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.dropdown.single';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public string $variant = 'secondary',
        public array $items = [],
        public string $direction = 'down',
        public bool $split = false
    ) {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function wrapperClass(): string
    {
        return match ($this->direction) {
            'down'     => 'dropdown',
            'centered' => 'dropdown-center',
            'up'       => 'btn-group dropup',
            'start'    => 'btn-group dropstart',
            'end'      => 'btn-group dropend',
        };
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        if (empty($viewData['items']) && $viewData['slot']->isNotEmpty()) {
            $viewData['items'] = [
                new HtmlString($viewData['slot'])
            ];
        }

        return $viewData;
    }

    /**
     * @return string
     */
    protected function getView(): string
    {
        return $this->split ? 'bootstrap::component.dropdown.split' : $this->viewName;
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        $mergedAttributes = [];

        $classes = [
            'btn',
            'btn-' . $this->variant,
        ];

        if (!$this->split) {
            if ($attributes->has('href')) {
                $mergedAttributes['role'] = 'button';
            } else {
                $mergedAttributes['type'] = 'button';
            }

            $mergedAttributes['data-bs-toggle'] = 'dropdown';
            $mergedAttributes['aria-expanded'] = 'false';

            $classes[] = 'dropdown-toggle';
        }

        return parent::transformAttributes(
            $attributes->class($classes)
                ->merge($mergedAttributes)
        );
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'direction' => [Rule::in(static::$directions)],
            'variant'   => [Rule::in(static::$variants)],
        ];
    }
}
