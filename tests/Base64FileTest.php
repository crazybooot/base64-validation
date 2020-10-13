<?php

namespace Tests;

class Base64FileTest extends TestCase
{
    public function test_file_should_pass_when_is_uploaded()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64file'
        ];

        $image = $this->createImage();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
