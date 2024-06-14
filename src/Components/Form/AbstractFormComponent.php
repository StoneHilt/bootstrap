<?php

namespace StoneHilt\Bootstrap\Components\Form;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;
use StoneHilt\Bootstrap\Components\Traits\ResponsiveSizes;

/**
 * Class AbstractFormComponent
 *
 * @package StoneHilt\Bootstrap\Components\Form
 */
abstract class AbstractFormComponent extends Base
{
    use PrefixNames;
    use ResponsiveSizes;

    /**
     * @var array|string[]
     */
    protected static array $sizes = [
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $size = null,
        public bool $horizontal = false,
        public string|array $horizontalWidth = 'sm-10',
    ) {
        parent::__construct();
    }

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
        return implode(' ', $this->prefixNames($this->horizontalWidth, 'col'));
    }

    /**
     * Override to transform/add attributes at render time
     *
     * @param ComponentAttributeBag $attributes
     * @return ComponentAttributeBag
     */
    protected function transformAttributes(ComponentAttributeBag $attributes): ComponentAttributeBag
    {
        if (isset($this->label) && !$attributes->has('id')) {
            $attributes['id'] = uniqid($this->name ?? '');
        }

        if (!$attributes->has('name')) {
            $attributes['name'] = $this->name;
        }

        return parent::transformAttributes($attributes);
    }

    /**
     * @return array
     */
    protected function propertyRules(): array
    {
        return [
            'size' => ['nullable', Rule::in(static::$sizes)]
        ];
    }
}
