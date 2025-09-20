{{-- Technologies Grid, Responsive & Compact with Quarterly Counts --}}
<style>
    .technology-card {
        background: #fff;
        border-radius: 14px;
        transition: box-shadow 0.17s, transform 0.12s;
        box-shadow: 0 2px 8px rgba(48,79,254,0.06);
        /* cursor: pointer; */
    }
    .technology-card:hover {
        box-shadow: 0 6px 24px rgba(0,184,217,0.11), 0 2px 8px rgba(0,0,0,0.04);
        transform: translateY(-2px) scale(1.03);
    }
    .card-img-top {
        border-radius: 12px 12px 0 0;
        background: #f6f8fd;
    }
    .card-title {
        font-size: 1rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 600;
    }
    /* 2 badge per row setup */
    .qtr-pill-row {
        display: flex;
        flex-wrap: wrap;
        gap: 2px 0;
        justify-content: space-between;
    }
    .qtr-badge {
        flex: 0 0 48%;
        min-width: 50px;
        text-align: center;
        margin: 1px 0;
        font-size: 0.82em;
        font-weight: 500;
        padding: 4px 10px;
        background: #f6f8fd;
        color: #222;
        border-radius: 12px;
        text-decoration: none;
        transition: box-shadow 0.15s, background 0.15s, color 0.15s;
        display: block;
    }
    .qtr-badge-q1 { background: #e3f2fd; color: #1976d2; }
    .qtr-badge-q2 { background: #e8f5e9; color: #388e3c; }
    .qtr-badge-q3 { background: #fff9c4; color: #f9a825; }
    .qtr-badge-q4 { background: #ffebee; color: #c62828; }
    .qtr-badge:hover {
        box-shadow: 0 1px 6px rgba(0,0,0,0.08);
        filter: brightness(1.05);
    }
    .card-body {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    @media (max-width: 991px) {
        .col-lg-2 { flex: 0 0 33.33333%; max-width: 33.33333% !important; }
    }
    @media (max-width: 767px) {
        .col-lg-2, .col-md-3, .col-sm-4 { flex: 0 0 50%; max-width: 50% !important; }
    }
</style>

<div class="row">
    @forelse($technologies as $tech)
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-4">
            <div class="card technology-card shadow-sm h-100 border-0">
                {{-- Technology Image --}}
                @if($tech->tech_image)
                    <img src="{{ asset($tech->tech_image) }}" class="card-img-top p-2" alt="{{ $tech->technology_name }}" style="height:100px; object-fit:contain; background:#fafbfc;">
                @else
                    <img src="{{ asset('images/no-image.png') }}" class="card-img-top p-2" alt="No Image" style="height:100px; object-fit:contain; background:#fafbfc;">
                @endif

                <div class="card-body py-2 px-2 text-center">
                    <h6 class="card-title mb-2 text-truncate" title="{{ $tech->technology_name }}">
                        {{ $tech->technology_name }}
                    </h6>
                    {{-- Quarter Count Pills with anchor tags and colored per quarter --}}
                    @php
                        $counts = $technologiesQuarterCounts[$tech->technology_id] ?? ['q1' => 0, 'q2' => 0, 'q3' => 0, 'q4' => 0];
                    @endphp
                    <div class="qtr-pill-row">
                        @foreach (['Q1' => 'q1', 'Q3' => 'q3','Q2' => 'q2', 'Q4' => 'q4'] as $quarterLabel => $countKey)
                            <a href="{{ route('performance.SalesTeamLeadView', ['technology_id' => $tech->technology_id, 'quarter' => $quarterLabel, 'year' => $currentYear]) }}"
                               target="_blank"
                               class="quarter-box rounded-pill qtr-badge qtr-badge-{{ strtolower($quarterLabel) }} mb-2"
                               style="text-decoration:none;">
                               <h5>{{ $quarterLabel }}: {{ $counts[$countKey] ?? 0 }}</h5> 
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">No active technologies found.</div>
        </div>
    @endforelse
</div>
