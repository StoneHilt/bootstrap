<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use Illuminate\Support\Str;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class TabsTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class TabsTest extends FeatureTestCase
{
    /**
     * @dataProvider provider_view
     * @param string $view
     * @param array $data
     * @param array $expects
     * @return void
     */
    public function test_view(string $view, array $data, array $expects)
    {
        $this->viewOnlySees($this->view($view, $data), $expects, false);
    }

    /**
     * @return array[]
     */
    public static function provider_view(): array
    {
        $faker = static::faker();

        $tabs = [];
        for ($i = 0; $i < 3; $i++) {
            $tabs['tab-' . $i] = $faker->text();
        }

        $expects = [
            '<ul class="nav nav-tabs mb-3" id="tab-nav" role="tablist">',
        ];

        $first = true;
        foreach ($tabs as $name => $content) {
            $expects[] = '<li class="nav-item" role="presentation">';
            $expects[] = sprintf(
                '<button class="nav-link%s"
                    id="%s-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#%s"
                    type="button"
                    role="tab"
                    aria-controls="%s"
                    aria-selected="true">',
                $first ? ' active' : '',
                $name,
                $name,
                $name
            );
            $expects[] = Str::headline($name);
            $expects[] = '</button>';
            $expects[] = '</li>';

            $first = false;
        }

        $expects[] = '</ul>';
        $expects[] = '<div class="tab-content" id="tab-content">';

        $first = true;
        foreach ($tabs as $name => $content) {
            $expects[] = sprintf(
                '<div class="tab-pane fade show%s"
             id="%s"
             role="tabpanel"
             aria-labelledby="%s-tab">',
                $first ? ' active' : '',
                $name,
                $name
            );
            $expects[] = $content;
            $expects[] = '</div>';
            $first = false;
        }
        $expects[] = '</div>';

        return [
            [
                'view' => 'component.tabs.simple',
                'data' => [
                    'tabs' => $tabs
                ],
                'expects' => $expects,
            ],
            [
                'view' => 'component.tabs.simple_slots',
                'data' => [
                    'tabs' => $tabs
                ],
                'expects' => $expects,
            ],
        ];
    }
}