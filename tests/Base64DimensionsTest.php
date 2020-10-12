<?php

namespace Tests;

use Illuminate\Http\UploadedFile;

class Base64DimensionsTest extends TestCase
{
    public function test_dimensions_should_fail_when_min_width_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:min_width=200,min_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 199, 100);

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_dimensions_should_fail_when_min_height_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:min_width=200,min_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 200, 99);

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());

    }

    public function test_dimensions_should_pass_when_min_is_equal_or_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:min_width=200,min_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 200, 100);

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());

        $file = UploadedFile::fake()->image('test.jpg', 201, 101);

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    public function test_dimensions_should_fail_when_max_width_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:max_width=200,max_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 201, 100);

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());

    }

    public function test_dimensions_should_fail_when_max_height_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:max_width=200,max_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 200, 101);

        $image = $this->convertToBase64($file);

        $this->assertFalse($this->resoveValidator($image)->passes());

    }

    public function test_dimensions_should_pass_when_max_is_equal_or_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64dimensions:max_width=200,max_height=100'
        ];

        $file = UploadedFile::fake()->image('test.jpg', 200, 100);

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());

        $file = UploadedFile::fake()->image('test.jpg', 199, 99);

        $image = $this->convertToBase64($file);

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
