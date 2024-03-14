<?php

namespace StoneHilt\Bootstrap\Components\Component\Nav;

use Illuminate\Support\HtmlString;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\AcceptRoutesAsHref;

/**
 * Class Dropdown
 *
 * @package StoneHilt\Bootstrap\Components\Component\Nav
 */
class Dropdown extends Base
{
    use AcceptRoutesAsHref;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.nav.dropdown';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $label,
        public array $items = [],
        public bool $active = false,
        public bool $disabled = false
    ) {
        parent::__construct();
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        if (empty($viewData['items']) && $viewData['slot']->isNotEmpty()) {
            $viewData['items'] = [
                new HtmlString($viewData['slot'])
            ];
        }

        return $viewData;
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
