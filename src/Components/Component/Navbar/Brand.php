<?php

namespace StoneHilt\Bootstrap\Components\Component\Navbar;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Collapse
 *
 * @package StoneHilt\Bootstrap\Components\Component\Navbar
 */
class Brand extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.navbar.brand';

    /**
     * @param string|null $image
     */
    public function __construct(public ?string $image = null)
    {
        //
    }
}
