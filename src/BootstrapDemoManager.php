<?php

namespace StoneHilt\Bootstrap;

use Illuminate\Support\Collection;
use Illuminate\View\Factory;

/**
 * Class BootstrapDemoManager
 *
 * @package StoneHilt\Bootstrap\Components
 */
class BootstrapDemoManager
{
    /**
     * @param string $viewDirectory
     * @param Factory $factory
     */
    public function __construct(protected string $viewDirectory, protected Factory $factory)
    {
        //
    }

    /**
     * @return string
     */
    public function getViewDirectory(): string
    {
        return $this->viewDirectory;
    }

    /**
     * @param string $viewDirectory
     * @return void
     */
    public function setViewDirectory(string $viewDirectory): void
    {
        $this->viewDirectory = $viewDirectory;
    }

    /**
     * @return Collection
     */
    public function getExampleViews(): Collection
    {
        return $this->loadExampleViews(new Collection(), $this->viewDirectory);
    }

    /**
     * @param Collection $views
     * @param string $directory
     * @return Collection
     */
    protected function loadExampleViews(Collection $views, string $directory): Collection
    {
        $dirContents = scandir($directory);

        foreach ($dirContents as $filename) {
            if ($filename === '.' || $filename === '..') {
                continue;
            }

            $fullPath = $directory . '/' . $filename;
            if (is_dir($fullPath)) {
                $this->loadExampleViews($views, $fullPath);
            } elseif (str_ends_with($filename, '.blade.php')) {
                $views[$fullPath] = new ExampleView(
                    $this->extractDescriptionFromExampleView($fullPath),
                    $this->factory,
                    $this->factory->getEngineFromPath($fullPath),
                    substr($filename, 0, -10),
                    $fullPath,
                    []
                );
            }
        }

        return $views;
    }

    /**
     * @param string $fullPath
     * @return string
     */
    protected function extractDescriptionFromExampleView(string $fullPath): string
    {
        $content = file_get_contents($fullPath);
        if (!str_starts_with($content, '{{--') || !($end = strpos($content, '--}}'))) {
            return '';
        }

        return trim(substr($content, 4, $end - 4));
    }
}