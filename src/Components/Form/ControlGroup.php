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
    ) {
        parent::__construct();
    }
}
