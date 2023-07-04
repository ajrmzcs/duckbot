<?php

namespace Tests\Feature\Actions;

use App\Actions\Duck\Born;
use App\Models\Duck;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BornTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function it_creates_new_duck()
    {
        $this->assertDatabaseCount('ducks', 0);
        $this->assertDatabaseCount('breaths', 0);

        Born::create('foo');

        $this->assertDatabaseCount('ducks', 1);

        $duck = Duck::firstOrFail();

        $this->assertDatabaseHas('ducks', ['name' => $duck->name]);
        $this->assertDatabaseCount('breaths', 1);
        $this->assertDatabaseHas('breaths', ['duck_id' => $duck->id]);
    }
}
