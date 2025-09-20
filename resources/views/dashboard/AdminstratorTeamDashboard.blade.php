<!--
    |--------------------------------------------------------------------------
    | All Adminstrator Dashboard
    |--------------------------------------------------------------------------
    -->

    <style>
        .chart-container {
            position: relative;
            height: 400px;
        }
    </style>
    <div class="mb-3 text-right">
    <a href="{{ route('performance.dashboard') }}" class="btn btn-primary">
        <i class="fas fa-chart-line"></i> Performance Dashboard
    </a>
</div>








<!-- Sales Team Section -->
<h4 class="mb-3">💼 Sales Team</h4>
<div class="row">
    @php
    // Define an array of light background colors
    $backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
    $colorIndex = 0;
    @endphp
    @foreach($salesTeamUsers as $user)
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <a href="{{ route('user.leads.show', ['userId' => $user->user_id]) }}">
                <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                    <div class="profile-img">
                        @if($user->user_image)
                            <span class="avatar">
                                <img class="img-fluid" src="{{ asset('storage/' . $user->user_image) }}" alt="">
                            </span>
                        @else
                            <span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
                        @endif
                    </div>
                    
                    <div class="dash-widget-info text-right">
                        <strong><span>{{ $user->firstname }} {{ $user->lastname }}</span></strong>
                        <!-- You can use the countLeads() method to get the count -->
                        <h3>Today : {{ $user->todayLeadCount }}</h3>
                        <span>Current Month : {{ $user->monthLeadCount }}</span>
                    </div>
                </div>
            </a>
        </div>
        @php
            $colorIndex++;
        @endphp
    @endforeach
</div>

<!-- Lead Support Section -->
<h4 class="mb-3 mt-5">👨‍💼 Lead Support Team</h4>
<div class="row">
    @php
        $backgroundColors = ['#d6f5ff', '#d9eaf7', '#c2f0c2', '#f7e6ff', '#fff5cc'];
        $colorIndex = 0;
    @endphp

    @foreach($leadSupportUsers as $user)
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <a href="{{ route('user.leads.show', ['userId' => $user->user_id]) }}">
                <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
                    <div class="profile-img">
                        @if($user->user_image)
                            <span class="avatar">
                                <img class="img-fluid" src="{{ asset('storage/' . $user->user_image) }}" alt="">
                            </span>
                        @else
                            <span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
                        @endif
                        <span class="badge badge-info position-absolute" style="top: 0; right: 0;">Lead Support</span>
                    </div>

                    <div class="dash-widget-info text-right">
                        <strong><span>{{ $user->firstname }}</span></strong>
                        <h3 class="text-primary">Today: {{ $user->todayLeadCount }}</h3>
                        <span class="text-muted">Current Month: {{ $user->monthLeadCount }}</span>
                    </div>
                </div>
            </a>
        </div>
        @php $colorIndex++; @endphp
    @endforeach
</div>


<div class="row">
    <div class="col-lg-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-title">
                            Interviewee List
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class=" mt-sm-0 mt-2">
                            <button class="btn btn-light" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="fas fa-ellipsis-h"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="row"> 
                    <div class="table-responsive">
                        <div class="col-md-12">         
                            <table id="example2" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Profle</th>
                                        <th>Name</th>
                                        <th>Today</th>
                                        <th>Current Month :</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($interviewers as $interviewee)
                                        <a href="{{ route('user.leads.show', ['userId' => $interviewee->user_id]) }}">
                                            <tr>
                                                <td>
                                                    @if($interviewee->user_image)
                                                    <span class="avatar">
                                                        <img class="img-fluid" src="{{ asset('storage/' . $interviewee->user_image) }}" alt="">
                                                    </span>
                                                    @else
                                                        <span class="avatar">{{ strtoupper(substr($interviewee->firstname, 0, 1)) }}{{ strtoupper(substr($interviewee->lastname, 0, 1)) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $interviewee->firstname }} {{ $interviewee->lastname }}
                                                </td>

                                                <td>
                                                        {{ $interviewee->todayInterviewCount }}
                                                </td>
                                                <td>
                                                    {{ $interviewee->monthLeadCount }}
                                                </td>
                                                <td class="text-right">
                                                    <a href="{{ route('user.leads.show', ['userId' => $interviewee->user_id]) }}" class="btn btn-warning btn-sm mb-1">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </a>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-12 d-flex">
        <br>
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="page-title">
                            Leads Count by Interview Status
                        </div>
                    </div>
                    <div class="col text-right">
                        <div class=" mt-sm-0 mt-2">
                            <button class="btn btn-light" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="fas fa-ellipsis-h"></i></button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#">Action</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="chart-container">
                        <canvas id="myPieChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Interview Status</th>
                                <th>Count</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($leadStatusCounts as $leadCount)
                                <tr>
                                    <td>{{ $leadCount->leadstatusname }}</td>
                                    <td>{{ $leadCount->total }}</td>
                                    <td>
                                        <a href="{{ route('leadstatus.filterRecord', ['id' => $leadCount->leadstatusid]) }}" class="btn btn-warning btn-sm mb-1">
                                        <i>View</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="position: relative; font-size: 14px; font-weight: bold; padding: 10px;">
                                    <i class="fas fa-users" style="color: #007bff; margin-right: 5px;"></i> 
                                    Upcoming Onboarding Project  
                                    
                                </th>
                                <th>{{ $upcomingOnboardingCount }}</th>
                                <th> 
                                <a href="{{ route('UpcomingOnboardingProjectList') }}" class="btn btn-success btn-sm mb-1">
                                        <i>View</i>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/jquery-3.6.0.min.js"></script>
<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: [
                    @foreach($leadStatusCounts as $leadCount)
                        "{{ $leadCount->leadstatusname }}",
                    @endforeach
                ],
                datasets: [{
                    data: [
                        @foreach($leadStatusCounts as $leadCount)
                            {{ $leadCount->total }},
                        @endforeach
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(170, 70, 170, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(170, 70, 170, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    });

    $(document).ready(function() {
        $('#example2').DataTable({
            "order": [[1, "asc"]] // Order by the second column (Name) in ascending order
        });
    });
</script>





