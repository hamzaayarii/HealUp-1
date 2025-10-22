<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportRecommendations extends Command
{
    protected $signature = 'recs:import {--path= : Path to CSV relative to storage/app}';

    protected $description = 'Import model-produced top-N recommendations (CSV) into user_recommendations table';

    public function handle()
    {
        $relative = $this->option('path') ?? 'recommendations/model_output.csv';
        $fullPath = storage_path('app/' . $relative);

        if (!file_exists($fullPath)) {
            $this->error('File not found: ' . $fullPath);
            return 1;
        }

        $this->info('Importing recommendations from: ' . $fullPath);

        $handle = fopen($fullPath, 'r');
        $header = fgetcsv($handle);

        // Expecting header: user_id,challenge_id,score
        DB::transaction(function() use ($handle) {
            // Clear existing recommendations
            DB::table('user_recommendations')->truncate();

            while ($row = fgetcsv($handle)) {
                if (!isset($row[0]) || !isset($row[1])) continue;
                DB::table('user_recommendations')->insert([
                    'user_id' => (int)$row[0],
                    'challenge_id' => (int)$row[1],
                    'score' => isset($row[2]) ? (float)$row[2] : 0,
                    'source' => 'model',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });

        fclose($handle);
        $this->info('Import complete.');
        return 0;
    }
}
