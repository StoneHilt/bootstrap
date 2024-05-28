<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\AcceptRoutesAsHref;

/**
 * Class ListGroup
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class ListGroup extends Base
{
    use AcceptRoutesAsHref;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.list-group';

    /**
     * @var array $mapToSlot List of properties that should be mapped to a ComponentSlot instance before rendering
     */
    protected static array $mapToSlot = [
        'items',
    ];

    /**
     * @var array|string[]
     */
    protected static array $types = [
        'ul',
        'ol',
        'button',
        'a',
        'checkbox',
        'radio',
    ];

    /**
     * Create a new component instance.
     *
     * @param array $items [text] Use slots for more complex items
     */
    public function __construct(
        public array $items = [],
        public bool $numbered = false,
        public bool $flush = false,
        public string $type = 'ul',
        public ?string $variant = null
    ) {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function wrapperElement(): string
    {
        return match ($this->type) {
            'ul', 'checkbox', 'radio' => 'ul',
            'ol'                      => 'ol',
            'button', 'a'             => 'div',
        };
    }

    /**
     * @return string
     */
    public function itemElement(): string
    {
        return match ($this->type) {
            'ul', 'ol', 'checkbox', 'radio' => 'li',
            'button'                        => 'button',
            'a'                             => 'a',
        };
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        if ($this->type === 'button') {
            /** @var ComponentSlot $item */
            foreach ($viewData['items'] as $item) {
                if (!$item->attributes->has('type')) {
                    $item->attributes['type'] = 'button';
                }
            }
        } elseif ($this->type === 'a') {
            /** @var ComponentSlot $item */
            foreach ($viewData['items'] as $item) {
                $item->attributes['href'] = $this->acceptRoutesAsHref($item->attributes['href'] ?? '#');
            }
        }

        /** @var ComponentSlot $item */
        foreach ($viewData['items'] as $item) {
            if ($item->attributes['active'] ?? false) {
                $item->attributes = $item->attributes
                    ->except(['active'])
                    ->class(['active'])
                    ->merge(['aria-current' => true]);
            }

            if ($item->attributes['disabled'] ?? false) {
                $item->attributes = $item->attributes
                    ->except(['disabled'])
                    ->class(['disabled'])
                    ->merge(['aria-disabled' => true]);
            }

            if (in_array($this->type, ['checkbox', 'radio']) && !$item->attributes->has('id')) {
                $item->attributes = $item->attributes->merge(['id' => uniqid('list-group-ckb-')]);
            }
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
        $variantClass = 'list-group-item-' . $this->variant ?? '';

        return parent::transformAttributes(
            $attributes->class(
                [
                    'list-group',
                    'list-group-numbered' => $this->numbered || $this->type === 'ol',
                    'list-group-flush'    => $this->flush,
                    $variantClass         => isset($this->variant),
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
            'variant' => ['nullable', Rule::in(static::$variants)],
            'type'    => [Rule::in(static::$types)],
        ];
    }
}