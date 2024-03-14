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
     * @return void
     * @throws Exception
     */
    public function test_render()
    {
        $innerHtml = 'This is inside the row';

        $view = $this->nullSafeComponent(Row::class, [], null, $innerHtml);

        $view->assertSeeInOrder(
            ['<div class="row">', $innerHtml, '</div>'],
            false
        );
    }
}