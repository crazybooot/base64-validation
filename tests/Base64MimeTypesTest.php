<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64MimeTypesTest extends TestCase
{
    public function test_mimetypes_should_fail_when_type_is_not_allowded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64mimetypes:image/jpeg,image/bmp'
        ];

        $file = UploadedFile::fake()->image('test.png');

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_mimetypes_should_pass_when_type_is_allowded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64mimetypes:image/jpeg,image/bmp,image/png'
        ];

        $file = UploadedFile::fake()->image('test.jpeg');

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
