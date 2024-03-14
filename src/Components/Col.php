<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;

/**
 * Class Col
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
class Col extends Base
{
    use PrefixNames;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::col';

    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        null,
        'xs',
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    /**
     * @var array|string[] $orders
     */
    protected static array $orders = [
        '1',
        '2',
        '3',
        '4',
        '5',
        'first',
        'last',
    ];

    /**
     * @var array $validProperties
     */
    protected static array $validProperties = [];

    /**
     * @param string|array $width
     * @param string|array|null $order
     * @param string|array|null $offset
     */
    public function __construct(
        public string|array $width = '',
        public string|array|null $order = null,
        public string|array|null $offset = null
    ) {
        parent::__construct();

        // Make sure formatting is correct
        if (is_string($this->width) && str_contains($this->width, ' ')) {
            $this->width = explode(' ', $this->width);
        }

        if (is_string($this->order) && str_contains($this->order, ' ')) {
            $this->order = explode(' ', $this->order);
        }

        if (is_string($this->offset) && str_contains($this->offset, ' ')) {
            $this->offset = explode(' ', $this->offset);
        }
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
                array_merge(
                    $this->prefixNames($this->width, 'col'),
                    $this->prefixNames($this->offset, 'offset'),
                    $this->prefixNames($this->order, 'order'),
                )
            )
        );
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        $rules = [];

        $validWidths  = [];
        $validOrders  = [];
        $validOffsets = [];

        foreach (static::$types as $type) {
            for ($i = 1; $i <= 12; $i++) {
                $validWidths[] = isset($type) ? $type . '-' . $i : $i;
            }

            foreach (static::$orders as $order) {
                $validOrders[] = isset($type) ? $type . '-' . $order : $order;
            }

            for ($i = 0; $i <= 11; $i++) {
                $validOffsets[] = isset($type) ? $type . '-' . $i : $i;
            }
        }

        if (is_array($this->width)) {
            $rules['width'] = ['array'];
            $rules['width.*'] = [Rule::in($validWidths)];
        } else {
            $rules['width'] = ['string', Rule::in($validWidths)];
        }

        if (is_array($this->order)) {
            $rules['order'] = ['array'];
            $rules['order.*'] = [Rule::in($validOrders)];
        } else {
            $rules['order'] = ['nullable', Rule::in($validOrders)];
        }

        if (is_array($this->offset)) {
            $rules['offset'] = ['array'];
            $rules['offset.*'] = [Rule::in($validOffsets)];
        } else {
            $rules['offset'] = ['nullable', Rule::in($validOffsets)];
        }

        return $rules;
    }
}
