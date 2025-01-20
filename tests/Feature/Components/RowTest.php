<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Row;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class RowTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components
 */
class RowTest extends FeatureTestCase
{
    /**
     * @var array|string[]
     */
    protected static array $tagTested = [
        'div',
        'header',
        'main',
        'section',
    ];

    /**
     * @dataProvider provider_render
     * @param string|null $tag
     * @param string $expectOpening
     * @param string $expectClosing
     * @return void
     * @throws Exception
     */
    public function test_render(
        string|null $tag,
        string $expectOpening,
        string $expectClosing
    ) {
        $innerHtml = 'This is inside the row';

        $view = $this->nullSafeComponent(Row::class, ['tag' => $tag], null, $innerHtml);

        $view->assertSeeInOrder(
            [$expectOpening, $innerHtml, $expectClosing],
            false
        );
    }

    /**
     * @return array
     */
    public static function provider_render(): array
    {
        $providerData = [];

        $providerData[] = [
            'tag'   => null,
            'expectOpening' => '<div class="row">',
            'expectClosing' => '</div>',
        ];

        foreach (static::$tagTested as $tag) {
            $providerData[] = [
                'tag'   => $tag,
                'expectOpening' => sprintf('<%s class="row">', $tag),
                'expectClosing' => sprintf('</%s>', $tag),
            ];
        }

        return $providerData;
    }
}