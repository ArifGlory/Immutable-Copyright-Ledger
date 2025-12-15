<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use App\Models\CopyrightLedger;

class AssetController extends Controller
{

    public function show(int $id)
    {
        // Ambil asset + current ledger
        $asset = Asset::with('latestLedger')->findOrFail($id);

        // Ambil seluruh histori ledger
        $ledgers = CopyrightLedger::where('asset_id', $asset->id)
            ->orderBy('version')
            ->get();

        return view('public_view_asset.show', compact(
            'asset',
            'ledgers'
        ));
    }
}
