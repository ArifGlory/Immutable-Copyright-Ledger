@extends('layouts.guest')

@section('content')
    <main class="bg-light">

        {{-- HERO --}}
        <section class="bg-dark text-white py-5">
            <div class="container text-center">
                <h1 class="fw-bold mb-3 text-white">
                    Public Copyright Ledger Explorer
                </h1>
                <p class="text-secondary mb-4">
                    Search immutable copyright records by Asset Name or Ledger Hash
                    <br>
                    Immutable Ledger based aset & copyright Tracing System
                </p>

                {{-- SEARCH --}}
                <form method="GET" action="{{ route('ledger.search') }}"
                      class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="input-group input-group-lg shadow">
                            <input type="text"
                                   name="q"
                                   class="form-control"
                                   placeholder="Search by Asset Title / Ledger Hash">
                            <button class="btn btn-primary px-4" type="submit">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        {{-- STATS --}}
        <section class="container mt-3">
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <small class="text-muted">Total Assets</small>
                            <h4 class="fw-bold mb-0">
                                {{ $stats['assets'] ?? '3' }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <small class="text-muted">Total Ledger Entries</small>
                            <h4 class="fw-bold mb-0">
                                {{ $stats['ledgers'] ?? '3' }}
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <small class="text-muted">Latest Ledger Update</small>
                            <h6 class="fw-semibold mb-0">
                                {{ $stats['latest'] ?? '2 minutes ago' }}
                            </h6>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- MAIN CONTENT --}}
        <section class="container my-5">
            <div class="row g-4">

                {{-- LATEST LEDGER --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Latest Ledger Entries</span>
                            <small class="text-muted">Immutable records</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Ledger Hash</th>
                                    <th>Asset</th>
                                    <th>Version</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latestLedgers ?? [] as $ledger)
                                    <tr>
                                        <td class="text-truncate" style="max-width: 160px;">
                                            <a href="{{ route('ledger.show', $ledger->ledger_hash) }}"
                                               class="text-decoration-none">
                                                {{ Str::limit($ledger->ledger_hash, 18) }}
                                            </a>
                                        </td>
                                        <td>{{ $ledger->asset->title }}</td>
                                        <td>v{{ $ledger->version }}</td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- LATEST ASSETS --}}
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <span class="fw-semibold">Latest Assets</span>
                            <small class="text-muted">Registered works</small>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Asset</th>
                                    <th>Status</th>
                                    <th>Ledgers</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($latestAssets ?? [] as $asset)
                                    <tr>
                                        <td>
                                            <a href="{{ route('asset.show', $asset->id) }}"
                                               class="text-decoration-none">
                                                {{ $asset->title }}
                                            </a>
                                        </td>
                                        <td>
                                        <span class="badge bg-success">
                                            {{ $asset->status }}
                                        </span>
                                        </td>
                                        <td>{{ $asset->ledgers_count }}</td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>
@endsection
