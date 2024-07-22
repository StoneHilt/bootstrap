<?php

namespace StoneHilt\Bootstrap\Components\Traits;

/**
 * Trait ResponsiveSizes
 *
 * @package StoneHilt\Bootstrap\Components\Traits
 */
trait ResponsiveSizes
{
    /**
     * @var array|string[] $types
     */
    protected static array $responsiveTypes = [
        null,
        'xs',
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    /**
     * @return array
     */
    protected static function validResponseSizes(): array
    {
        $validSizes = [];

        foreach (static::$responsiveTypes as $type) {
            for ($i = 1; $i <= 12; $i++) {
                $validSizes[] = isset($type) ? $type . '-' . $i : $i;
            }
        }

        return $validSizes;
    }
}