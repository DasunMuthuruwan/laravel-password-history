<?php

namespace DevDasun\PasswordHistory\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\DB;

class PrunePasswordHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'password-history:prune
                            {--orphaned : Only remove records whose owning model no longer exists}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Prune old password history records beyond the configured limit, and optionally remove orphaned records';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $limit = (int) config('password-history.limit', 5);
        $table = config('password-history.table', 'password_histories');

        if ($this->option('orphaned')) {
            $this->pruneOrphaned($table);
            return self::SUCCESS;
        }

        $this->pruneBeyondLimit($table, $limit);

        return self::SUCCESS;
    }

    /**
     * Remove history rows beyond the configured limit, per owning model.
     */
    protected function pruneBeyondLimit(string $table, int $limit): void
    {
        $owners = DB::table($table)
            ->select('historyable_type', 'historyable_id')
            ->distinct()
            ->get();

        $pruned = 0;

        foreach ($owners as $owner) {
            $idsToKeep = DB::table($table)
                ->where('historyable_type', $owner->historyable_type)
                ->where('historyable_id', $owner->historyable_id)
                ->orderByDesc('created_at')
                ->limit($limit)
                ->pluck('id');

            $deleted = DB::table($table)
                ->where('historyable_type', $owner->historyable_type)
                ->where('historyable_id', $owner->historyable_id)
                ->whereNotIn('id', $idsToKeep)
                ->delete();

            $pruned += $deleted;
        }

        $this->info("Pruned {$pruned} password history record(s) beyond the limit of {$limit}.");
    }

    /**
     * Remove history rows whose owning model no longer exists
     * (e.g. a User was force-deleted without cascading).
     */
    protected function pruneOrphaned(string $table): void
    {
        $owners = DB::table($table)
            ->select('historyable_type', 'historyable_id')
            ->distinct()
            ->get()
            ->groupBy('historyable_type');

        $pruned = 0;

        foreach ($owners as $type => $rows) {
            $modelClass = Relation::getMorphedModel($type) ?? $type;

            if (! class_exists($modelClass)) {
                continue;
            }

            $existingIds = $modelClass::query()
                ->whereIn('id', $rows->pluck('historyable_id'))
                ->pluck('id');

            $missingIds = $rows->pluck('historyable_id')->diff($existingIds);

            if ($missingIds->isEmpty()) {
                continue;
            }

            $deleted = DB::table($table)
                ->where('historyable_type', $type)
                ->whereIn('historyable_id', $missingIds)
                ->delete();

            $pruned += $deleted;
        }

        $this->info("Pruned {$pruned} orphaned password history record(s).");
    }
}
