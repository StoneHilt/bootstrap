<?php

namespace StoneHilt\Bootstrap\Components\Component;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Navbar
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Navbar extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.navbar.index';

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        parent::__construct();
    }
}
