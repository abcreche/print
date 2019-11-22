<?php

namespace ABCreche\Printer\Test;

class MakeCommandTest extends TestCase
{

    /** @test */
    function make_command_returns_success()
    {
        $this->artisan('make:print TestDocument')
            ->expectsOutput('Printable Document created successfully.');
    }
}
