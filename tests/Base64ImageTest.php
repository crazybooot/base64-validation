<?php

namespace Tests;

class Base64ImageTest extends TestCase
{
    public function test_image_should_pass_when_is_valid()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64image'
        ];

        $image = $this->createImage();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
