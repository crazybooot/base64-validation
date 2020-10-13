<?php

namespace Tests;

class Base64MaxTest extends TestCase
{
    /**
     * @group base64max
     */
    public function test_max_should_pass_when_it_is_smaller()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:435'
        ];

        $image = $this->createImageFromFile();

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    /**
     * @group base64max
     */
    public function test_max_should_pass_when_it_is_equal()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:434.66015625'
        ];

        $image = $this->createImageFromFile();//file has 434.66015625Kb

        $this->assertTrue($this->resoveValidator($image)->passes());
    }

    /**
     * @group base64max
     */
    public function test_max_should_fail_when_it_is_greater()
    {
        $this->rules = [
            static::ATTRIBUTE => 'base64max:433'
        ];

        $image = $this->createImageFromFile();//file has 434.66015625Kb

        $this->assertFalse($this->resoveValidator($image)->passes());
    }
}
