<?php

namespace StoneHilt\Bootstrap\Components\Component;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Offcanvas
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class Offcanvas extends Base
{
    /**
     * @var array|string[] $types
     */
    protected static array $placements = [
        'start',
        'end',
        'top',
        'bottom',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.offcanvas';

    /**
     * @param string $id
     * @param string|null $title
     * @param string|null $titleId
     * @param bool $backdrop
     * @param bool $backdropStatic
     * @param bool $scroll
     * @param string $placement
     * @param bool $show
     */
    public function __construct(
        public string $id,
        public ?string $title = null,
        public ?string $titleId = null,
        public bool $backdrop = true,
        public bool $backdropStatic = false,
        public bool $scroll = false,
        public string $placement = 'start',
        public bool $show = false,
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

        if (!empty($viewData['title']) && empty($viewData['titleId'])) {
            $viewData['titleId'] = $this->titleId = sprintf('%s-title', $this->id);
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
        $mergedAttributes = [];

        if ($this->scroll) {
            $mergedAttributes['data-bs-scroll'] = 'true';
        }

        if ($this->backdropStatic) {
            $mergedAttributes['data-bs-backdrop'] = 'static';
        } elseif (!$this->backdrop) {
            $mergedAttributes['data-bs-backdrop'] = 'false';
        }

        if (!empty($this->titleId)) {
            $mergedAttributes['aria-labelledby'] = $this->titleId;
        }

        return parent::transformAttributes(
            $attributes->merge($mergedAttributes)
                ->class(
                    [
                        'offcanvas',
                        sprintf('offcanvas-%s', $this->placement),
                        $this->show ? 'show' : '',
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
            'placement'     => [Rule::in(static::$placements)],
        ];
    }
}