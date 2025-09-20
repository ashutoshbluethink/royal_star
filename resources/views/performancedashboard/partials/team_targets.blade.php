@php
    $quarterNames = [1 => 'Q1', 2 => 'Q2', 3 => 'Q3', 4 => 'Q4'];
    $quarterFullNames = [1 => 'Jan–Mar', 2 => 'Apr–Jun', 3 => 'Jul–Sep', 4 => 'Oct–Dec'];
    $quarterColors = [
        1 => 'linear-gradient(135deg, #6fb1fc, #081f86ff)',
        2 => 'linear-gradient(135deg, #66d9e8, #38a3a5)',
        3 => 'linear-gradient(135deg, #ffb88c, #de6262)',
        4 => 'linear-gradient(135deg, #a18cd1, #fbc2eb)',
    ];
@endphp

@foreach([[1, 2], [3, 4]] as $quarterPair)
    <div class="row">
        @foreach($quarterPair as $quarter)
            @php
                $targets = $targetsByQuarter[$quarter] ?? collect();
                $dayTargets = $targets->where('shift', 'Day');
                $nightTargets = $targets->where('shift', 'Night');
                $totalTarget = $targets->sum('target');
                $totalAchieved = $targets->sum('achieved');
            @endphp

            <div class="col-md-6 mb-4">
                <div class="card shadow border-0 text-white" style="background: {{ $quarterColors[$quarter] }}; border-radius: 1rem;">
                    <div class="card-header bg-transparent border-0 px-3 py-2 d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <strong class="fs-6 mb-0">📊 {{ $quarterNames[$quarter] }}</strong>
                            <h5 class="text-muted">{{ $quarterFullNames[$quarter] }} - {{ $currentYear }}</h5>
                        </div>
                        <div class="text-end">
                            <div>
                                <span class="fw-semibold">🎯 Target:</span> {{ $totalTarget }}
                            </div>
                            <div>
                                <span class="fw-semibold">✅ Achieved:</span> {{ $totalAchieved }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white rounded text-dark shadow-sm">
                        <div class="row">
                            <!-- Day Shift -->
                            <div class="col-6">
                                <h6 class="text-warning fw-bold text-center mb-2">☀️ Day Shift</h6>
                                <div class="table-responsive">
                                    <table id="day-table-{{ $quarter }}" class="table table-bordered table-sm mb-0 table-striped table-day">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Team</th>
                                                <th>🎯</th>
                                                <th>✅</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($dayTargets as $target)
                                                @php
                                                    $raw = $target->technology->technology_name ?? '-';
                                                    $team = trim(str_ireplace(['Sr.', 'Sr', 'Developer'], '', $raw)) . ' Team';
                                                @endphp
                                                <tr>
                                                    <td>{{ $team }}</td>
                                                    <td>{{ $target->target }}</td>
                                                    <td>{{ $target->achieved }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="text-center">No Data</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Night Shift -->
                            <div class="col-6">
                                <h6 class="text-primary fw-bold text-center mb-2">🌙 Night Shift</h6>
                                <div class="table-responsive">
                                    <table id="night-table-{{ $quarter }}" class="table table-bordered table-sm mb-0 table-striped table-night">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>Team</th>
                                                <th>🎯</th>
                                                <th>✅</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($nightTargets as $target)
                                                @php
                                                    $raw = $target->technology->technology_name ?? '-';
                                                    $team = trim(str_ireplace(['Sr.', 'Sr', 'Developer'], '', $raw)) . ' Team';
                                                @endphp
                                                <tr>
                                                    <td>{{ $team }}</td>
                                                    <td>{{ $target->target }}</td>
                                                    <td>{{ $target->achieved }}</td>
                                                </tr>
                                            @empty
                                                <tr><td colspan="3" class="text-center text-white">No Data</td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- /row -->
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach

<!-- Add styles for Day/Night table themes -->
<style>
    .table-day {
        background-color: #fff8dc; /* Light golden background */
    }

    .table-night {
        background-color: #8484a7ff; /* Softer dark indigo */
        color: #ffffff;
    }

    .table-night thead th {
        background-color: #616180ff !important; /* Dark header for night */
        color: #ffffff !important;
    }

    .table-night tbody tr {
        background-color: #8585a0ff !important;
        color: #ffffff !important;
    }

    .table-night tbody tr:nth-child(even) {
        background-color: #acacc9ff !important;
    }

    .dataTables_wrapper .dataTables_filter {
        float: left;
        text-align: left;
    }

    .dataTables_wrapper .dataTables_length {
        float: right;
        text-align: right;
    }

    /* Optional: Fix DataTable pagination/text color in night mode */
    .table-night .dataTables_info,
    .table-night .dataTables_paginate {
        color: #ffffff !important;
    }

     /* Hover effect for all tables */
    table tbody tr:hover {
        background-color: #947b7bff !important;
        cursor: pointer;
    }

    /* Conditional scroll if rows > 10 (handled via JS class toggle) */
    .scrollable-table {
        max-height: 400px;
        overflow-y: auto;
        display: block;
    }

    .scrollable-table table {
        width: 100%;
        border-collapse: collapse;
    }

    .scrollable-table thead th {
        position: sticky;
        top: 0;
        background-color: #f8f9fa;
        z-index: 1;
    }

    /* Night table overrides */
    .table-night tbody tr:hover {
        background-color: #5e5e85 !important;
    }
</style>

<!-- DataTable Initialization -->
<script>
    $(function () {
        [1, 2, 3, 4].forEach(function (q) {
            ['day', 'night'].forEach(function (type) {
                const tableId = '#' + type + '-table-' + q;
                const $table = $(tableId);

                if ($table.length) {
                    const tableInstance = $table.DataTable({
                        responsive: true,
                        ordering: true,
                        autoWidth: false,
                        lengthChange: false,
                        searching: true,
                        pageLength: 50, // show all
                        paging: false,  // disable pagination
                        info: false
                    });

                    // Apply scroll wrapper only if rows > 10
                    const rowCount = $table.find('tbody tr').length;
                    if (rowCount > 10) {
                        $table.closest('.table-responsive').addClass('scrollable-table');
                    }
                }
            });
        });
    });
</script>

