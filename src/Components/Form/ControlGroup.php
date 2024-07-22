<?php

namespace StoneHilt\Bootstrap\Components\Form;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class ControlGroup
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
class ControlGroup extends Base
{
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
}
