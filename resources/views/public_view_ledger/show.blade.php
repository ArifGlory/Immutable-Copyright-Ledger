@extends('layouts.guest')

@push('css')
    <style>
        .ledger-page {
            min-height: 100vh;
            overflow-y: auto;
        }
    </style>
@endpush
@section('content')
    <main class="bg-light ledger-page">

        <div class="container py-5">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="fw-bold mb-1">
                        Ledger Detail
                    </h3>
                    <p class="text-muted mb-0">
                        Immutable Copyright Ledger Record
                    </p>
                </div>

                <a href="{{ route('ledger.index') }}"
                   class="btn btn-outline-secondary btn-sm">
                    ← Back to Home
                </a>
            </div>

            {{-- LEDGER SUMMARY --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Ledger Overview</span>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Ledger Hash</div>
                        <div class="col-md-9 font-monospace text-break">
                            {{ $ledger->ledger_hash }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Asset</div>
                        <div class="col-md-9">
                            <a href="{{ route('asset.show', $ledger->asset->id) }}"
                               class="text-decoration-none">
                                {{ $ledger->asset->title }}
                            </a>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Version</div>
                        <div class="col-md-9">
                            v{{ $ledger->version }}
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Recorded At</div>
                        <div class="col-md-9">
                            {{ $ledger->created_at->format('Y-m-d H:i:s') }}
                            <span class="text-muted">
                            ({{ $ledger->created_at->diffForHumans() }})
                        </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 text-muted">Immutability</div>
                        <div class="col-md-9">
                        <span class="badge bg-success">
                            Immutable (Append-only)
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- COPYRIGHT DATA --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Copyright Split</span>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>Owner</th>
                            <th>Share</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ledger->data['owners'] as $owner)
                            <tr>
                                <td>{{ $owner['name'] }}</td>
                                <td>{{ $owner['share'] * 100 }}%</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- RAW JSON --}}
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-white d-flex justify-content-between">
                    <span class="fw-semibold">Raw Ledger Data (JSON)</span>
                    <button class="btn btn-sm btn-outline-secondary"
                            onclick="copyJson()">
                        Copy JSON
                    </button>
                </div>
                <div class="card-body">
                <pre id="ledger-json"
                     class="bg-light p-3 rounded small">
{{ json_encode($ledger->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                </pre>
                </div>
            </div>

            {{-- VERSION HISTORY --}}
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <span class="fw-semibold">Version History</span>
                </div>
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
                        @foreach($history as $item)
                            <tr @if($item->id === $ledger->id) class="table-primary" @endif>
                                <td>v{{ $item->version }}</td>
                                <td class="font-monospace text-truncate" style="max-width: 220px;">
                                    <a href="{{ route('ledger.show', $item->ledger_hash) }}"
                                       class="text-decoration-none">
                                        {{ Str::limit($item->ledger_hash, 24) }}
                                    </a>
                                </td>
                                <td>
                                    {{ $item->created_at->format('Y-m-d H:i') }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    {{-- COPY JSON SCRIPT --}}
    <script>
        function copyJson() {
            const text = document.getElementById('ledger-json').innerText;
            navigator.clipboard.writeText(text);
            alert('Ledger JSON copied');
        }
    </script>
@endsection

