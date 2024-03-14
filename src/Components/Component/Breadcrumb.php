<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\AcceptRoutesAsHref;

/**
 * Class Breadcrumb
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Breadcrumb extends Base
{
    use AcceptRoutesAsHref;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.breadcrumb';

    /**
     * Create a new component instance.
     *
     * @param array $items [href|route => text]
     */
    public function __construct(public array $items, public ?string $current = null, public ?string $divider = null)
    {
        parent::__construct();
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        $items = $viewData['items'];
        $viewData['items'] = [];

        foreach ($items as $href => $text) {
            $viewData['items'][$this->acceptRoutesAsHref($href)] = $text;
        }

        if (!empty($this->current)) {
            $viewData['items']['_current_'] = $this->current;
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
        if (isset($this->divider)) {
            return parent::transformAttributes(
                $attributes->style(
                    [
                        sprintf(
                            "--bs-breadcrumb-divider: '%s'",
                            $this->divider
                        )
                    ]
                )
            );
        }

        return parent::transformAttributes($attributes);
    }
}
