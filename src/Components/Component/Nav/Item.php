<?php

namespace StoneHilt\Bootstrap\Components\Component\Nav;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\AcceptRoutesAsHref;

/**
 * Class Item
 *
 * @package StoneHilt\Bootstrap\Components\Component\Nav
 */
class Item extends Base
{
    use AcceptRoutesAsHref;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.nav.item';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $href = null,
        public bool $active = false,
        public bool $disabled = false
    ) {
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
        $mergedAttributes = [];

        if ($attributes->has('href')) {
            $mergedAttributes['href'] = $this->acceptRoutesAsHref($attributes->get('href') ?: '#');
        }

        if ($this->active) {
            $mergedAttributes['aria-current'] = "page";
        }

        if ($this->disabled) {
            $mergedAttributes['aria-disabled'] = "true";
        }

        return parent::transformAttributes(
            $attributes->class(
                [
                    'active'   => $this->active,
                    'disabled' => $this->disabled,
                ]
            )->merge($mergedAttributes)
        );
    }
}