<?php

namespace StoneHilt\Bootstrap\Components;

use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\View\ComponentAttributeBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Form
 *
 * @package StoneHilt\Bootstrap\Components
 */
class Form extends Base
{
    /**
     * @var array|string[]
     */
    protected static array $methods = [
        Request::METHOD_GET,
        Request::METHOD_POST,
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE,
    ];

    /**
     * @var array $spoofedMethods
     */
    protected static array $spoofedMethods = [
        Request::METHOD_DELETE,
        Request::METHOD_PATCH,
        Request::METHOD_PUT,
    ];

    /**
     * @var string $viewName
     */
    protected string $viewName = 'bootstrap::form';

    /**
     * @param string|null $method
     * @param string|null $action
     * @param string|array|null $route
     */
    public function __construct(
        public ?string $method = null,
        public ?string $action = null,
        public string|array|null $route = null,
    ) {
        parent::__construct();
    }

    /**
     * @return bool
     */
    public function spoofMethod(): bool
    {
        return in_array($this->method, static::$spoofedMethods);
    }

    /**
     * @return bool
     */
    public function includeCsrf(): bool
    {
        return $this->method !== Request::METHOD_GET;
    }

    /**
     * @param array $viewData
     * @return array
     * @throws UrlGenerationException
     */
    protected function transformViewData(array $viewData): array
    {
        if (isset($viewData['route'])) {
            [$this->method, $this->action] = $this->determineMethodUriFromRoute($viewData['route']);
        }

        return parent::transformViewData(
            array_merge(
                $viewData,
                [
                    'method' => $this->method,
                    'action' => $this->action,
                ]
            )
        );
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
            $attributes->merge(
                [
                    'method' => in_array($this->method, static::$spoofedMethods) ? Request::METHOD_POST : $this->method,
                    'action' => $this->action,
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
            'method' => ['nullable', 'required_without_all:route', Rule::in(static::$methods)],
            'action' => ['nullable', 'required_without_all:route'],
            'route'  => ['nullable', 'required_without_all:method,action'],
        ];
    }

    /**
     * @param array|string $name
     * @return array
     * @throws UrlGenerationException
     */
    protected function determineMethodUriFromRoute(array|string $name): array
    {
        $parameters = [];
        if (is_array($name)) {
            [$name, $parameters] = $name + ['', []];
        }

        $route = app('router')
            ->getRoutes()
            ->getByName($name);

        $method = Arr::first($route->methods());

        $uri = app('url')->toRoute($route, $parameters, true);

        return [$method, $uri];
    }
}
