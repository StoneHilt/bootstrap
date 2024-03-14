<?php

namespace StoneHilt\Bootstrap\Components\Component;

use StoneHilt\Bootstrap\Components\Base;

/**
 * Class CarouselItem
 *
 * @package StoneHilt\Bootstrap\Components\Component
 */
class CarouselItem extends Base
{
    /**
     * @var int $itemIndex
     */
    protected static int $itemIndex = 0;

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::component.carousel-item';

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $src,
        public string $alt,
        public ?int $interval = null
    ) {
        parent::__construct();
    }

    /**
     * @return int
     */
    public static function resetItemIndex(): int
    {
        $previousIndex = static::$itemIndex;
        static::$itemIndex = 0;

        return $previousIndex;
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        $viewData = parent::transformViewData($viewData);

        // This is a hack to track the carousel items within a give carousel instance
        $viewData['itemIndex'] = static::$itemIndex;

        static::$itemIndex += 1;

        return $viewData;
    }
}
