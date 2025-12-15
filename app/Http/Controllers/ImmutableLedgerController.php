<?php

namespace App\Http\Controllers;
use App\Models\Asset;
use App\Models\CopyrightLedger;
use Carbon\Carbon;

class ImmutableLedgerController extends Controller
{

    public function index()
    {
        // =========================
        // STATS
        // =========================

        $stats = [
            'assets'  => Asset::count(),
            'ledgers' => CopyrightLedger::count(),
            'latest'  => optional(
                    CopyrightLedger::orderByDesc('created_at')->first()
                )->created_at?->diffForHumans() ?? '-',
        ];

        // =========================
        // LATEST LEDGER ENTRIES
        // =========================

        $latestLedgers = CopyrightLedger::with('asset')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // =========================
        // LATEST ASSETS
        // =========================

        $latestAssets = Asset::withCount('ledgers')
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        // =========================
        // RETURN VIEW
        // =========================

        return view('public_view_ledger.index', compact(
            'stats',
            'latestLedgers',
            'latestAssets'
        ));
    }

    public function search(){

    }

    public function show(string $hash)
    {
        // Ambil ledger berdasarkan hash
        $ledger = CopyrightLedger::with('asset')
            ->where('ledger_hash', $hash)
            ->firstOrFail();

        // Ambil histori versi lain untuk asset yang sama (timeline)
        $history = CopyrightLedger::where('asset_id', $ledger->asset_id)
            ->orderBy('version')
            ->get();

        return view('public_view_ledger.show', compact(
            'ledger',
            'history'
        ));
    }
}
