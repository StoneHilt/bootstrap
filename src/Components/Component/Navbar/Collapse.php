<?php

namespace StoneHilt\Bootstrap\Components\Component\Navbar;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Collapse
 *
 * @package StoneHilt\Bootstrap\Components\Component\Navbar
 */
class Collapse extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.navbar.collapse';

    /**
     * Create a new component instance.
     */
    public function __construct(public string $id, public array $items = [])
    {
        parent::__construct();
    }
}
