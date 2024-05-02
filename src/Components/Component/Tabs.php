<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use StoneHilt\Blade\View\SlotCollection;

/**
 * Class Tabs
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class Tabs extends Nav
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.tabs';

    /**
     * @var array $mapToSlot List of properties that should be mapped to a ComponentSlot instance before rendering
     */
    protected static array $mapToSlot = [
        'tabs'
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $tabsId = 'tab-nav',
        public string $contentId = 'tab-content',
        public array $tabs = [],
        public string $alignment = 'start',
        public bool $vertical = false,
        public string $spacing = 'auto',
        public string $display = 'tabs',
    ) {
        // Pass data to parent for mapping consistency
        parent::__construct($this->tabs, 'ul', $this->alignment, $this->vertical, $this->spacing, $this->display);
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        if ($viewData['tabs'] instanceof ComponentSlot) {
            $viewData['tabs'] = new SlotCollection([$viewData['tabs']]);
        }

        // Make sure the first tab is "active" if no tab is set to being active
        if (is_null($viewData['tabs']->first(fn($tab) => $tab->attributes?->active ?? false))) {
            $viewData['tabs']->first()->attributes['active'] = true;
        }

        return $viewData;
    }

    /**
     * @return string
     */
    protected function getView(): string
    {
        return $this->viewName;
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
            $attributes->merge(
                [
                    'id'   => $this->tabsId,
                    'role' => 'tablist',
                ]
            )
                ->class(
                    [
                        'mb-3' => !$this->vertical
                    ]
                )
        );
    }
}