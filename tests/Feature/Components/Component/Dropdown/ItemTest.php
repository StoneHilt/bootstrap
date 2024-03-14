<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component\Dropdown;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Dropdown\Item;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class ItemTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component\Dropdown
 */
class ItemTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_render
     * @param string|null $href
     * @param bool|null $active
     * @param bool|null $disabled
     * @param bool|null $nonInteractive
     * @param array|null $attributes
     * @param string|null $slot
     * @param string $expectOpening
     * @param string $expectClosing
     * @return void
     * @throws Exception
     */
    public function test_render(
        ?string $href,
        ?bool $active,
        ?bool $disabled,
        ?bool $nonInteractive,
        ?array $attributes,
        ?string $slot,
        string $expectOpening,
        string $expectClosing
    ) {

        $view = $this->nullSafeComponent(
            Item::class,
            [
                'href'           => $href,
                'active'         => $active,
                'disabled'       => $disabled,
                'nonInteractive' => $nonInteractive,
            ],
            $attributes,
            $slot
        );

        $view->assertSeeInOrder(
            [
                '<li>',
                $expectOpening,
                $slot ?? '',
                $expectClosing,
                '</li>'
            ],
            false
        );
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {


        $providerData = [];

        foreach ([null, false, true] as $active) {
            foreach ([null, false, true] as $disabled) {
                foreach (['' => null, 'id="This-id"' => ['id' => 'This-id']] as $attributeString => $attributes) {
                    $slotContent = static::faker()->words(3, true);

                    $providerData[] = [
                        'href'           => null,
                        'active'         => $active,
                        'disabled'       => $disabled,
                        'nonInteractive' => null,
                        'attributes'     => $attributes,
                        'slot'           => $slotContent,
                        'expectOpening'  => sprintf(
                            '<button class="dropdown-item%s%s" %s%s%stype="button">',
                            $active ? ' active' : '',
                            $disabled ? ' disabled' : '',
                            $active ? 'aria-current="true" ' : '',
                            $disabled ? 'aria-disabled="true" ' : '',
                            isset($attributes) ? $attributeString . ' ' : ''
                        ),
                        'expectClosing'  => '</button>',
                    ];

                    $providerData[] = [
                        'href'           => '#',
                        'active'         => $active,
                        'disabled'       => $disabled,
                        'nonInteractive' => null,
                        'attributes'     => $attributes,
                        'slot'           => $slotContent,
                        'expectOpening'  => sprintf(
                            '<a href="#" class="dropdown-item%s%s"%s%s%s>',
                            $active ? ' active' : '',
                            $disabled ? ' disabled' : '',
                            $active ? ' aria-current="true"' : '',
                            $disabled ? ' aria-disabled="true"' : '',
                            isset($attributes) ? ' ' . $attributeString : ''
                        ),
                        'expectClosing'  => '</a>',
                    ];

                    $providerData[] = [
                        'href'           => null,
                        'active'         => $active,
                        'disabled'       => $disabled,
                        'nonInteractive' => true,
                        'attributes'     => $attributes,
                        'slot'           => $slotContent,
                        'expectOpening'  => sprintf(
                            '<span class="dropdown-item-text%s%s"%s%s%s>',
                            $active ? ' active' : '',
                            $disabled ? ' disabled' : '',
                            $active ? ' aria-current="true"' : '',
                            $disabled ? ' aria-disabled="true"' : '',
                            isset($attributes) ? ' ' . $attributeString : ''
                        ),
                        'expectClosing'  => '</span>',
                    ];
                }
            }
        }

        $slotContent = static::faker()->words(3, true);
        // Verify Merging of project-specific classes into standard classes
        $providerData[] = [
            'href'           => null,
            'active'         => true,
            'disabled'       => true,
            'nonInteractive' => null,
            'attributes'     => ['class' => 'project-item'],
            'slot'           => $slotContent,
            'expectOpening'  => '<button class="dropdown-item active disabled project-item" aria-current="true" aria-disabled="true" type="button">',
            'expectClosing'  => '</button>',
        ];

        $providerData[] = [
            'href'           => '#',
            'active'         => true,
            'disabled'       => true,
            'nonInteractive' => null,
            'attributes'     => ['class' => 'project-item'],
            'slot'           => $slotContent,
            'expectOpening'  => '<a href="#" class="dropdown-item active disabled project-item" aria-current="true" aria-disabled="true">',
            'expectClosing'  => '</a>',
        ];

        $providerData[] = [
            'href'           => null,
            'active'         => true,
            'disabled'       => true,
            'nonInteractive' => true,
            'attributes'     => ['class' => 'project-item'],
            'slot'           => $slotContent,
            'expectOpening'  => '<span class="dropdown-item-text active disabled project-item" aria-current="true" aria-disabled="true">',
            'expectClosing'  => '</span>',
        ];

        return $providerData;
    }
}