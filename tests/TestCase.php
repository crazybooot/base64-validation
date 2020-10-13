<?php

namespace Tests;

use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Crazybooot\Base64Validation\Providers\ServiceProvider;

class TestCase extends OrchestraTestCase
{
    const ATTRIBUTE = 'image';

    public function setUp(): void
    {
        parent::setUp();

        $this->loadLaravelMigrations(['--database' => 'testing']);

        $this->loadMigrationsFrom([
            '--database' => 'testing',
            '--path' => realpath(__DIR__ . '/migrations'),
        ]);
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testing');
    }

    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function resoveValidator($value)
    {
        return $this->app['validator']->make(
            [self::ATTRIBUTE => $value], 
            [self::ATTRIBUTE => $this->rules[self::ATTRIBUTE]]
        );
    }

    protected function convertToBase64(UploadedFile $file): string
    {
        return $this->resolveImageManager()->make($file)
            ->response('data-url')
            ->getContent();
    }

    private function resolveImageManager(): ImageManager
    {
        return new ImageManager(['driver' => 'imagick']);
    }
}
