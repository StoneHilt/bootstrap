<?php

namespace StoneHilt\Bootstrap\Tests\Feature;

use Illuminate\Support\Collection;
use StoneHilt\Bootstrap\BootstrapDemoManager;
use StoneHilt\Bootstrap\ExampleView;

/**
 * Class BootstrapDemoManagerTest
 *
 * @package StoneHilt\Bootstrap\Tests\Feature
 */
class BootstrapDemoManagerTest extends FeatureTestCase
{
    /**
     * @var array $selectExamples Example Views that have specific characteristics
     */
    protected static array $selectExamples = [
        '/component/navbar/collapse_left_right.blade.php' => [
            'expectedData' => [],
            'primaryComponent' => 'x-bootstrap::form.control',
            'secondaryComponents' => [
                'x-slot:left',
                'x-slot:right',
                'x-bootstrap::component.navbar.brand',
                'x-bootstrap::component.navbar.toggler',
                'x-bootstrap::component.navbar.collapse',
            ],
        ],
        '/form/control/datalist.blade.php' => [
            'expectedData' => [
                'label',
                'name',
                'datalist',
            ],
            'primaryComponent' => 'x-bootstrap::form.control',
            'secondaryComponents' => [],
        ],
    ];

    /**
     * @return void
     */
    public function test_getExampleViews()
    {
        $demoManager = $this->app->make(BootstrapDemoManager::class);
        $viewDirectory = $demoManager->getViewDirectory();

        $views = $demoManager->getExampleViews();

        $this->assertInstanceOf(Collection::class, $views);

        foreach ($views as $exampleView) {
            $this->assertInstanceOf(
                ExampleView::class,
                $exampleView
            );

            $blade = str_replace($viewDirectory, '', $exampleView->getPath());

            if (isset(static::$selectExamples[$blade])) {
                $this->assertNotEmpty($exampleView->getDescription());

                $this->assertEquals(
                    static::$selectExamples[$blade]['expectedData'],
                    array_keys($exampleView->getExpectedData())
                );

                $this->assertEquals(
                    static::$selectExamples[$blade]['primaryComponent'],
                    $exampleView->getPrimaryComponent()
                );

                $this->assertEquals(
                    static::$selectExamples[$blade]['secondaryComponents'],
                    $exampleView->getSecondaryComponents()
                );
            }
        }
    }
}
