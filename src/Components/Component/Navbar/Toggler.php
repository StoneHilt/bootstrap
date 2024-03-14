<?php

namespace StoneHilt\Bootstrap\Components\Component\Navbar;

use StoneHilt\Bootstrap\Components\Base;
use Illuminate\Validation\Rule;

/**
 * Class Collapse
 *
 * @package StoneHilt\Bootstrap\Components\Component\Navbar
 */
class Toggler extends Base
{
    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        'collapse',
        'offcanvas',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.navbar.toggler';

    /**
     * @param string $target
     * @param string $type
     * @param string|null $label
     */
    public function __construct(public string $target, public string $type = 'collapse', public ?string $label = null)
    {
        //
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'target' => ['required'],
            'type'   => ['nullable', Rule::in(static::$types)]
        ];
    }
}
