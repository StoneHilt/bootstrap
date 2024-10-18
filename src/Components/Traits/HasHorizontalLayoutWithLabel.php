<?php

namespace StoneHilt\Bootstrap\Components\Traits;

/**
 * Trait HasHorizontalLayoutWithLabel
 *
 * @package StoneHilt\Bootstrap\Components\Traits
 */
trait HasHorizontalLayoutWithLabel
{
    use PrefixNames;

    /**
     * @return string
     */
    public function horizontalLabelWidth(): string
    {
        $labelWidths = [];
        $inputWidths = is_string($this->horizontalWidth) ? explode(' ', $this->horizontalWidth) : $this->horizontalWidth;

        // col-xx-0 does not exist and effectively the same as col-xx-12
        foreach ($inputWidths as $width) {
            if (is_numeric($width)) {
                $labelWidths[] = sprintf(
                    'col-%d',
                    (12 - $width) ?: 12
                );
            } else {
                [$responsiveType, $columnWidth] = explode('-', $width);
                $labelWidths[] = sprintf(
                    'col-%s-%d',
                    $responsiveType,
                    (12 - $columnWidth) ?: 12
                );
            }
        }

        return implode(' ', $labelWidths);
    }

    /**
     * @return string
     */
    public function horizontalWidth(): string
    {
        return implode(
            ' ',
            $this->prefixNames(
                is_string($this->horizontalWidth) ? explode(' ', $this->horizontalWidth) : $this->horizontalWidth,
                'col'
            )
        );
    }
}
