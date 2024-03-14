<?php

namespace StoneHilt\Bootstrap\Tests\Feature\Components;

use Avastechnology\Iolaus\Traits\InvokeMethod;
use Illuminate\Routing\Router;
use PHPUnit\Framework\MockObject\Exception;
use StoneHilt\Bootstrap\Components\Form;
use StoneHilt\Bootstrap\Tests\Feature\FeatureTestCase;

/**
 * Class FormTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature\Components
 */
class FormTest extends FeatureTestCase
{
    use InvokeMethod;

    /**
     * @var array|array[] $routes
     */
    protected static array $routes = [
        [
            'methods' => 'GET',
            'uri'     => '/page',
            'name'    => 'page.index',
        ],
        [
            'methods' => 'POST',
            'uri'     => '/page',
            'name'    => 'page.create',
        ],
        [
            'methods' => 'GET',
            'uri'     => '/page/{page}',
            'name'    => 'page.show',
        ],
        [
            'methods' => 'GET',
            'uri'     => '/page/{page}/edit',
            'name'    => 'page.edit',
        ],
        [
            'methods' => 'PUT',
            'uri'     => '/page/{page}',
            'name'    => 'page.update',
        ],
        [
            'methods' => 'DELETE',
            'uri'     => '/page/{page}',
            'name'    => 'page.destroy',
        ],
    ];

    /**
     * @dataProvider provider_render
     * @param string|null $method
     * @param string|null $action
     * @param string|array|null $route
     * @param array|null $attributes
     * @param string|null $slot
     * @param string|null $spoofMethod
     * @param bool $includeCsrf
     * @param string $expectOpening
     * @return void
     * @throws Exception
     */
    public function test_render(
        ?string $method,
        ?string $action,
        string|array|null $route,
        ?array $attributes,
        ?string $slot,
        ?string $spoofMethod,
        bool $includeCsrf,
        string $expectOpening
    ) {
        $this->configureRoutes();

        $data = [
            'method' => $method,
            'action' => $action,
            'route'  => $route,
        ];

        $view = $this->nullSafeComponent(Form::class, $data, $attributes, $slot);

        $view->assertSeeInOrder(
            [
                $expectOpening,
                $spoofMethod ? sprintf('<input type="hidden" name="_method" value="%s" />', $spoofMethod) : '',
                $includeCsrf ? '<input type="hidden" name="_token" value="" autocomplete="off">' : '',
                $slot ?? '',
                '</form>'
            ],
            false
        );

        if (!$spoofMethod) {
            $view->assertDontSee(
                '<input type="hidden" name="_method"',
                false
            );
        }

        if (!$includeCsrf) {
            $view->assertDontSee(
                '<input type="hidden" name="_token"',
                false
            );
        }
    }

    /**
     * @return array
     */
    public static function provider_render(): array
    {
        return [
            [
                'method'        => 'GET',
                'action'        => '/page',
                'route'         => null,
                'attributes'    => ['id' => 'get-index'],
                'slot'          => 'Form controls and content',
                'spoofMethod'   => null,
                'includeCsrf'   => false,
                'expectOpening' => '<form method="GET" action="/page" id="get-index">',
            ],
            [
                'method'        => 'POST',
                'action'        => '/page/2',
                'route'         => null,
                'attributes'    => ['id' => 'post-2'],
                'slot'          => 'Form controls and content',
                'spoofMethod'   => null,
                'includeCsrf'   => true,
                'expectOpening' => '<form method="POST" action="/page/2" id="post-2">',
            ],
            [
                'method'        => null,
                'action'        => null,
                'route'         => 'page.create',
                'attributes'    => ['id' => 'route-create'],
                'slot'          => 'Form controls and content',
                'spoofMethod'   => null,
                'includeCsrf'   => true,
                'expectOpening' => '<form method="POST" action="http://localhost/page" id="route-create">',
            ],
            [
                'method'        => null,
                'action'        => null,
                'route'         => ['page.update', '356'],
                'attributes'    => ['id' => 'route-update-356'],
                'slot'          => 'Form controls and content',
                'spoofMethod'   => 'PUT',
                'includeCsrf'   => true,
                'expectOpening' => '<form method="POST" action="http://localhost/page/356" id="route-update-356">',
            ],
        ];
    }

    /**
     * @dataProvider provider_determineMethodUriFromRoute
     * @param array|string $name
     * @param array $expected
     * @return void
     * @throws Exception
     * @throws \ReflectionException
     */
    public function test_determineMethodUriFromRoute(array|string $name, array $expected)
    {
        $this->configureRoutes();

        $form = $this->createPartialMock(Form::class, []);

        $this->assertEquals(
            $expected,
            $this->invokeMethod($form, 'determineMethodUriFromRoute', [$name])
        );
    }

    /**
     * @return array[]
     */
    public static function provider_determineMethodUriFromRoute(): array
    {
        return [
            [
                'name'     => 'page.create',
                'expected' => [
                    'POST',
                    'http://localhost/page',
                ],
            ],
            [
                'name'     => [
                    'page.show',
                    '123',
                ],
                'expected' => [
                    'GET',
                    'http://localhost/page/123',
                ],
            ],
        ];
    }

    /**
     * @return void
     */
    protected function configureRoutes(): void
    {
        /** @var Router $router */
        $router = $this->app->make('router');

        foreach (static::$routes as $definition) {
            $router->addRoute($definition['methods'], $definition['uri'], function () {})
                ->name($definition['name']);
        }

        $router->getRoutes()->refreshNameLookups();
    }
}