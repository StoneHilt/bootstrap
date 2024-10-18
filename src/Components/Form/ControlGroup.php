<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\HasHorizontalLayoutWithLabel;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;

/**
 * Class ControlGroup
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
class ControlGroup extends Base
{
    use HasHorizontalLayoutWithLabel;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form.control-group.index';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $label = null,
        public ?string $help = null,
        public bool $horizontal = false,
        public string|array $horizontalWidth = 'sm-10',
        public string|array $wrapperClass = 'mb-3',
    ) {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function wrapperClass(): string
    {
        $classes = [];

        if ($this->horizontal) {
            $classes[] = 'row';
        }

        if (!empty($this->wrapperClass)) {
            $classes = array_merge($classes, (array)$this->wrapperClass);
        }

        return implode(' ', $classes);
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

        return parent::transformAttributes($attributes);
    }

    /**
     * @return string
     */
    protected function getView(): string
    {
        return $this->horizontal
            ? str_replace('.index', '.horizontal', $this->viewName)
            : $this->viewName;
    }
}
