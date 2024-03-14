<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Image
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
class Image extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::image';

    /**
     * @param string $src
     * @param string $alt
     * @param string $type
     */
    public function __construct(public string $src, public string $alt, public string $type = 'fluid')
    {
        parent::__construct();
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return parent::transformAttributes(
            $attributes->class(
                [
                    'img-' . $this->type
                ]
            )
        );
    }
}
