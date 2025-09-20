<h4 class="mt-5 mb-3">🧑‍💼 Interviewee Team Members</h4>

<div class="row staff-grid-row">
    @forelse($interviewMembers as $member)
        @php
            $totalQuarterOffers = array_sum($member->quarterCounts ?? []);
        @endphp

        @if($totalQuarterOffers > 0)
            <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-custom">
                <div class="profile-widget shadow-sm border rounded">
                    <div class="profile-img">
                        @if(!empty($member->user_image))
                            <span class="avatar-wrapper">
                                <img class="avatar" src="{{ asset('storage/' . $member->user_image) }}" alt="User Image">
                            </span>
                        @else
                            <span class="avatar-wrapper">
                                <span class="avatar">{{ strtoupper(substr($member->firstname, 0, 1) . substr($member->lastname, 0, 1)) }}</span>
                            </span>
                        @endif
                    </div>

                    <h4 class="user-name mt-2 mb-0 text-ellipsis">
                        <span>{{ $member->firstname }} {{ $member->lastname }}</span>
                    </h4>

                    <h6 class="text-info mt-2 mb-1">
                        {{ $currentYear }} Total: <strong>{{ $member->totalLeadsCount ?? 0 }}/{{ $member->offerLeadCount ?? 0 }}</strong>
                    </h6>

                    @php
                        $quarterLabels = [
                            'Q1' => 'Jan to Mar',
                            'Q2' => 'Apr to Jun',
                            'Q3' => 'Jul to Sep',
                            'Q4' => 'Oct to Dec',
                        ];

                        $quarterColors = [
                            'Q1' => 'linear-gradient(135deg, #6fb1fc, #081f86ff)',
                            'Q2' => 'linear-gradient(135deg, #66d9e8, #38a3a5)',
                            'Q3' => 'linear-gradient(135deg, #ffb88c, #de6262)',
                            'Q4' => 'linear-gradient(135deg, #a18cd1, #fbc2eb)',
                        ];

                        $quarterIcons = [
                            'Q1' => '❄️', 'Q2' => '🌼', 'Q3' => '☀️', 'Q4' => '🍁',
                        ];
                    @endphp

                    <div class="mt-2 d-flex flex-column gap-1">
                        @foreach (['Q1', 'Q2', 'Q3', 'Q4'] as $q)
                            <a 
                                class="quarter-box px-2 py-1 rounded text-white d-flex justify-content-between align-items-center shadow-sm mb-1 text-decoration-none"
                                style="background: {{ $quarterColors[$q] }}; font-size: 0.8rem;"
                                href="{{ route('performance.SalesTeamLeadView', ['interviwee_id' => $member->user_id, 'quarter' => $q, 'year' => $currentYear]) }}"
                                target="_blank"
                            >
                                <div>
                                    {{ $quarterIcons[$q] }} <strong>{{ $q }} ({{ $quarterLabels[$q] }})</strong>
                                </div>
                                <div class="fw-bold" style="font-size: 0.85rem;">
                                    {{ ($member->quarterTotalCounts[$q] ?? 0) }}/{{ ($member->quarterCounts[$q] ?? 0) }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="col-12 text-center text-muted">
            <p>No interview team members with offer leads found.</p>
        </div>
    @endforelse
</div>

<style>
    @media (min-width: 1200px) {
        .col-xl-custom {
            flex: 0 0 20%;
            max-width: 20%;
        }
    }

    .profile-widget {
        padding: 15px;
        text-align: center;
        background-color: #fff;
        position: relative;
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }

    .profile-widget:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        border-color: #ddd;
    }

    .profile-img .avatar-wrapper {
        cursor: default;
        display: inline-block;
    }

    .profile-img .avatar {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #f0f0f0;
    }

    .profile-img .avatar:not(img) {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 20px;
        background: #007bff;
        color: #fff;
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }

    .quarter-box {
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .quarter-box:hover {
        filter: brightness(1.1) contrast(1.1);
        transform: scale(1.02);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
