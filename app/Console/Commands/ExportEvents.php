<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class ExportEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export all events to python_ai/events.json for AI module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::all();
        $path = base_path('python_ai/events.json');
        file_put_contents($path, $events->toJson(JSON_PRETTY_PRINT));
        $this->info('Events exported to python_ai/events.json');
    }
}
