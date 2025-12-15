<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopyrightLedger extends Model
{
    protected $table = 'copyright_ledger';

    protected $fillable = [
        'asset_id',
        'version',
        'data',
        'ledger_hash',
    ];

    protected $casts = [
        'data' => 'array', // JSONB → array PHP
    ];

    /**
     * Asset (lagu) milik ledger ini
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
}
