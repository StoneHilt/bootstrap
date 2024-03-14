<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use Illuminate\Support\HtmlString;
use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Dropdown;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class DropdownTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class DropdownTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string $label
     * @param string|null $variant
     * @param array|null $items
     * @param string|null $direction
     * @param array|null $attributes
     * @param array $expectedParts
     * @return void
     * @throws Exception
     */
    public function test_render(
        string $label,
        ?string $variant,
        ?array $items,
        ?string $direction,
        ?array $attributes,
        array $expectedParts,
    ) {
        $view = $this->nullSafeComponent(
            Dropdown::class,
            [
                'label'     => $label,
                'variant'   => $variant,
                'items'     => $items,
                'direction' => $direction,
            ],
            $attributes
        );

        $this->componentOnlySees($view, $expectedParts, false);
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {
        $faker = static::faker();
        $label = $faker->words(3, true);

        return [
            [
                'label'         => $label,
                'variant'       => null,
                'items'         => null,
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '</ul>',
                    '</div>',
                ],
            ],
            [
                'label'         => $label,
                'variant'       => null,
                'items'         => [
                    new HtmlString('<li>text</li>')
                ],
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-secondary dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '<li>text</li>',
                    '</ul>',
                    '</div>',
                ],
            ],
            [
                'label'         => $label,
                'variant'       => 'danger',
                'items'         => [
                    new HtmlString('<li>text</li>')
                ],
                'direction'     => null,
                'attributes'    => null,
                'expectedParts' => [
                    '<div class="dropdown">',
                    '<button type="button" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-danger dropdown-toggle">',
                    $label,
                    '</button>',
                    '<ul class="dropdown-menu">',
                    '<li>text</li>',
                    '</ul>',
                    '</div>',
                ],
            ],
        ];
    }
}