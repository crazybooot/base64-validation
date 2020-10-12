<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64MaxTest extends TestCase
{
    /**
     * @group base64max
     */
    public function test_max_should_pass_when_it_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:435'
        ];

        $path = __DIR__ . '/434.66015625kb.jpg';

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fileInfo, $path);

        $file = new UploadedFile(
            $path, 'test', $mime, null, true
        );

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    /**
     * @group base64max
     */
    public function test_max_should_pass_when_it_is_equal()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:434.66015625'
        ];

        $path = __DIR__ . '/434.66015625kb.jpg';

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fileInfo, $path);

        $file = new UploadedFile(
            $path, 'test', $mime, null, true
        );

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    /**
     * @group base64max
     */
    public function test_max_should_pass_when_it_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:433'
        ];

        $path = __DIR__ . '/434.66015625kb.jpg';

        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($fileInfo, $path);

        $file = new UploadedFile(
            $path, 'test', $mime, null, true
        );

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());
    }
}
