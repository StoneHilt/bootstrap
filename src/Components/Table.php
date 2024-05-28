<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\View\ComponentAttributeBag;

/**
 * Class Table
 *
 * @package StoneHilt\Bootstrap\Components
 *
 */
class Table extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::table';

    /**
     * @var array|string[] $accents
     */
    protected static array $accents = [
        'striped',
        'striped-columns',
        'hover',
        'active',
        'sm',
    ];

    /**
     * @param string|null $variant
     * @param string|array $accent
     */
    public function __construct(public ?string $variant = null, public string|array $accent = [])
    {
        parent::__construct();
    }

    /**
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        return parent::transformAttributes(
            $attributes->class(
                array_merge(
                    [
                        'table',
                        !empty($this->variant) ? 'table-' . $this->variant : '',
                    ],
                    $this->buildAccentsClasses()
                )
            )
        );
    }

    /**
     * @return array
     */
    protected function buildAccentsClasses(): array
    {
        $accents = [];

        foreach ((array)$this->accent as $accent) {
            $accents[] = sprintf(
                'table-%s',
                $accent
            );
        }

        return $accents;
    }
}
