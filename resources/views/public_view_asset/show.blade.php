@extends('layouts.guest')


@section('content')
    <main class="bg-light">

        <div class="container py-5">

            {{-- HEADER + BACK --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">
                        Asset Detail
                    </h3>
                    <p class="text-muted mb-0">
                        Registered Copyright Asset
                    </p>
                </div>

                <a href="{{ route('ledger.index') }}"
                   class="btn btn-outline-secondary btn-sm">
                    ← Back to Home
                </a>
            </div>

            {{-- ASSET OVERVIEW --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Asset Overview</span>
                </div>
                <div class="card-body">

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Title</div>
                        <div class="col-md-9 fw-semibold">
                            {{ $asset->title }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Status</div>
                        <div class="col-md-9">
                        <span class="badge
                            {{ $asset->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ $asset->status }}
                        </span>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Registered At</div>
                        <div class="col-md-9">
                            {{ $asset->created_at->format('Y-m-d H:i:s') }}
                            <span class="text-muted">
                            ({{ $asset->created_at->diffForHumans() }})
                        </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 text-muted">Current Ledger</div>
                        <div class="col-md-9">
                            @if($asset->latestLedger)
                                <a href="{{ route('ledger.show', $asset->latestLedger->ledger_hash) }}"
                                   class="text-decoration-none font-monospace">
                                    {{ Str::limit($asset->latestLedger->ledger_hash, 24) }}
                                </a>
                                <span class="text-muted">
                                (v{{ $asset->latestLedger->version }})
                            </span>
                            @else
                                <span class="text-muted">
                                No ledger registered yet
                            </span>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

            {{-- CURRENT COPYRIGHT SPLIT --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Current Copyright Split</span>
                </div>

                @if($asset->latestLedger)
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Owner</th>
                                <th>Share</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($asset->latestLedger->data['owners'] as $owner)
                                <tr>
                                    <td>{{ $owner['name'] }}</td>
                                    <td>{{ $owner['share'] * 100 }}%</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body text-muted">
                        This asset does not have any copyright ledger yet.
                    </div>
                @endif
            </div>

            {{-- LEDGER HISTORY --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Ledger History</span>
                </div>

                @if($ledgers->count())
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>Version</th>
                                <th>Ledger Hash</th>
                                <th>Recorded At</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ledgers as $ledger)
                                <tr
                                    @if($asset->latestLedger && $ledger->id === $asset->latestLedger->id)
                                        class="table-primary"
                                    @endif
                                >
                                    <td>v{{ $ledger->version }}</td>
                                    <td class="font-monospace text-truncate" style="max-width: 240px;">
                                        <a href="{{ route('ledger.show', $ledger->ledger_hash) }}"
                                           class="text-decoration-none">
                                            {{ Str::limit($ledger->ledger_hash, 28) }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $ledger->created_at->format('Y-m-d H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="card-body text-muted">
                        No ledger history available for this asset.
                    </div>
                @endif
            </div>

        </div>
    </main>
@endsection
