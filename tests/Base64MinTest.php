<?php

namespace Tests;

class Base64MinTest extends TestCase
{
    public function test_min_should_fail_when_it_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64min:435'
        ];

        $image = $this->createImageFromFile();

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_min_should_pass_when_it_is_equal()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64min:434'
        ];

        $image = $this->createImageFromFile();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    public function test_min_should_pass_when_it_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64min:433'
        ];

        $image = $this->createImageFromFile();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
