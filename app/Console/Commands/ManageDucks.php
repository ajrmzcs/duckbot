<?php

namespace App\Console\Commands;

use App\Actions\Duck\Born;
use App\Actions\Duck\Breath;
use App\Actions\Duck\Eat;
use App\Actions\Duck\Walk;
use App\Models\Duck;
use Illuminate\Console\Command;

class ManageDucks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duck:manage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Manage your duck bots. Enjoy!!';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->mainMenu();
    }

    /**
     * Command's main menu .
     */
    protected function mainMenu(): void
    {
        $options = ['A duckling is born', 'View my ducks', 'Good bye'];

        $selectedOption = $this->choice('Select an option', $options);

        match ($selectedOption)
        {
            'A duckling is born' => $this->born(),
            'View my ducks' => $this->view(),
            'Good bye' => $this->info('Good bye!!'),
            'default' => $this->error('Invalid option selected.'),
        };
    }

    /**
     * Create a new duck.
     */
    protected function born(): void
    {
        if (!$this->confirm('Do you want to create a new Duck?')) {
            exit('Good bye');
        }

        $name = $this->ask("What's the duck's name?");

        Born::create($name);

        $this->info('You have create a new duck');

        $this->mainMenu();
    }

    /**
     * View a list of ducks.
     */
    protected function view(): void
    {
        $this->info('These are your ducks...');

        $options = Duck::all()->pluck('name')->toArray();

        $selectedDuck = $this->choice('Select a duck', $options);

        $this->info("These are the actions for $selectedDuck");

        $action = $this->choice('Select one', [
            'breath',
            'walk',
            'eat',
            'report',
        ]);

        match ($action)
        {
            'breath' => $this->breath($selectedDuck),
            'walk' => $this->walk($selectedDuck),
            'eat' => $this->eat($selectedDuck),
            'report' => $this->report($selectedDuck),
            'default' => $this->error('invalid option'),
        };

        $this->mainMenu();
    }

    /**
     * Add a breath to a given duck.
     */
    protected function breath(string $name): void
    {
        Breath::create($name);
        $this->info("$name just breathed");
    }

    /**
     * Add a walk to a given duck.
     */
    protected function walk(string $name): void
    {
        Walk::create($name);
        $this->info("$name just walked");
    }

    /**
     * Add an eat to a given duck.
     */
    protected function eat(string $name): void
    {
        Eat::create($name);
        $this->info("$name just ate");
    }

    /**
     * Creates a report of actions for a given duck.
     */
    protected function report(string $name): void
    {
        $breaths = Breath::getReport($name);
        $walks = Walk::getReport($name);
        $eats = Eat::getReport($name);

        $this->info("Report for $name:");
        $this->table(['Action', 'Qty', 'Min-Date', 'Max-date'], [$breaths, $walks, $eats]);
    }
}
