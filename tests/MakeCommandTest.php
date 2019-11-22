<?php

namespace ABCreche\Printer\Test;

class MakeCommandTest extends TestCase
{

    /** @test */
    function make_command_returns_success()
    {
        $this->artisan('make:print', ['name' => 'TestDocument'])
            ->assertExitCode(0);
    }
}
