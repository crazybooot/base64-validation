<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64BetweenTest extends TestCase
{
    public function test_between_should_fail_when_it_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:435,535'
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

    public function test_between_should_fail_when_it_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:333,433'
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

    public function test_between_should_pass_when_it_is_the_range()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:400,500'
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
