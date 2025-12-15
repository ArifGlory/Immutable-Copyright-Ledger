<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Asset extends Model
{
    protected $table = 'assets';

    protected $fillable = [
        'title',
        'status',
    ];

    /**
     * Semua ledger versi milik asset ini
     */
    public function ledgers(): HasMany
    {
        return $this->hasMany(CopyrightLedger::class, 'asset_id');
    }

    /**
     * Ledger versi TERBARU (current state)
     */
    public function latestLedger()
    {
        return $this->hasOne(CopyrightLedger::class, 'asset_id')
            ->latestOfMany('version');
    }
}
