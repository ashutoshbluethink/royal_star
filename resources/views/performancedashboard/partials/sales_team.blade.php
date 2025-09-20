  
<style>
    /* Light pastel card backgrounds */
.soft-bg-1 {
    background-color: #f0f8ff !important; /* AliceBlue */
}
.soft-bg-2 {
    background-color: #fef9e7 !important; /* Light Yellow */
}
.soft-bg-3 {
    background-color: #e8f5e9 !important; /* Mint Green */
}
.soft-bg-4 {
    background-color: #fff3f3 !important; /* Soft Pink */
}

/* Quarter color boxes */
.bg-light-primary {
    background-color: #eaf3ff !important;
}
.bg-light-success {
    background-color: #e9f7ef !important;
}
.bg-light-warning {
    background-color: #fff9e6 !important;
}
.bg-light-danger {
    background-color: #ffeaea !important;
}

/* Quarter box styling */
.quarter-box {
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 500;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s ease;
}
.quarter-box:hover {
    transform: translateY(-2px);
    text-decoration: none;
    background-color: #f8f9fa !important;
}

.fc-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.quarter-label {
    font-weight: 600;
    font-size: 1rem;
}

.quarter-count {
    font-size: 0.95rem;
    font-weight: 400;
}

</style>
  <h4 class="mt-5 mb-3">🧑‍💼 Sales Team Members</h4>
        <div class="row">
            @forelse($salesMembers as $member)
                @php
                    $bgClasses = ['soft-bg-1', 'soft-bg-2', 'soft-bg-3', 'soft-bg-4'];
                    $bgClass = $bgClasses[$loop->index % count($bgClasses)];
                    $yearlyTotal = collect($member->quarterCounts)->sum('offer');
                    $yearlyFull = collect($member->quarterCounts)->sum('total');
                @endphp
                    <div class="col-md-4 col-lg-3 mb-3">
                                <div class="card shadow-sm text-center {{ $bgClass }}">
                                    <div class="card-body">
                                <div class="profile-img mb-2">
                        @if($member->user_image)
                            <span class="avatar" style="cursor: default;">
                                <img class="img-fluid rounded-circle" 
                                    src="{{ asset('storage/' . $member->user_image) }}" 
                                    alt="" width="70" height="70" 
                                    style="cursor: default;">
                            </span>
                        @else
                            <span class="avatar rounded-circle d-inline-flex align-items-center justify-content-center bg-secondary text-white" 
                                style="width: 70px; height: 70px; font-size: 24px; cursor: default;">
                                {{ strtoupper(substr($member->firstname, 0, 1)) }}{{ strtoupper(substr($member->lastname, 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    <h6 class="mb-0">{{ $member->firstname }} {{ $member->lastname }}</h6>

                    <h5 class="text-info d-block mt-1">
                        <strong>{{$currentYear}} Total:</strong> {{ $yearlyFull }}/{{ $yearlyTotal }}
                    </h5>

                    <!-- Quarter Breakdown -->
                    <div class="row mt-3 small">
                        <div class="col-6">
                            <a class="quarter-box bg-light-primary text-primary mb-2 d-block"
                            href="{{ route('performance.SalesTeamLeadView', ['user_id' => $member->user_id, 'quarter' => 'Q1', 'year' =>$currentYear]) }}" target="_blank" >
                                <div class="fc-content px-3 py-2">
                                    <span class="quarter-label">Q1</span>
                                    <span class="quarter-count">
                                        {{ $member->quarterCounts['Q1']['total'] ?? 0 }}/{{ $member->quarterCounts['Q1']['offer'] ?? 0 }}
                                    </span>
                                </div>
                            </a>
                            <a class="quarter-box bg-light-success text-success mb-2 d-block"
                            href="{{ route('performance.SalesTeamLeadView', ['user_id' => $member->user_id, 'quarter' => 'Q2', 'year' => $currentYear]) }}"target="_blank">
                                <div class="fc-content px-3 py-2">
                                    <span class="quarter-label">Q2</span>
                                    <span class="quarter-count">
                                        {{ $member->quarterCounts['Q2']['total'] ?? 0 }}/{{ $member->quarterCounts['Q2']['offer'] ?? 0 }}
                                    </span>
                                </div>
                            </a>
                        </div>
                        <div class="col-6">
                            <a class="quarter-box bg-light-warning text-warning mb-2 d-block"
                            href="{{ route('performance.SalesTeamLeadView', ['user_id' => $member->user_id, 'quarter' => 'Q3', 'year' => $currentYear]) }}"target="_blank">
                                <div class="fc-content px-3 py-2">
                                    <span class="quarter-label">Q3</span>
                                    <span class="quarter-count">
                                        {{ $member->quarterCounts['Q3']['total'] ?? 0 }}/{{ $member->quarterCounts['Q3']['offer'] ?? 0 }}
                                    </span>
                                </div>
                            </a>
                            <a class="quarter-box bg-light-danger text-danger mb-2 d-block"
                            href="{{ route('performance.SalesTeamLeadView', ['user_id' => $member->user_id, 'quarter' => 'Q4', 'year' => $currentYear]) }}"target="_blank">
                                <div class="fc-content px-3 py-2">
                                    <span class="quarter-label">Q4</span>
                                    <span class="quarter-count">
                                        {{ $member->quarterCounts['Q4']['total'] ?? 0 }}/{{ $member->quarterCounts['Q4']['offer'] ?? 0 }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <p class="text-muted">No sales team members with leads found.</p>
        </div>
    @endforelse
</div>
