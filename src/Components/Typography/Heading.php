<?php

namespace StoneHilt\Bootstrap\Components\Typography;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;

/**
 * Class Heading
 *
 * @package StoneHilt\Bootstrap\Components\Typography
 */
class Heading extends Base
{
    use PrefixNames;

    /**
     * @var array $mapToSlot List of properties that should be mapped to a ComponentSlot instance before rendering
     */
    protected static array $mapToSlot = [
        'secondary'
    ];

    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::typography.heading';

    /**
     * @param string $type
     * @param int|null $display
     * @param string|null $secondary
     */
    public function __construct(
        public string $type = 'h1',
        public ?int $display = null,
        public ?string $secondary = null
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
        return parent::transformAttributes(
            $attributes->class(
                $this->prefixNames($this->display, 'display')
            )
        );
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'type'    => [Rule::in(static::$types)],
            'display' => ['nullable', 'min:1', 'max:6'],
        ];
    }
}
