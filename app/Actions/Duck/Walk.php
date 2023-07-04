<?php

namespace App\Actions\Duck;

use App\Models\Duck;

class Walk
{
    /**
     * Creates a new walk for a given duck
     *
     * @var string $name
     */
    public static function create(string $name): void
    {
        $duck = Duck::where(['name' => $name])->firstOrFail();
        $duck->walks()->create();
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
            'Action' => 'Walk',
            'total' => $duck->walks()->count(),
            'from' => $duck->walks()->min('created_at'),
            'to' => $duck->walks()->max('created_at'),
        ];
    }
}
