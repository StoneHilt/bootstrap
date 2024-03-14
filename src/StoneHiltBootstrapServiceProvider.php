<?php

namespace StoneHilt\Bootstrap;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Foundation\PackageManifest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class StoneHiltBootstrapServiceProvider
 *
 * @package StoneHilt
 */
class StoneHiltBootstrapServiceProvider extends ServiceProvider
{
    protected static string $packageConfigFile = __DIR__.'/../config/bootstrap.php';
    protected static string $packageResourceViews = __DIR__.'/../resources/views';

    /**
     * Bootstrap your package's services.
     */
    public function boot(): void
    {
        $this->addCommandDetails();
        $this->addConfiguration();
        $this->addComponentViews();
    }

    /**
     * @return void
     */
    protected function addCommandDetails(): void
    {
        AboutCommand::add(
            'StoneHilt Bootstrap',
            function () {
                $details = [];

                $json = json_decode(file_get_contents(__DIR__ . '/../composer.json'), true);
                $details['Version'] = $json['version'];

                $config = config('stonehilt.bootstrap');

                $details['Bootstrap Version'] = $config['version'];

                if (isset($config['icons_version'])) {
                    $details['Bootstrap Icons Version'] = $config['icons_version'];
                }

                $packageManifest = $this->app->make(PackageManifest::class);

                $jsPackage = $this->getComposerPackages($packageManifest)->get('twbs/bootstrap');

                if (!empty($jsPackage)) {
                    $details['Bootstrap Installed Version'] = $jsPackage['version_normalized'] ?? $jsPackage['version'];
                } else {
                    $details['Bootstrap Installed Version'] = 'N/A';
                }

                $details['Views published'] = $packageManifest->files->exists(resource_path('views/vendor/bootstrap'))
                    ? 'true'
                    : 'false';

                return $details;
            }
        );
    }

    /**
     * @return void
     */
    protected function addConfiguration(): void
    {
        $this->mergeConfigFrom(static::$packageConfigFile, 'stonehilt.bootstrap');

        $this->publishes(
            [
                static::$packageConfigFile => config_path('stonehilt/bootstrap.php'),
            ],
            'bootstrap-config',
        );
    }

    /**
     * @return void
     */
    protected function addComponentViews(): void
    {
        $this->loadViewsFrom(static::$packageResourceViews, 'bootstrap');

        Blade::componentNamespace('StoneHilt\\Bootstrap\\Components', 'bootstrap');
        Blade::anonymousComponentPath(static::$packageResourceViews, 'bootstrap');

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    static::$packageResourceViews => resource_path('views/vendor/bootstrap'),
                ],
                'bootstrap-views',
            );

            $publicAssets = [];

            $config = config('stonehilt.bootstrap');

            if (isset($config['css_source']) && !str_contains($config['css_source'], '://')) {
                $source = base_path($config['css_source']);

                $publicAssets[$source] = public_path('vendor/bootstrap/css');
            }

            if (isset($config['js_source']) && !str_contains($config['js_source'], '://')) {
                $source = base_path($config['js_source']);
                $publicAssets[$source] = public_path('vendor/bootstrap/js');
            }

            if (isset($config['icons_source']) && !str_contains($config['icons_source'], '://')) {
                $source = base_path($config['icons_source']);
                $publicAssets[$source] = public_path('vendor/bootstrap/icons');
            }

            if (!empty($publicAssets)) {
                $this->publishes($publicAssets, 'bootstrap-assets');
            }
        }
    }

    /**
     * @param PackageManifest $packageManifest
     * @return Collection
     * @throws FileNotFoundException
     */
    protected function getComposerPackages(PackageManifest $packageManifest): Collection
    {
        if (!$packageManifest->files->exists($path = $packageManifest->vendorPath . '/composer/installed.json')) {
            return collect([]);
        }

        $installed = json_decode($packageManifest->files->get($path), true);

        $packages = $installed['packages'] ?? $installed;

        return collect($packages)->mapWithKeys(
            function ($package) use ($packageManifest) {
                $name = str_replace($packageManifest->vendorPath.'/', '', $package['name']);
                return [$name => $package];
            }
        );
    }
}
