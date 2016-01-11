<?php

namespace tests\Console\Commands\Role;

use Illuminate\Support\Facades\Artisan;
use \TestCase;

/**
 * Class ListCommandTest
 * @package tests\Console\Commands\Role
 */
class ListCommandTest extends TestCase
{
    public function testNetBlockListCommand()
    {
        $exitCode = Artisan::call(
            'role:list',
            [
                //
            ]
        );

        $this->assertEquals($exitCode, 0);
        $this->assertContains("System Administrator", Artisan::output());
    }

    public function testNetBlockListCommandWithValidFilter()
    {
        $exitCode = Artisan::call(
            'role:list',
            [
                "--filter" => "Abuse"
            ]
        );

        $this->assertEquals($exitCode, 0);

        $output = Artisan::output();
        $this->assertContains("Abuse", $output);
        $this->assertNotContains("System Administrator", $output);
    }
}
