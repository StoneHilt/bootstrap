<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;

/**
 * Class ControlGroup
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
class ControlGroup extends Base
{
    use PrefixNames;

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

        if (!empty($this->wrapperClass)) {
            $classes = array_merge($classes, (array)$this->wrapperClass);
        }

        return implode(' ', $classes);
    }

    /**
     * @return string
     */
    public function horizontalLabelWidth(): string
    {
        $labelWidths = [];
        $inputWidths = is_string($this->horizontalWidth) ? explode(' ', $this->horizontalWidth) : $this->horizontalWidth;

        // col-xx-0 does not exist and effectively the same as col-xx-12
        foreach ($inputWidths as $width) {
            if (is_numeric($width)) {
                $labelWidths[] = sprintf(
                    'col-%d',
                    (12 - $width) ?: 12
                );
            } else {
                [$responsiveType, $columnWidth] = explode('-', $width);
                $labelWidths[] = sprintf(
                    'col-%s-%d',
                    $responsiveType,
                    (12 - $columnWidth) ?: 12
                );
            }
        }

        return implode(' ', $labelWidths);
    }

    /**
     * @return string
     */
    public function horizontalWidth(): string
    {
        return implode(' ', $this->prefixNames($this->horizontalWidth, 'col'));
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
