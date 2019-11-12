<?php

namespace ABCreche\Printer\Test;

use ABCreche\Printer\Printer;

class PrintServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function is_bound()
    {
        $this->assertTrue($this->app->bound('printer'));
    }

    /**
     * @test
     */
    public function has_aliased()
    {
        $this->assertTrue($this->app->isAlias(Printer::class));
        $this->assertEquals('printer', $this->app->getAlias(Printer::class));
    }
}
