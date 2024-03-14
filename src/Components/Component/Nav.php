<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Support\HtmlString;
use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Nav
 *
 * @package StoneHilt\Bootstrap\Components\Component
 *
 */
class Nav extends Base
{
    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        'nav',
        'ul',
        'ol',
    ];

    /**
     * @var array|string[] $alignments
     */
    protected static array $alignments = [
        'start',
        'center',
        'end',
    ];

    /**
     * @var array|string[] $spacings
     */
    protected static array $spacings = [
        'auto',
        'fill',
        'justify',
    ];

    /**
     * @var array|string[] $displays
     */
    protected static array $displays = [
        'list',
        'tabs',
        'pills',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.nav';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $items = [],
        public string $type = 'nav',
        public string $alignment = 'start',
        public bool $vertical = false,
        public string $spacing = 'auto',
        public string $display = 'list',
    )
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

        $this->viewName .= '.' . $this->type;

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
        $alignmentClass = 'justify-content-' . $this->alignment;

        return parent::transformAttributes(
            $attributes->class(
                [
                    'nav',
                    $alignmentClass => $this->alignment !== 'start',
                    'flex-column'   => $this->vertical,
                    'nav-tabs'      => $this->display === 'tabs',
                    'nav-pills'     => $this->display === 'pills',
                    'nav-fill'      => $this->spacing === 'fill',
                    'nav-justified' => $this->spacing === 'justify',
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
            'alignment' => [Rule::in(static::$alignments)],
            'display'   => [Rule::in(static::$displays)],
            'spacing'   => [Rule::in(static::$spacings)],
            'type'      => [Rule::in(static::$types)],
        ];
    }
}
