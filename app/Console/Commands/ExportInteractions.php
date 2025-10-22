<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExportInteractions extends Command
{
    protected $signature = 'recs:export {--path= : Output path relative to storage/app}';

    protected $description = 'Export recommendation interaction events and participations to CSV for model training';

    public function handle()
    {
        $relative = $this->option('path') ?? 'recommendations/interactions.csv';
        $fullPath = storage_path('app/' . $relative);

        // Ensure directory exists
        if (!file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        $this->info('Exporting interactions to: ' . $fullPath);

        $handle = fopen($fullPath, 'w');
        // CSV header
        fputcsv($handle, ['user_id', 'challenge_id', 'interaction', 'timestamp']);

        // Export participations (strong positive signal)
        $participations = DB::table('participations')->select('user_id', 'challenge_id', 'created_at');
        foreach ($participations->cursor() as $p) {
            fputcsv($handle, [$p->user_id, $p->challenge_id, 2, $p->created_at]); // weight 2
        }

        // Export recommendation_events (clicks -> positive, impressions -> weak)
        $events = DB::table('recommendation_events')->select('user_id', 'challenge_id', 'type', 'created_at');
        foreach ($events->cursor() as $e) {
            if ($e->type === 'impression') {
                $weight = $e->challenge_id ? 1 : 0;
                $cid = $e->challenge_id;
            } elseif ($e->type === 'click') {
                $weight = 2;
                $cid = $e->challenge_id;
            } else {
                $weight = 1;
                $cid = $e->challenge_id;
            }

            if ($e->user_id && $cid) {
                fputcsv($handle, [$e->user_id, $cid, $weight, $e->created_at]);
            }
        }

        fclose($handle);
        $this->info('Export complete.');
        return 0;
    }
}
