<?php

namespace App\Actions\Duck;

use App\Models\Duck;

class Born
{
    /**
     * Creates a new duck and with first breath.
     *
     * @var string $name
     */
    public static function create(string $name): void
    {
        $duck = Duck::create(['name' => $name]);
        $duck->breathes()->create();
    }
}
