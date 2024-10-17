<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class OffCanvasTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class OffCanvasTest extends FeatureTestCase
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
        $id      = static::faker()->slug(2);
        $title   = static::faker()->words(3, true);
        $content = static::faker()->text();

        $providerData = [];

        $providerData[] = [
            'view' => 'component.offcanvas.simple',
            'data' => [
                'id'      => $id,
                'content' => $content,
            ],
            'expects' => [
                sprintf('<div class="offcanvas offcanvas-start" tabindex="-1" id="%s">', $id),
                '<div class="offcanvas-body">',
                $content,
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.offcanvas.simple_with_title',
            'data' => [
                'id'      => $id,
                'title'   => $title,
                'content' => $content,
            ],
            'expects' => [
                sprintf('<div class="offcanvas offcanvas-start" aria-labelledby="%s-title" tabindex="-1" id="%s">', $id, $id),
                '<div class="offcanvas-header">',
                sprintf('<h5 class="offcanvas-title" id="%s-title">%s</h5>', $id, $title),
                sprintf('<button type="button" class="btn-close" data-bs-dismiss="%s" aria-label="Close"></button>', $id),
                '</div>',
                '<div class="offcanvas-body">',
                $content,
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'view' => 'component.offcanvas.scrolling',
            'data' => [
                'id'      => $id,
                'title'   => $title,
                'content' => $content,
            ],
            'expects' => [
                sprintf('<div class="offcanvas offcanvas-start" data-bs-scroll="true" aria-labelledby="%s-title" tabindex="-1" id="%s">', $id, $id),
                '<div class="offcanvas-header">',
                sprintf('<h5 class="offcanvas-title" id="%s-title">%s</h5>', $id, $title),
                sprintf('<button type="button" class="btn-close" data-bs-dismiss="%s" aria-label="Close"></button>', $id),
                '</div>',
                '<div class="offcanvas-body">',
                $content,
                '</div>',
                '</div>',
            ],
        ];

        foreach (['start', 'end', 'top', 'bottom'] as $placement) {
            foreach ([true, false, null] as $backdrop) {
                foreach ([true, false] as $scroll) {
                    foreach ([true, false] as $show) {
                        $backdropAttribute = sprintf(' data-bs-backdrop="%s"', isset($backdrop) ? 'false' : 'static');

                        $providerData[] = [
                            'view' => 'component.offcanvas.all_options',
                            'data' => [
                                'id'             => $id,
                                'title'          => $title,
                                'titleId'        => $id . '-header',
                                'content'        => $content,
                                'scroll'         => $scroll,
                                'backdrop'       => $backdrop ?? false,
                                'backdropStatic' => !isset($backdrop),
                                'placement'      => $placement,
                                'show'           => $show,
                            ],
                            'expects' => [
                                sprintf(
                                    '<div class="offcanvas offcanvas-%s%s"%s%s aria-labelledby="%s-header" tabindex="-1" id="%s">',
                                    $placement,
                                    $show ? ' show' : '',
                                    $scroll ? ' data-bs-scroll="true"' : '',
                                    $backdrop !== true ? $backdropAttribute : '',
                                    $id,
                                    $id
                                ),
                                '<div class="offcanvas-header">',
                                sprintf('<h5 class="offcanvas-title" id="%s-header">%s</h5>', $id, $title),
                                sprintf('<button type="button" class="btn-close" data-bs-dismiss="%s" aria-label="Close"></button>', $id),
                                '</div>',
                                '<div class="offcanvas-body">',
                                $content,
                                '</div>',
                                '</div>',
                            ],
                        ];
                    }
                }
            }
        }

        return $providerData;
    }
}