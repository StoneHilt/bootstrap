<?php

namespace StoneHilt\Bootstrap;

use Illuminate\Contracts\View\Engine;
use Illuminate\View\Factory;
use Illuminate\View\View;

/**
 * Class ExampleView
 *
 * @package StoneHilt\Bootstrap
 */
class ExampleView extends View
{
    /**
     * @var string $description
     */
    protected string $description;

    /**
     * @var array $expectedData
     */
    protected array $expectedData = [];

    /**
     * @var string|null
     */
    protected ?string $primaryComponent = null;

    /**
     * @var array
     */
    protected array $secondaryComponents = [];

    /**
     * @param string $annotation
     * @param Factory $factory
     * @param Engine $engine
     * @param $view
     * @param $path
     * @param $data
     */
    public function __construct(
        protected string $annotation,
        Factory $factory,
        Engine $engine,
        $view,
        $path,
        $data = []
    ) {
        parent::__construct($factory, $engine, $view, $path, $data);

        $this->parseAnnotation($this->annotation);
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getExpectedData(): array
    {
        return $this->expectedData;
    }

    /**
     * @param array $expectedData
     * @return void
     */
    public function setExpectedData(array $expectedData): void
    {
        $this->expectedData = $expectedData;
    }

    /**
     * @return string|null
     */
    public function getPrimaryComponent(): ?string
    {
        return $this->primaryComponent;
    }

    /**
     * @param string|null $primaryComponent
     * @return void
     */
    public function setPrimaryComponent(?string $primaryComponent): void
    {
        $this->primaryComponent = $primaryComponent;
    }

    /**
     * @return array
     */
    public function getSecondaryComponents(): array
    {
        return $this->secondaryComponents;
    }

    /**
     * @param array $secondaryComponents
     * @return void
     */
    public function setSecondaryComponents(array $secondaryComponents): void
    {
        $this->secondaryComponents = $secondaryComponents;
    }

    /**
     * @param string $annotation
     * @return void
     */
    protected function parseAnnotation(string $annotation): void
    {
        $lines = explode("\n", $annotation);

        foreach ($lines as $index => $line) {
            $line = trim($line);

            if (!str_starts_with($line, '@')) {
                continue;
            }

            switch (strstr($line, ' ', true)) {
                case '@var':
                    unset($lines[$index]);
                    $details = explode(' ', $line, 3);

                    $this->expectedData[substr($details[2], 1)] = [
                        'type'     => $details[1],
                        'variable' => $details[2],
                        'label'    => $details[3] ?? null
                    ];
                    break;

                case '@package':
                    unset($lines[$index]);
                    $this->primaryComponent = substr($line, 9);
                    break;

                case '@subpackage':
                    unset($lines[$index]);
                    $this->secondaryComponents[] = substr($line, 12);
                    break;
            }
        }

        $this->description = implode("\n", $lines);
    }
}
