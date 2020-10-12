<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64FileTest extends TestCase
{
    public function test_file_should_pass_when_is_uploaded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64file'
        ];

        $file = UploadedFile::fake()->image('test.jpg');

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
