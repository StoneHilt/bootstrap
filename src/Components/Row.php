<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Row
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
class Row extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::row';

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return parent::transformAttributes(
            $attributes->class(['row'])
        );
    }
}
