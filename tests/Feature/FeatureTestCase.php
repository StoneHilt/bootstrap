<?php

namespace StoneHilt\Bootstrap\Tests\Feature;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Testing\Assert as PHPUnit;
use Illuminate\Testing\Constraints\SeeInOrder;
use Illuminate\Testing\TestComponent;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;
use Illuminate\View\ComponentSlot;
use Illuminate\View\View;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Util\Exporter;
use StoneHilt\Bootstrap\Components\Base;
use StoneHilt\Bootstrap\Components\Col;
use StoneHilt\Bootstrap\Tests\TestCase;

/**
 * Class FeatureTestCase
 *
 * @package StoneHilt\Bootstrap\Tests\Feature
 */
class FeatureTestCase extends TestCase
{
    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->afterApplicationCreated(
            function () {
                $this->app->make(PackageManifest::class)->build();
            }
        );

        \Illuminate\Foundation\Testing\RefreshDatabaseState::$migrated = true;
        parent::setUp();
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    protected static function baseVariants(): array
    {
        return (new \ReflectionClass(Base::class))->getProperty('variants')->getDefaultValue();
    }

    /**
     * @param string $componentClass
     * @param $data
     * @param array|null $attributes
     * @param string|null $slot
     * @return TestComponent
     * @throws Exception
     */
    protected function nullSafeComponent(string $componentClass, $data = [], ?array $attributes = null, ?string $slot = null): TestComponent
    {
        return $this->component(
            $componentClass,
            $this->filterData($data),
            isset($attributes) ? new ComponentAttributeBag($attributes) : null,
            isset($slot) ? new ComponentSlot($slot) : null
        );
    }

    /**
     * @param string $componentClass
     * @param array $data
     * @param ComponentAttributeBag|null $attributes
     * @param ComponentSlot|null $slot
     * @return TestComponent
     * @throws Exception
     */
    protected function component(string $componentClass, $data = [], ?ComponentAttributeBag $attributes = null, ?ComponentSlot $slot = null)
    {
        $component = $this->app->make($componentClass, $data);

        $viewData = $component->data();

        if (isset($slot)) {
            $viewData['slot'] = $slot;
        } else {
            $viewData['slot'] = $data['slot'] ?? new ComponentSlot();
        }

        if (isset($attributes)) {
            $viewData['attributes'] = $attributes;
        } else {
            $viewData['attributes'] = $data['attributes'] ?? new ComponentAttributeBag();
        }

        $resolved = value($component->resolveView(), $viewData);

        if ($resolved instanceof Htmlable) {
            $view = $this->createPartialMock(View::class, ['render']);
            $view->method('render')->willReturn($resolved);
        } else {
            $view = $resolved instanceof View
                ? $resolved->with($viewData)
                : view($resolved, $viewData);
        }

        return new TestComponent($component, $view);
    }

    /**
     * @param TestComponent $testComponent
     * @param array $values
     * @param bool $escape
     * @return void
     */
    protected function componentOnlySees(TestComponent $testComponent, array $values, bool $escape = true): void
    {
        $values = $escape ? array_map('e', $values) : $values;
        $rendered = $testComponent->__toString();

        PHPUnit::assertThat($values, new SeeInOrder($testComponent->__toString()));

        $rendered = trim($rendered);
        foreach ($values as $value) {
            if (!str_starts_with($rendered, $value)) {
                PHPUnit::fail(
                    sprintf(
                        "Failed asserting that \n'%s'\nonly contains: %s\nProblem with value '%s'\n  and rendering line '%s'",
                        trim($testComponent->__toString()),
                        substr(print_r($values, true), 7, -2),
                        $value,
                        $rendered
                    )
                );
            }

            $rendered = trim(substr($rendered, strlen($value)));
        }

        if (trim($rendered) !== '') {
            PHPUnit::fail(
                sprintf(
                    "Failed asserting that \n%s'\nonly contains: %s\nExtra data '%s'",
                    trim($testComponent->__toString()),
                    substr(print_r($values, true), 7, -2),
                    $rendered
                )
            );
        }
    }

    /**
     * @param array $data
     * @return array
     */
    protected function filterData(array $data): array
    {
        return array_filter(
            $data,
            fn($value) => isset($value)
        );
    }
}