<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64MimesTest extends TestCase
{
    public function test_mimes_should_fail_when_extension_is_not_allowded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64mimes:jpeg,bmp'
        ];

        $file = UploadedFile::fake()->image('test.png');

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_mimes_should_pass_when_extension_is_allowded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64mimes:jpeg,bmp,png'
        ];

        $file = UploadedFile::fake()->image('test.jpg');

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
