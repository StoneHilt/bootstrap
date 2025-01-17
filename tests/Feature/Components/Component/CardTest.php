<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components\Component;

use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Component\Card;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class CardTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components\Component
 */
class CardTest extends FeatureTestCase
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
        $content       = static::faker()->text();
        $header        = static::faker()->text();
        $headerClass   = static::faker()->slug(2);
        $headerImage   = static::faker()->imageUrl();
        $title         = static::faker()->text();
        $titleClass    = static::faker()->slug(2);
        $subtitle      = static::faker()->text();
        $subtitleClass = static::faker()->slug(2);
        $text          = static::faker()->text();
        $textClass     = static::faker()->slug(2);
        $footer        = static::faker()->text();
        $footerClass   = static::faker()->slug(2);
        $footerImage   = static::faker()->imageUrl();

        $providerData =[
            [
                'view' => 'component.card.simple_body',
                'data' => [
                    'content' => $content,
                ],
                'expects' => [
                    '<div class="card">',
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_header',
                'data' => [
                    'content' => $content,
                    'header'  => $header,
                ],
                'expects' => [
                    '<div class="card">',
                    sprintf('<div class="card-header">%s</div>', $header),
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_footer',
                'data' => [
                    'content' => $content,
                    'footer'  => $footer,
                ],
                'expects' => [
                    '<div class="card">',
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    sprintf('<div class="card-footer">%s</div>', $footer),
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_header_with_attributes',
                'data' => [
                    'content'     => $content,
                    'header'      => $header,
                    'headerClass' => $headerClass,
                ],
                'expects' => [
                    '<div class="card">',
                    sprintf('<div class="card-header %s" id="the-header">%s</div>', $headerClass, $header),
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_header_image_with_attributes',
                'data' => [
                    'content'     => $content,
                    'horizontal'   => false,
                    'headerImage' => $headerImage,
                    'headerClass' => $headerClass,
                ],
                'expects' => [
                    '<div class="card">',
                    sprintf('<img class="card-img-top %s" id="the-header" src="%s" alt="Image Top">', $headerClass, $headerImage),
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_header_image_with_attributes',
                'data' => [
                    'content'     => $content,
                    'horizontal'   => true,
                    'headerImage' => $headerImage,
                    'headerClass' => $headerClass,
                ],
                'expects' => [
                    '<div class="card">',
                    '<div class="row g-0">',
                    '<div class="col-md-4">',
                    sprintf('<img class="img-fluid rounded-start %s" id="the-header" src="%s" alt="Image Top">', $headerClass, $headerImage),
                    '</div>',
                    '<div class="col-md-8">',
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    '</div>',
                    '</div>',
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_footer_with_attributes',
                'data' => [
                    'content'     => $content,
                    'footer'      => $footer,
                    'footerClass' => $footerClass,
                ],
                'expects' => [
                    '<div class="card">',
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    sprintf('<div class="card-footer %s" id="the-footer">%s</div>', $footerClass, $footer),
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.body_footer_image_with_attributes',
                'data' => [
                    'content'     => $content,
                    'footerImage' => $footerImage,
                    'footerClass' => $footerClass,
                ],
                'expects' => [
                    '<div class="card">',
                    '<div class="card-body">',
                    $content,
                    '</div>',
                    sprintf('<img class="card-img-bottom %s" id="the-footer" src="%s" alt="Image Bottom">', $footerClass, $footerImage),
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.all_slots',
                'data' => [
                    'content'       => $content,
                    'header'        => $header,
                    'headerClass'   => $headerClass,
                    'title'         => $title,
                    'titleClass'    => $titleClass,
                    'subtitle'      => $subtitle,
                    'subtitleClass' => $subtitleClass,
                    'text'          => $text,
                    'textClass'     => $textClass,
                    'footer'        => $footer,
                    'footerClass'   => $footerClass,
                ],
                'expects' => [
                    '<div class="card" id="the-card">',
                    sprintf('<div class="card-header %s" id="the-header">%s</div>', $headerClass, $header),
                    '<div class="card-body">',
                    sprintf('<h5 class="card-title %s" id="the-title">%s</h5>', $titleClass, $title),
                    sprintf('<h6 class="card-subtitle mb-2 text-muted %s" id="the-subtitle">%s</h6>', $subtitleClass, $subtitle),
                    sprintf('<p class="card-text %s" id="the-text">%s</p>', $textClass, $text),
                    $content,
                    '</div>',
                    sprintf('<div class="card-footer %s" id="the-footer">%s</div>', $footerClass, $footer),
                    '</div>',
                ],
            ],
            [
                'view' => 'component.card.all_slots_horizontal',
                'data' => [
                    'content'       => $content,
                    'header'        => $header,
                    'headerClass'   => $headerClass,
                    'title'         => $title,
                    'titleClass'    => $titleClass,
                    'subtitle'      => $subtitle,
                    'subtitleClass' => $subtitleClass,
                    'text'          => $text,
                    'textClass'     => $textClass,
                ],
                'expects' => [
                    '<div class="card" id="the-card">',
                    '<div class="row g-0">',
                    '<div class="col-md-4">',
                    sprintf('<div class="card-header %s" id="the-header">%s</div>', $headerClass, $header),
                    '</div>',
                    '<div class="col-md-8">',
                    '<div class="card-body">',
                    sprintf('<h5 class="card-title %s" id="the-title">%s</h5>', $titleClass, $title),
                    sprintf('<h6 class="card-subtitle mb-2 text-muted %s" id="the-subtitle">%s</h6>', $subtitleClass, $subtitle),
                    sprintf('<p class="card-text %s" id="the-text">%s</p>', $textClass, $text),
                    $content,
                    '</div>',
                    '</div>',
                    '</div>',
                    '</div>',
                ],
            ],
        ];

        $tags = ['div', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

        foreach ($tags as $titleTag) {
            foreach ($tags as $subtitleTag) {
                foreach ($tags as $textTag) {
                    $providerData[] = [
                        'view' => 'component.card.change_section_tags',
                        'data' => [
                            'horizontal'    => false,
                            'header'        => $header,
                            'headerClass'   => $headerClass,
                            'title'         => $title,
                            'titleTag'      => $titleTag,
                            'titleClass'    => $titleClass,
                            'subtitle'      => $subtitle,
                            'subtitleTag'   => $subtitleTag,
                            'subtitleClass' => $subtitleClass,
                            'text'          => $text,
                            'textTag'       => $textTag,
                            'textClass'     => $textClass,
                        ],
                        'expects' => [
                            '<div class="card" id="the-card">',
                            sprintf('<div class="card-header %s" id="the-header">%s</div>', $headerClass, $header),
                            '<div class="card-body">',
                            sprintf(
                                '<%s class="card-title %s" id="the-title">%s</%s>',
                                $titleTag,
                                $titleClass,
                                $title,
                                $titleTag
                            ),
                            sprintf(
                                '<%s class="card-subtitle mb-2 text-muted %s" id="the-subtitle">%s</%s>',
                                $subtitleTag,
                                $subtitleClass,
                                $subtitle,
                                $subtitleTag
                            ),
                            sprintf(
                                '<%s class="card-text %s" id="the-text">%s</%s>',
                                $textTag,
                                $textClass,
                                $text,
                                $textTag
                            ),
                            '</div>',
                            '</div>',
                        ],
                    ];

                    $providerData[] = [
                        'view' => 'component.card.change_section_tags',
                        'data' => [
                            'horizontal'    => true,
                            'header'        => $header,
                            'headerClass'   => $headerClass,
                            'title'         => $title,
                            'titleTag'      => $titleTag,
                            'titleClass'    => $titleClass,
                            'subtitle'      => $subtitle,
                            'subtitleTag'   => $subtitleTag,
                            'subtitleClass' => $subtitleClass,
                            'text'          => $text,
                            'textTag'       => $textTag,
                            'textClass'     => $textClass,
                        ],
                        'expects' => [
                            '<div class="card" id="the-card">',
                            '<div class="row g-0">',
                            '<div class="col-md-4">',
                            sprintf('<div class="card-header %s" id="the-header">%s</div>', $headerClass, $header),
                            '</div>',
                            '<div class="col-md-8">',
                            '<div class="card-body">',
                            sprintf(
                                '<%s class="card-title %s" id="the-title">%s</%s>',
                                $titleTag,
                                $titleClass,
                                $title,
                                $titleTag
                            ),
                            sprintf(
                                '<%s class="card-subtitle mb-2 text-muted %s" id="the-subtitle">%s</%s>',
                                $subtitleTag,
                                $subtitleClass,
                                $subtitle,
                                $subtitleTag
                            ),
                            sprintf(
                                '<%s class="card-text %s" id="the-text">%s</%s>',
                                $textTag,
                                $textClass,
                                $text,
                                $textTag
                            ),
                            '</div>',
                            '</div>',
                            '</div>',
                            '</div>',
                        ],
                    ];
                }
            }
        }

        return $providerData;
    }

    /**
     * @dataProvider provider_render
     * @param string|null $variant
     * @param string|null $title
     * @param string|null $subtitle
     * @param string|null $text
     * @param string|null $header
     * @param string|null $footer
     * @param string|null $headerImage
     * @param string|null $footerImage
     * @param array|null $attributes
     * @param array $expectedElements
     * @return void
     * @throws Exception
     */
    public function test_render(
        ?string $variant,
        ?string $title,
        ?string $subtitle,
        ?string $text,
        ?string $header,
        ?string $footer,
        ?string $headerImage,
        ?string $footerImage,
        ?array $attributes,
        array $expectedElements
    ) {

        $view = $this->nullSafeComponent(
            Card::class,
            [
                'variant'      => $variant,
                'title'        => $title,
                'subtitle'     => $subtitle,
                'text'         => $text,
                'header'       => $header,
                'footer'       => $footer,
                'headerImage'  => $headerImage,
                'footerImage'  => $footerImage,
            ],
            $attributes
        );

        $view->assertSeeInOrder(
            $expectedElements,
            false
        );
    }

    /**
     * @return array[]
     */
    public static function provider_render(): array
    {
        $faker = self::faker();

        $providerData = [];

        $providerData[] = [
            'variant'      => null,
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => null,
            'expectedElements' => [
                '<div class="card">',
                '<div class="card-body">',
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'variant'      => 'primary',
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => null,
            'expectedElements' => [
                '<div class="card text-bg-primary">',
                '<div class="card-body">',
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'variant'      => 'primary',
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => ['id' => 'this-id', 'class' => 'additional'],
            'expectedElements' => [
                '<div class="card text-bg-primary additional" id="this-id">',
                '<div class="card-body">',
                '</div>',
                '</div>',
            ],
        ];

        $attributeSets = [null, ['id' => 'this-id', 'class' => 'additional']];

        $titles = [null, $faker->words(3, true)];
        $subtitles = [null, $faker->words(4, true)];
        $texts = [null, $faker->text()];
        $headers = [null, $faker->words(2, true)];
        $footers = [null, $faker->words(5, true)];

        // the indexes correspond to the line numbers in the blade x10
        $cardExpectedElements = [
            70 => '<div class="card-body">',
            140 => '</div>',
            210 => '</div>',
        ];

        foreach ($attributeSets as $attributes) {
            $attributeExpectedElements = $cardExpectedElements;

            $attributeExpectedElements[10] = isset($attributes)
                ? sprintf('<div class="card %s" id="%s">', $attributes['class'], $attributes['id'])
                : '<div class="card">';

            foreach ($titles as $title) {
                $titleExpectedElements = $attributeExpectedElements
                    + [
                        80 => isset($title) ? sprintf('<h5 class="card-title">%s</h5>', $title) : null,
                    ];

                foreach ($subtitles as $subtitle) {
                    $subtitleExpectedElements = $titleExpectedElements
                        + [
                            90 => isset($subtitle) ? sprintf('<h6 class="card-subtitle mb-2 text-muted">%s</h6>', $subtitle) : null,
                        ];

                    foreach ($texts as $text) {
                        $textExpectedElements = $subtitleExpectedElements
                            + [
                                100 => isset($text) ? sprintf('<p class="card-text">%s</p>', $text) : null,
                            ];

                        foreach ($headers as $header) {
                            $headerExpectedElements = $textExpectedElements
                                + [
                                    30 => isset($header) ? sprintf('<div class="card-header">%s</div>', $header) : null,
                                ];
                            $headerImages = isset($header) ? [null] : [null, $faker->imageUrl()];

                            foreach ($footers as $footer) {
                                $footerExpectedElements = $headerExpectedElements
                                    + [
                                        170 => isset($footer) ? sprintf('<div class="card-footer">%s</div>', $footer) : null,
                                    ];
                                $footerImages = isset($footer) ? [null] : [null, $faker->imageUrl()];

                                foreach ($headerImages as $headerImage) {
                                    $headerImageExpectedElements = $footerExpectedElements
                                        + [
                                            50 => isset($headerImage)
                                                ? sprintf('<img class="card-img-top" src="%s" alt="Image Top">', $headerImage)
                                                : null,
                                        ];

                                    foreach ($footerImages as $footerImage) {
                                        $footerImageExpectedElements = $headerImageExpectedElements
                                            + [
                                                190 => isset($footerImage)
                                                    ? sprintf('<img class="card-img-bottom" src="%s" alt="Image Bottom">', $footerImage,)
                                                    : null,
                                            ];

                                        ksort($footerImageExpectedElements);
                                        $providerData[] = [
                                            'variant'          => null,
                                            'title'            => $title,
                                            'subtitle'         => $subtitle,
                                            'text'             => $text,
                                            'header'           => $header,
                                            'footer'           => $footer,
                                            'headerImage'      => $headerImage,
                                            'footerImage'      => $footerImage,
                                            'attributes'       => $attributes,
                                            'expectedElements' => $footerImageExpectedElements,
                                        ];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $providerData;
    }

    /**
     * This is separated from the base render method due to the separate blade used to render the content
     *
     * @dataProvider provider_render_horizontal
     * @param string|null $variant
     * @param string|null $title
     * @param string|null $subtitle
     * @param string|null $text
     * @param string|null $header
     * @param string|null $footer
     * @param string|null $headerImage
     * @param string|null $footerImage
     * @param array|null $attributes
     * @param array $expectedElements
     * @return void
     * @throws Exception
     */
    public function test_render_horizontal(
        ?string $variant,
        ?string $title,
        ?string $subtitle,
        ?string $text,
        ?string $header,
        ?string $footer,
        ?string $headerImage,
        ?string $footerImage,
        ?array $attributes,
        array $expectedElements
    ) {

        $view = $this->nullSafeComponent(
            Card::class,
            [
                'variant'      => $variant,
                'title'        => $title,
                'subtitle'     => $subtitle,
                'text'         => $text,
                'header'       => $header,
                'footer'       => $footer,
                'headerImage'  => $headerImage,
                'footerImage'  => $footerImage,
                'horizontal'   => true,
            ],
            $attributes
        );

        $view->assertSeeInOrder(
            $expectedElements,
            false
        );
    }

    /**
     * @return array[]
     */
    public static function provider_render_horizontal(): array
    {
        $faker = self::faker();

        $providerData = [];

        $providerData[] = [
            'variant'      => null,
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => null,
            'expectedElements' => [
                '<div class="card">',
                '<div class="row g-0">',
                '<div class="col-md-8">',
                '<div class="card-body">',
                '</div>',
                '</div>',
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'variant'      => 'primary',
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => null,
            'expectedElements' => [
                '<div class="card text-bg-primary">',
                '<div class="row g-0">',
                '<div class="col-md-8">',
                '<div class="card-body">',
                '</div>',
                '</div>',
                '</div>',
                '</div>',
            ],
        ];

        $providerData[] = [
            'variant'      => 'primary',
            'title'        => null,
            'subtitle'     => null,
            'text'         => null,
            'header'       => null,
            'footer'       => null,
            'headerImage'  => null,
            'footerImage'  => null,
            'attributes'   => ['id' => 'this-id', 'class' => 'additional'],
            'expectedElements' => [
                '<div class="card text-bg-primary additional" id="this-id">',
                '<div class="row g-0">',
                '<div class="col-md-8">',
                '<div class="card-body">',
                '</div>',
                '</div>',
                '</div>',
                '</div>',
            ],
        ];

        $attributeSets = [null, ['id' => 'this-id', 'class' => 'additional']];

        $titles = [null, $faker->words(3, true)];
        $subtitles = [null, $faker->words(4, true)];
        $texts = [null, $faker->text()];
        $headers = [null, $faker->words(2, true)];

        // the indexes correspond to the line numbers in the blade x10
        $cardExpectedElements = [
            70 => '<div class="card-body">',
            140 => '</div>',
            210 => '</div>',
        ];

        foreach ($attributeSets as $attributes) {
            $attributeExpectedElements = $cardExpectedElements;

            $attributeExpectedElements[10] = isset($attributes)
                ? sprintf('<div class="card %s" id="%s">', $attributes['class'], $attributes['id'])
                : '<div class="card">';

            foreach ($titles as $title) {
                $titleExpectedElements = $attributeExpectedElements
                    + [
                        80 => isset($title) ? sprintf('<h5 class="card-title">%s</h5>', $title) : null,
                    ];

                foreach ($subtitles as $subtitle) {
                    $subtitleExpectedElements = $titleExpectedElements
                        + [
                            90 => isset($subtitle) ? sprintf('<h6 class="card-subtitle mb-2 text-muted">%s</h6>', $subtitle) : null,
                        ];

                    foreach ($texts as $text) {
                        $textExpectedElements = $subtitleExpectedElements
                            + [
                                100 => isset($text) ? sprintf('<p class="card-text">%s</p>', $text) : null,
                            ];

                        foreach ($headers as $header) {
                            $headerExpectedElements = $textExpectedElements
                                + [
                                    30 => isset($header) ? sprintf('<div class="card-header">%s</div>', $header) : null,
                                ];
                            $headerImages = isset($header) ? [null] : [null, $faker->imageUrl()];

                            foreach ($headerImages as $headerImage) {
                                $headerImageExpectedElements = $headerExpectedElements
                                    + [
                                        50 => isset($headerImage)
                                            ? sprintf('<img class="img-fluid rounded-start" src="%s" alt="Image Top">', $headerImage)
                                            : null,
                                    ];

                                ksort($headerImageExpectedElements);
                                $providerData[] = [
                                    'variant'          => null,
                                    'title'            => $title,
                                    'subtitle'         => $subtitle,
                                    'text'             => $text,
                                    'header'           => $header,
                                    'footer'           => null,
                                    'headerImage'      => $headerImage,
                                    'footerImage'      => null,
                                    'attributes'       => $attributes,
                                    'expectedElements' => $headerImageExpectedElements,
                                ];
                            }
                        }
                    }
                }
            }
        }

        return $providerData;
    }
}