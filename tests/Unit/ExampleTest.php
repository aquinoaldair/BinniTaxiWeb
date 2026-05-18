<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_tests_directory_exists(): void
    {
        $this->assertDirectoryExists(__DIR__);
    }
}
