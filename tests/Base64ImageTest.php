<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64ImageTest extends TestCase
{
    public function test_image_should_pass_when_is_valid()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64image'
        ];

        $file = UploadedFile::fake()->image('test.jpg');

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
