<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Progress
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class Progress extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.progress';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $value,
        public int $min = 0,
        public int $max = 100,
        public ?string $label = null,
    ) {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function barWidth(): int
    {
        return intval(($this->value - $this->min) / ($this->max - $this->min) * 100);
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        $attributes['aria-valuenow'] = $this->value;
        $attributes['aria-valuemin'] = $this->min;
        $attributes['aria-valuemax'] = $this->max;

        if (isset($this->label)) {
            $attributes['aria-label'] = $this->label;
        }

        return parent::transformAttributes($attributes);
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'value' => ['gte:min', 'lte:max'],
            'min' => ['lt:max'],
            'max' => ['gt:min'],
        ];
    }
}
