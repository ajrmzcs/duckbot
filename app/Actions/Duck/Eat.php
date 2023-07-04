<?php

namespace App\Actions\Duck;

use App\Models\Duck;

class Eat
{
    /**
     * Creates a new eat for a given duck
     *
     * @var string $name
     */
    public static function create(string $name): void
    {
        $duck = Duck::where(['name' => $name])->firstOrFail();
        $duck->eats()->create();
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
            'action' => 'Eat',
            'total' => $duck->eats()->count(),
            'from' => $duck->eats()->min('created_at'),
            'to' => $duck->eats()->max('created_at'),
        ];
    }
}
