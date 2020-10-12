<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64SizeTest extends TestCase
{
    public function test_size_should_fail_when_it_is_value()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64size:435'
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

    public function test_size_should_pass_when_it_is_equal()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64size:434.66015625'
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
}
