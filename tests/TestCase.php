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

    protected function createImage(
        string $filename = 'test.jpeg', 
        int $width = 10, 
        int $height = 10, 
        int $size = null
    ): string
    {
        $file = UploadedFile::fake()->image($filename, $width, $height);

        if ($size) {
            $file->size($size);
        }

        return $this->convertToBase64($file);
    }

    protected function createImageFromFile(string $path = __DIR__ . '/test.jpg'): string
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fileInfo, $path);

        $file = new UploadedFile(
            $path, 'test', $mime, null, true
        );

        return $this->convertToBase64($file);
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
