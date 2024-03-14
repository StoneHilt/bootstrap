<?php

namespace StoneHilt\Bootstrap\Components\Component;

use StoneHilt\Bootstrap\Components\Base;
use Illuminate\View\ComponentAttributeBag;

/**
 * Class AccordionItem
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class AccordionItem extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.accordion-item';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $header,
        public bool $open = false,
        public ?string $id = null,
        public ?string $accordionId = null,
        public bool $alwaysOpen = false
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
        if (!$attributes->has('id')) {
            return $attributes->merge(['id' => $this->id ?? uniqid('ai-')]);
        }

        return $attributes;
    }
}
