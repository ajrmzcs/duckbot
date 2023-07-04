<?php

namespace Tests\Feature;

use Tests\TestCase;

class ManageDucksTest extends TestCase
{
    /** @test */
    public function it_runs_manage_ducks_command()
    {
        $this->artisan('duck:manage')
            ->expectsChoice('Select an option', 'Good bye', ['A duckling is born', 'View my ducks', 'Good bye'])
            ->expectsOutputToContain('Good bye!!')
            ->assertExitCode(0);
    }
}
