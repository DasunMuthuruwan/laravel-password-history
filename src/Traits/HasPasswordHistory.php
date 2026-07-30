<?php

namespace DevDasun\PasswordHistory\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Hash;
use YourVendor\PasswordHistory\Models\PasswordHistory;

trait HasPasswordHistory
{
    /**
     * Get password histories latest record
     * @return MorphMany
     */
    public function passwordHistories(): MorphMany
    {
        return $this->morphMany(PasswordHistory::class, 'historyable')
            ->latest('created_at');
    }

    /**
     * Add password history record
     * @param string $hashedPassword
     * @return void
     */
    public function recordPasswordHistory(string $hashedPassword): void
    {
        $this->passwordHistories()->create(['password' => $hashedPassword]);

        $limit = config('password-history.limit', 5);

        $this->passwordHistories()
            ->skip($limit)
            ->take(PHP_INT_MAX)
            ->pluck('id')
            ->each(fn ($id) => PasswordHistory::destroy($id));
    }

    /**
     * Check  to use before password history
     * @param string $plainPassword
     * @return bool
     */
    public function passwordWasUsedBefore(string $plainPassword): bool
    {
        $limit = config('password-history.limit', 5);

        return $this->passwordHistories()
            ->take($limit)
            ->get()
            ->contains(fn (PasswordHistory $history) => Hash::check($plainPassword, $history->password));
    }
}