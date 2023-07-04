<?php

namespace App\Actions\Duck;

use App\Models\Duck;

class Breath
{
    /**
     * Creates a new breath for a given duck
     *
     * @var string $name
     */
    public static function create(string $name): void
    {
        $duck = Duck::where(['name' => $name])->firstOrFail();
        $duck->breathes()->create();
    }

    /**
     * Generates a report for a given duck
     *
     * @var string $name
     */
    public static function getReport(string $name): array
    {
        $duck = Duck::where(['name' => $name])->firstOrFail();

        return [
            'action' => 'Breath',
            'total' => $duck->breathes()->count(),
            'from' => $duck->breathes()->min('created_at'),
            'to' => $duck->breathes()->max('created_at'),
        ];
    }
}
