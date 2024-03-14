<?php

namespace StoneHilt\Bootstrap\Components\Component;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class Carousel
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class Carousel extends Base
{
    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.carousel';

    /**
     * @var bool
     */
    protected bool $activeItemRendered = false;

    /**
     * @param string|null $id
     * @param array $items
     * @param array|null $indicators
     * @param bool $fade
     * @param bool|null $autoplayStart Null => No autoplay; True => Autoplay; False => Autoplay after first slide
     * @param bool $includeControls
     * @param bool $touch
     */
    public function __construct(
        public ?string $id = null,
        public array $items = [],
        public ?array $indicators = null,
        public bool $fade = false,
        public ?bool $autoplayStart = null,
        public bool $includeControls = true,
        public bool $touch = true,
    ) {
        parent::__construct();

        $this->id ??= uniqid('carousel-');
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        // Make sure CarouselItem::resetItemIndex() is run every the carousel is rendered to prevent potential overlap
        $viewData['itemCount'] = CarouselItem::resetItemIndex();
        if (!empty($this->items)) {
            $viewData['itemCount'] = count($this->items);
        }

        return $viewData;
    }
}
