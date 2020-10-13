<?php

namespace Tests;

class Base64BetweenTest extends TestCase
{
    public function test_between_should_fail_when_it_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:435,535'
        ];

        $image = $this->createImageFromFile();//file has 434.66015625Kb

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_between_should_fail_when_it_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:333,433'
        ];

        $image = $this->createImageFromFile();//file has 434.66015625Kb

        $this->assertFalse($this->resoveValidator($image)->passes());
    }

    public function test_between_should_pass_when_it_is_the_range()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64between:400,500'
        ];

        $image = $this->createImageFromFile();//file has 434.66015625Kb

        $this->assertTrue($this->resoveValidator($image)->passes());
    }
}
