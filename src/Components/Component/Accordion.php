<?php

namespace StoneHilt\Bootstrap\Components\Component;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Accordion
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Accordion extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.accordion';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $id = null,
        public array $items = []
    ) {
        parent::__construct();

        $this->id ??= uniqid('acc-');
    }
}
