<?php

namespace StoneHilt\Bootstrap\Components\Component\Dropdown;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\AcceptRoutesAsHref;

/**
 * Class Item
 *
 * @package StoneHilt\Bootstrap\Components\Component\Dropdown
 */
class Item extends Base
{
    use AcceptRoutesAsHref;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.dropdown.item';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $href = null,
        public bool $active = false,
        public bool $disabled = false,
        public bool $nonInteractive = false,
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
            $mergedAttributes['aria-current'] = "true";
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