<?php

namespace StoneHilt\Bootstrap\Components\Typography;

use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Traits\PrefixNames;

/**
 * Class Text
 *
 * @package StoneHilt\Bootstrap\Components\Typography
 */
class Text extends Base
{
    use PrefixNames;

    /**
     * @var array|string[] $types
     */
    protected static array $types = [
        'del'        => 'del',
        'delete'     => 'del',
        's'          => 's',
        'strikethru' => 's',
        'ins'        => 'ins',
        'insert'     => 'ins',
        'u'          => 'u',
        'underlined' => 'u',
        'small'      => 'small',
        'strong'     => 'strong',
        'em'         => 'em',
        'italicized' => 'em',
        'emphasized' => 'em',
        'mark'       => 'mark',
    ];

    /**
     * @var array|string[] $transformations
     */
    protected static array $transformations = [
        'lowercase',
        'uppercase',
        'capitalize',
    ];

    /**
     * @var array|string[] $weights
     */
    protected static array $weights = [
        'bold',
        'bolder',
        'semibold',
        'medium',
        'normal',
        'light',
        'lighter',
    ];

    /**
     * @todo Include viewport sized alignments
     * @var array|string[] $alignments
     */
    protected static array $alignments = [
        'start',
        'center',
        'end',
    ];

    /**
     * @var array|string[] $alignments
     */
    protected static array $colors = [
        'primary',
        'primary-emphasis',
        'secondary',
        'secondary-emphasis',
        'success',
        'success-emphasis',
        'danger',
        'danger-emphasis',
        'warning',
        'warning-emphasis',
        'info',
        'info-emphasis',
        'light',
        'light-emphasis',
        'dark',
        'dark-emphasis',
        'body',
        'body-emphasis',
        'body-secondary',
        'body-tertiary',
        'black',
        'white',
        'black-50',
        'white-50',
        'reset',
    ];

    /**
     * @var array|string[] $backgrounds
     */
    protected static array $backgrounds = [
        'primary',
        'primary-subtle',
        'secondary',
        'secondary-subtle',
        'success',
        'success-subtle',
        'danger',
        'danger-subtle',
        'warning',
        'warning-subtle',
        'info',
        'info-subtle',
        'light',
        'light-subtle',
        'dark',
        'dark-subtle',
        'body-secondary',
        'body-tertiary',
        'body',
        'black',
        'white',
        'transparent',
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::typography.text';

    /**
     * @param string|null $type
     * @param string|null $alignment
     * @param string|null $transform
     * @param string|null $weight String=set to wight; Null=defer to parent
     * @param int|null $size Int=set to size; Null=defer to parent
     * @param bool|null $italics True=set to italic; False=set to normal; Null=defer to parent
     * @param string|null $color
     * @param string|null $background
     */
    public function __construct(
        public ?string $type = null,
        public ?string $alignment = null,
        public ?string $transform = null,
        public ?string $weight = null,
        public ?int $size = null,
        public ?bool $italics = null,
        public ?string $color = null,
        public ?string $background = null
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
                array_merge(
                    $this->prefixNames($this->alignment, 'text'),
                    $this->prefixNames($this->transform, 'text'),
                    $this->prefixNames($this->size, 'fs'),
                    $this->prefixNames($this->weight, 'fw'),
                    $this->prefixNames($this->color, 'text'),
                    $this->prefixNames($this->background, 'bg'),
                    $this->buildItalicsClass(),
                )
            )
        );
    }

    /**
     * @param array $viewData
     * @return array
     */
    protected function transformViewData(array $viewData): array
    {
        return parent::transformViewData(
            array_merge(
                $viewData,
                [
                    'type' => static::$types[$this->type] ?? null
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
            'type'       => ['nullable', Rule::in(array_keys(static::$types))],
            'alignment'  => ['nullable', Rule::in(static::$alignments)],
            'transform'  => ['nullable', Rule::in(static::$transformations)],
            'weight'     => ['nullable', Rule::in(static::$weights)],
            'size'       => ['nullable', 'min:1', 'max:6'],
            'italics'    => ['nullable', 'boolean'],
            'color'      => ['nullable', Rule::in(static::$colors)],
            'background' => ['nullable', Rule::in(static::$backgrounds)],
        ];
    }

    /**
     * @return array|string[]
     */
    protected function buildItalicsClass(): array
    {
        if (!isset($this->italics)) {
            return [];
        }

        return [$this->italics ? 'fst-italic' : 'fst-normal'];
    }
}
