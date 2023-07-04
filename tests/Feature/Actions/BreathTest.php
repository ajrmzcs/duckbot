<?php

namespace Tests\Feature\Actions;

use App\Actions\Duck\Born;
use App\Actions\Duck\Breath;
use App\Models\Duck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BreathTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_breath(): void
    {
        $this->assertDatabaseCount('breaths', 0);

        $duck = Duck::create(['name' =>'foo']);
        Breath::create('foo');

        $this->assertDatabaseCount('breaths', 1);
        $this->assertDatabaseHas('breaths', ['duck_id' => $duck->id]);
    }

    /** @test */
    public function it_gets_a_breath_report(): void
    {
        $duck = Duck::create(['name' =>'foo']);
        Breath::create('foo');

        $report = Breath::getReport('foo');

        $this->assertEquals('Breath', $report['action']);
        $this->assertEquals('1', $report['total']);
    }
}
