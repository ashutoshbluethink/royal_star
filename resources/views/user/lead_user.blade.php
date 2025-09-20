@extends('layouts.app')

@section('content')
@section('title', 'Lead User')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header shadow-sm rounded px-3 py-3 mb-4"
            style="background: linear-gradient(95deg, #304ffe 0%, #00b8d9 100%); color: #fff;">
            <div class="row align-items-center">
                <!-- Title and user avatar -->
                <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 d-flex align-items-center">
                    <div class="mr-3">
                        {{-- Optional: Display user avatar (if it exists) --}}
                        @if(!empty($userLeadcreators->user_image))
                            <span class="avatar-lg rounded-circle shadow"
                                style="background:#fff;">
                                <img src="{{ asset('storage/' . $userLeadcreators->user_image) }}"
                                    alt="User"
                                    class="img-fluid rounded-circle"
                                    style="width:48px; height:48px;">
                            </span>
                        @else
                            <span class="avatar-lg rounded-circle shadow d-flex align-items-center justify-content-center"
                                style="width:48px; height:48px; background:#ffd600; color:#304ffe; font-size: 2rem; font-weight: 700;">
                                {{ strtoupper(substr($userLeadcreators->firstname,0,1)) }}{{ strtoupper(substr($userLeadcreators->lastname,0,1)) }}
                            </span>
                        @endif
                    </div>
                    <div>
                        <h4 class="text-uppercase font-weight-bold mb-1" style="color:#fff; letter-spacing:0.5px;">
                            <i class="fas fa-users mr-1"></i>
                            All Leads of {{ $userLeadcreators->firstname }} {{ $userLeadcreators->lastname }}
                        </h4>
                        <div class="lead mb-0"
                            style="color:rgba(255,255,255,.93); font-size:1.04rem;">
                            <i class="far fa-address-book mr-1"></i>
                            Viewing every lead created by this user.
                        </div>
                    </div>
                </div>
                <!-- Breadcrumbs -->
                <div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 mt-3 mt-md-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent float-md-right mb-0 py-1 px-2" style="background:rgba(255,255,255,0.09); border-radius:8px;">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" style="color:#ffd600;">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#" style="color:#ffd600;">User Lead</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                All Leads of {{ $userLeadcreators->firstname }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div id="custom-page-header">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="lead-status-cards">
                        @php
                            $statusMapping = [
                                1 => ['badgeClass' => 'badge-primary', 'iconClass' => 'fas fa-search', 'cardClass' => 'bg-light-primary'],
                                2 => ['badgeClass' => 'badge-secondary', 'iconClass' => 'fas fa-phone', 'cardClass' => 'bg-light-secondary'],
                                3 => ['badgeClass' => 'badge-info', 'iconClass' => 'fas fa-cog', 'cardClass' => 'bg-light-info'],
                                4 => ['badgeClass' => 'badge-success', 'iconClass' => 'fas fa-file-alt', 'cardClass' => 'bg-light-success'],
                                5 => ['badgeClass' => 'badge-warning', 'iconClass' => 'fas fa-file-signature', 'cardClass' => 'bg-light-warning'],
                                6 => ['badgeClass' => 'badge-danger', 'iconClass' => 'fas fa-file-invoice', 'cardClass' => 'bg-light-danger'],
                                13 => ['badgeClass' => 'badge-danger', 'iconClass' => 'fas fa-times-circle', 'cardClass' => 'bg-light-danger'],
                                14 => ['badgeClass' => 'badge-dark', 'iconClass' => 'fas fa-users', 'cardClass' => 'bg-light-dark'],
                                15 => ['badgeClass' => 'badge-info', 'iconClass' => 'fas fa-check-circle', 'cardClass' => 'bg-light-success'],
                                16 => ['badgeClass' => 'badge-warning', 'iconClass' => 'fas fa-hourglass-half', 'cardClass' => 'bg-light-warning'],
                                17 => ['badgeClass' => 'badge-warning', 'iconClass' => 'fas fa-pause-circle', 'cardClass' => 'bg-light-warning'],
                                18 => ['badgeClass' => 'badge-info', 'iconClass' => 'fas fa-file-contract', 'cardClass' => 'bg-light-info'],
                                20 => ['badgeClass' => 'badge-warning', 'iconClass' => 'fas fa-bell', 'cardClass' => 'bg-light-warning'],
                            ];
                        @endphp

                        @foreach ($LeadStatuss as $status)
                            @php
                                $badgeClass = $statusMapping[$status->leadstatusid]['badgeClass'] ?? 'badge-secondary';
                                $iconClass = $statusMapping[$status->leadstatusid]['iconClass'] ?? 'fas fa-info-circle';
                                $cardClass = $statusMapping[$status->leadstatusid]['cardClass'] ?? 'bg-light-secondary';

                                $queryParams = [];

                                foreach (['from_date', 'to_date', 'date_filter_type', 'technology_id'] as $field) {
                                    if (request($field)) {
                                        $queryParams[$field] = request($field);
                                    }
                                }

                            @endphp

                            <div class="lead-status-card text-center {{ $cardClass }}">
                                <a target="_blank"
                                    href="{{ route('leadstatus.filterRecord', ['id' => $status->leadstatusid, 'user_id' => $userLeadcreators->user_id] + $queryParams) }}"
                                    class="lead-status-card-link">
                                    <div class="card-body">
                                        <span class="badge {{ $badgeClass }} mb-2">
                                            <i class="{{ $iconClass }}"></i>
                                        </span>
                                        <h6 class="card-title">{{ $status->leadstatusname }}</h6>
                                        <p class="card-text">{{ $leads->where('interview_status', $status->leadstatusid)->count() }}</p>
                                    </div>
                                </a>
                            </div>

                        @endforeach

                        {{-- Total Leads Card --}}
                        <div class="lead-status-card text-center bg-light-primary">
                            <div class="card-body">
                                <span class="badge badge-primary mb-2">
                                    <i class="fas fa-list"></i>
                                </span>
                                <h6 class="card-title">Total Leads</h6>
                                <p class="card-text">{{ $leads->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <!-- Display Toastr messages -->
        <script>
            $(document).ready(function() {
                @if(session('error'))
                    toastr.error("{{ session('error') }}", "", { 
                        timeOut: 5000, 
                        progressBar: true,
                        positionClass: "toast-top-center"
                    });
                @endif

                @if(session('success'))
                    toastr.success("{{ session('success') }}", "", { 
                        timeOut: 5000, 
                        progressBar: true,
                        positionClass: "toast-top-center"
                    });
                @endif
            });
        </script>

        <div class="content-page">

        <!-- Display flash messages -->
        @if(session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif
        @php
            $hasFilters = !empty($selectedValues['from_date']) ||
                        !empty($selectedValues['to_date']) ||
                        !empty($selectedValues['interview_status']) ||
                        !empty($selectedValues['date_filter_type']) ||
                        !empty($selectedValues['technology_id'] ?? null);
        @endphp

        @if($hasFilters)
            <p class="text-muted small mt-2">
                <strong>Filtering leads</strong>
                @if($selectedValues['from_date'] && $selectedValues['to_date'])
                    from <strong>{{ $selectedValues['from_date'] }}</strong> to <strong>{{ $selectedValues['to_date'] }}</strong>
                @endif

                @if(!empty($selectedValues['interview_status']))
                    , with interview status:
                    <strong>
                        {{
                            optional($LeadStatuss->firstWhere('leadstatusid', $selectedValues['interview_status']))->leadstatusname 
                            ?? 'Unknown'
                        }}
                    </strong>
                @endif

                @if(!empty($selectedValues['date_filter_type']))
                    , using date filter: <strong>{{ ucfirst(str_replace('_', ' ', $selectedValues['date_filter_type'])) }}</strong>
                @endif

                @if(!empty($selectedValues['technology_id']))
                    , technology:
                    <strong>
                        {{
                            optional($technologies->firstWhere('technology_id', $selectedValues['technology_id']))->technology_name
                            ?? 'Unknown'
                        }}
                    </strong>
                @endif
            </p>
        @endif
            <form class="m-b-30" method="POST" 
                action="{{ route('user.leadsearchhow', ['searchuserId' => $userLeadcreators->user_id]) }}" 
                enctype="multipart/form-data" id="filterForm">

                @csrf

                <div class="row filter-row">

                    <!-- From Date -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input id="from_date" type="text" name="from_date"
                                class="form-control datetimepicker-input floating datetimepicker"
                                data-toggle="datetimepicker" placeholder="DD-MM-YYYY"
                                value="{{ old('from_date', $selectedValues['from_date'] ?? '') }}"
                                autocomplete="off">
                            <label class="focus-label">From</label>
                        </div>
                    </div>

                    <!-- To Date -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input id="to_date" type="text" name="to_date"
                                class="form-control datetimepicker-input datetimepicker floating"
                                data-toggle="datetimepicker" placeholder="DD-MM-YYYY"
                                value="{{ old('to_date', $selectedValues['to_date'] ?? '') }}"
                                autocomplete="off">
                            <label class="focus-label">To</label>
                        </div>
                    </div>

                    <!-- Quarter Dropdown -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                        <select class="form-control select2" id="quarterSelect" name="quarter">
                            <option value="">-- Select Quarter --</option>
                            <option value="Q1" {{ old('quarter', $selectedValues['quarter'] ?? '') == 'Q1' ? 'selected' : '' }}>Q1 (Jan-Mar)</option>
                            <option value="Q2" {{ old('quarter', $selectedValues['quarter'] ?? '') == 'Q2' ? 'selected' : '' }}>Q2 (Apr-Jun)</option>
                            <option value="Q3" {{ old('quarter', $selectedValues['quarter'] ?? '') == 'Q3' ? 'selected' : '' }}>Q3 (Jul-Sep)</option>
                            <option value="Q4" {{ old('quarter', $selectedValues['quarter'] ?? '') == 'Q4' ? 'selected' : '' }}>Q4 (Oct-Dec)</option>
                        </select>
                        <label class="focus-label">Quarter</label>
                        </div>
                    </div>
                    <!-- Date Filter Type (Created At / Updated At) -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <select class="form-control select2" name="date_filter_type" id="dateFilterType">
                                <option value="updated_at" {{ (old('date_filter_type', $selectedValues['date_filter_type'] ?? '') == 'updated_at') ? 'selected' : '' }}>Updated At</option>
                                <option value="created_at" {{ (old('date_filter_type', $selectedValues['date_filter_type'] ?? '') == 'created_at') ? 'selected' : '' }}>Created At</option>
                            </select>
                            <label class="focus-label">Date Filter By</label>
                        </div>
                    </div>

                    <!-- Interview Status -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <select class="form-control select2" name="interview_status" id="interviewStatus">
                                <option value="">--Select--</option>
                                @foreach($LeadStatuss as $LeadStatus)
                                    <option value="{{ $LeadStatus->leadstatusid }}"
                                        {{ old('interview_status', $selectedValues['interview_status'] ?? '') == $LeadStatus->leadstatusid ? 'selected' : '' }}>
                                        {{ $LeadStatus->leadstatusname }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="focus-label">Interview Status</label>
                        </div>
                    </div>
                    <!-- Technology Filter -->
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <select class="form-control select2" name="technology_id" id="technologyFilter">
                                <option value="">-- Select Technology --</option>
                                @foreach($technologies as $tech)
                                    <option value="{{ $tech->technology_id }}"
                                        {{ old('technology_id', $selectedValues['technology_id'] ?? '') == $tech->technology_id ? 'selected' : '' }}>
                                        {{ $tech->technology_name }}
                                    </option>
                                @endforeach
                            </select>
                            <label class="focus-label">Technology</label>
                        </div>
                    </div>
                    <!-- Search / Reset Buttons -->
                    <div class="col-sm-6 col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-search rounded btn-block mb-3 mr-2">
                            Search
                        </button>
                        <button type="button" id="resetButton" class="btn btn-secondary rounded btn-block mb-3">
                            Reset
                        </button>
                    </div>

                </div>
            </form>

            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                       User Wise Lead Lists
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Company</th>
                                            <th style="display: none;">email</th>
                                            <th>Vendor</th>
                                            <th>Interviewee</th>
                                            <th>Lead Comment</th>
                                            <th>Interview Status</th>
                                            <th>Action</th>
                                            <th>Created BY</th>
                                            <th>Updated  At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($leads as $lead)
                                            <tr>
                                                <!-- <td>{{ $lead->id }}</td> -->
                                                <td>{{ $loop->iteration }}</td>

                                                <td title="{{ $lead->company->company_name }}">
                                                    <i class="fa fa-building"></i> 
                                                    <span style="color: blue; font-weight: bold;">
                                                        {{ mb_strimwidth($lead->company->company_name, 0, 18, '...') }}
                                                    </span><br>
                                                    @if(!empty($lead->leadSupportedBy))
                                                        <span class="text-muted small" style="color: #666;">
                                                            <i class="fa fa-user-shield"></i>By: 
                                                            <strong>{{ $lead->leadSupportedBy->firstname }} {{ $lead->leadSupportedBy->lastname }}</strong>
                                                        </span>
                                                    @endif
                                                </td>
                                                
                                                <td style="display: none;">
                                                    {{ $lead->company_email }}
                                                </td>

                                                <td>
                                                    <i class="fa fa-user"></i> {{ $lead->vendor->name }}  <h2><a href="{{ route('leads.show', $lead->id) }}">{{ $lead->vendor->technology->technology_name }}</a></h2>
                                                </td>
                                           
                                                 <td>
                                                    <i class="fa fa-id-card"></i> {{ $lead->interviewer->firstname }}  <h2><a href="{{ route('leads.show', $lead->id) }}" title="Interview Date"> <i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') }}</a></h2>
                                                </td>

                                                <td title="{{ $lead->lead_comment }}">
                                                    <textarea name="lead_comment" class="form-control" rows="2" readonly data-toggle="popover"  data-content="{{ $lead->lead_comment }}">{{ $lead->lead_comment }}</textarea>
                                                </td>

                                                <td>
                                                    @php
                                                        $statusId = $lead->leadStatus->leadstatusid;
                                                        $badgeClass = '';
                                                        $iconClass = '';

                                                        switch ($statusId) {
                                                            case 1: // Screening
                                                                $badgeClass = 'badge-primary';
                                                                $iconClass = 'fas fa-search';
                                                                break;
                                                            case 2: // Introduction Call
                                                                $badgeClass = 'badge-secondary';
                                                                $iconClass = 'fas fa-phone';
                                                                break;
                                                            case 3: // Technical Round
                                                                $badgeClass = 'badge-info';
                                                                $iconClass = 'fas fa-cog';
                                                                break;
                                                            case 4: // Assessment Round (Machine Test)
                                                                $badgeClass = 'badge-success';
                                                                $iconClass = 'fas fa-file-alt';
                                                                break;
                                                            case 5: // Offer Letter/Onboarding
                                                                $badgeClass = 'badge-warning';
                                                                $iconClass = 'fas fa-file-signature';
                                                                break;
                                                            case 6: // Offer letter received but not joined
                                                                $badgeClass = 'badge-danger';
                                                                $iconClass = 'fas fa-file-invoice';
                                                                break;
                                                            case 13: // Rejected
                                                                $badgeClass = 'badge-danger';
                                                                $iconClass = 'fas fa-times-circle';
                                                                break;
                                                            case 14: // Client Round
                                                                $badgeClass = 'badge-dark';
                                                                $iconClass = 'fas fa-users';
                                                                break;
                                                            case 15: // Joined Successfully
                                                                $badgeClass = 'badge-info';
                                                                $iconClass = 'fas fa-check-circle';
                                                                break;
                                                            case 16: // Waiting for Offer Letter
                                                                $badgeClass = 'badge-warning';
                                                                $iconClass = 'fas fa-hourglass-half';
                                                                break;
                                                            case 17: // Position On Hold
                                                                $badgeClass = 'badge-warning';
                                                                $iconClass = 'fas fa-pause-circle';
                                                                break;
                                                            case 18: // C2C NDA/MSA Signed
                                                                $badgeClass = 'badge-info';
                                                                $iconClass = 'fas fa-file-contract';
                                                                break;
                                                            case 20: // Take Follow-up
                                                                $badgeClass = 'badge-warning';
                                                                $iconClass = 'fas fa-bell';
                                                                break;
                                                            default:
                                                                $badgeClass = 'badge-light';
                                                                $iconClass = 'fas fa-question-circle';
                                                        }
                                                    @endphp


                                                    <a href="{{ route('leads.show', $lead->id) }}" class="badge-link">
                                                        <span class="badge badge-custom {{ $badgeClass }}">
                                                            <i class="{{ $iconClass }}"></i> {{ $lead->leadStatus->leadstatusname }}
                                                        </span>
                                                    </a>
                                                    <!-- Joining Date -->
                                                    @if(!empty($lead->joining_date))
                                                        <div class="small text-muted">
                                                            <i class="fas fa-calendar-check text-success"></i>
                                                            <strong>Joining Date: {{ $lead->joining_date }}</strong>
                                                        </div>
                                                    @endif

                                                </td>
                                                <td class="text-right">
                                                    
                                                @if(auth()->user()->role != 3 && auth()->user()->role != 8)
                                                    <a href="{{ route('leads.edit', ['lead' => $lead->id, 'user_id' => $userLeadcreators->user_id]) }}" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                
                                                @endif
                                                    <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                </td>
            
                                                <td>
                                                    {{ $lead->createdUser->firstname }}
                                                    <h2><a href="{{ route('leads.show', $lead->id) }}">{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</a></h2>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($lead->updated_at)->format('d M Y') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('section/notification') 
    </div>
</div>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "bStateSave":true,
            "buttons": ["pdf", "print", "excel"],
            "order": [[0, "desc"]],
            "pageLength": 10 
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script>
    $(document).ready(function () {

        $('#quarterSelect').on('change', function () {
            const selectedQuarter = $(this).val();
            const year = new Date().getFullYear();

            let fromDate = '', toDate = '';

            switch (selectedQuarter) {
                case 'Q1':
                    fromDate = `01-01-${year}`;
                    toDate = `31-03-${year}`;
                    break;
                case 'Q2':
                    fromDate = `01-04-${year}`;
                    toDate = `30-06-${year}`;
                    break;
                case 'Q3':
                    fromDate = `01-07-${year}`;
                    toDate = `30-09-${year}`;
                    break;
                case 'Q4':
                    fromDate = `01-10-${year}`;
                    toDate = `31-12-${year}`;
                    break;
                default:
                    fromDate = '';
                    toDate = '';
            }

            $('#from_date').val(fromDate).trigger('change');
            $('#to_date').val(toDate).trigger('change');

            if ($('#from_date').data("DateTimePicker")) {
                $('#from_date').data("DateTimePicker").date(moment(fromDate, 'DD-MM-YYYY'));
            }
            if ($('#to_date').data("DateTimePicker")) {
                $('#to_date').data("DateTimePicker").date(moment(toDate, 'DD-MM-YYYY'));
            }
        });

        $('#resetButton').on('click', function () {
            // Reset text inputs
            $('#from_date, #to_date').val('').trigger('change');

            // Clear DateTimePicker if initialized
            if ($('#from_date').data("DateTimePicker")) {
                $('#from_date').data("DateTimePicker").clear();
            }
            if ($('#to_date').data("DateTimePicker")) {
                $('#to_date').data("DateTimePicker").clear();
            }

            // Reset select dropdowns
            $('#quarterSelect, #interviewStatus, #technologyFilter, #date_filter_type').val('').trigger('change');
        });
    });
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

@endsection