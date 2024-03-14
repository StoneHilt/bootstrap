<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Card
 *
 * @package StoneHilt\Bootstrap\Components\Component
 * @note This component covers most, but not all the card functionality
 */
class Card extends Base
{
    /**
     * @var array $mapToSlot
     */
    protected static array $mapToSlot = [
        'title',
        'subtitle',
        'text',
        'header',
        'footer',
        'headerImage',
        'footerImage'
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.card';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?string $variant = null,
        public ?string $title = null,
        public ?string $subtitle = null,
        public ?string $text = null,
        public ?string $header = null,
        public ?string $footer = null,
        public ?string $headerImage = null,
        public ?string $footerImage = null,
        public bool $horizontal = false
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

        if ($this->horizontal) {
            $this->viewName .= '_horizontal';
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
        $variantClass = 'text-bg-' . $this->variant ?? '';

        return parent::transformAttributes(
            $attributes->class(
                [
                    'card',
                    $variantClass => isset($this->variant)
                ]
            )
        );
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'variant' => ['nullable', Rule::in(static::$variants)]
        ];
    }
}
