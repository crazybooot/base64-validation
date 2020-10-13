<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64SizeTest extends TestCase
{
    public function test_size_should_fail_when_it_is_value()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64size:1000'
        ];

        $image = $this->createImageFromFile();

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_size_should_pass_when_it_is_equal()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64size:434.66015625'
        ];

        $image = $this->createImageFromFile();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
