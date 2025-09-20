@extends('layouts.app')
@section('title', 'Lead List C2C')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        
   <style>
    .lead-status-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }
    .lead-status-card {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 10px;
        text-align: center;
    }
    .lead-status-card .badge {
        font-size: 12px;
        padding: 5px 8px;
    }
    .lead-status-card h6 {
        font-size: 12px;
        margin: 4px 0 2px;
    }
    .lead-status-card p {
        font-size: 14px;
        font-weight: bold;
        margin: 0;
    }
</style>

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
                    ];
                @endphp

                @foreach ($LeadStatuss as $status)
                    @php
                        $badgeClass = $statusMapping[$status->leadstatusid]['badgeClass'] ?? 'badge-secondary';
                        $iconClass = $statusMapping[$status->leadstatusid]['iconClass'] ?? 'fas fa-info-circle';
                        $cardClass = $statusMapping[$status->leadstatusid]['cardClass'] ?? 'bg-light-secondary';
                    @endphp

                    <div class="lead-status-card {{ $cardClass }}">
                        <span class="badge {{ $badgeClass }}">
                            <i class="{{ $iconClass }}"></i>
                        </span>
                        <h6>{{ $status->leadstatusname }}</h6>
                        <p>{{ $leads->where('interview_status', $status->leadstatusid)->count() }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


        <script src="assets/js/jquery-3.6.0.min.js"></script>
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


        <form class="m-b-30" method="GET" 
            action="{{ route('view.c2clead') }}" 
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

                <!-- Sales Team Filter -->
                <div class="col-sm-6 col-md-3">
                    <div class="form-group form-focus">
                        <select class="form-control select2" name="sales_user_id" id="sales_user_id">
                            <option value="">-- Select Sales Team Member --</option>
                            @foreach($salesTeam as $sales)
                                <option value="{{ $sales->user_id }}"
                                    {{ old('sales_user_id', $selectedValues['sales_user_id'] ?? '') == $sales->user_id ? 'selected' : '' }}>
                                    {{ $sales->firstname }} {{ $sales->lastname }}
                                </option>
                            @endforeach
                        </select>
                        <label class="focus-label">Sales Team</label>
                    </div>
                </div>

                <!-- Search & Reset Buttons -->
                <div class="col-sm-6 col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-search rounded btn-block mb-3 mr-2">Search</button>
                    <button type="button" id="resetButton" class="btn btn-secondary rounded btn-block mb-3">Reset</button>
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
                                  C2C  Lead Lists
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th> </th>
                                        <th style="display: none;">Id</th>
                                        <th style="display: none;">email</th>
                                        <th>Company</th>
                                        <th class="d-none">Company Name</th> <!-- Hidden but for export -->
                                        <th>Vendor</th>
                                        <th>Interviewee</th>
                                        <th>Lead Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Created BY</th>
                                        <th>Updated At</th>
                                        <th>Region</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $lead)
                                        <tr id="row-{{ $lead->id }}" style="{{ $lead->is_read ? 'color: red;' : '' }}">
                                            <td>
                                                <input type="checkbox" class="read-checkbox" data-leadid="{{ $lead->id }}" {{ $lead->is_read ? 'checked' : '' }}>
                                            </td>

                                            <td style="display: none;">{{ $lead->id }}</td>
                                            <td style="display: none;">
                                                {{ $lead->company_email }} 
                                            </td>
                                            
                                            <td title="{{ $lead->company->company_name }}">
                                                <i class="fa fa-building"></i> 
                                                <span style="color: blue; font-weight: bold;">
                                                    {{ mb_strimwidth($lead->company->company_name, 0, 10, '...') }}
                                                </span><br>
                                                    @if(!empty($lead->leadSupportedBy))
                                                        <span class="text-muted small" style="color: #666;">
                                                            <i class="fa fa-user-shield"></i>By: 
                                                            <strong>{{ $lead->leadSupportedBy->firstname }} {{ $lead->leadSupportedBy->lastname }}</strong>
                                                        </span>
                                                    @endif
                                            </td>

                                            <td class="d-none export-full-company-name">
                                                {{ $lead->company->company_name }}
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
                                                        case 1:
                                                            $badgeClass = 'badge-primary'; $iconClass = 'fas fa-search'; break; // Screening
                                                        case 2:
                                                            $badgeClass = 'badge-secondary'; $iconClass = 'fas fa-phone'; break; // Introduction Call
                                                        case 3:
                                                            $badgeClass = 'badge-info'; $iconClass = 'fas fa-cogs'; break; // Technical Round
                                                        case 4:
                                                            $badgeClass = 'badge-success'; $iconClass = 'fas fa-laptop-code'; break; // Assessment
                                                        case 5:
                                                            $badgeClass = 'badge-success'; $iconClass = 'fas fa-file-signature'; break; // Offer Letter
                                                        case 6:
                                                            $badgeClass = 'badge-danger'; $iconClass = 'fas fa-user-slash'; break; // Offer not joined
                                                        case 13:
                                                            $badgeClass = 'badge-danger'; $iconClass = 'fas fa-times-circle'; break; // Rejected
                                                        case 14:
                                                            $badgeClass = 'badge-dark'; $iconClass = 'fas fa-users'; break; // Client Round
                                                        case 15:
                                                            $badgeClass = 'badge-dark'; $iconClass = 'fas fa-check-double'; break; // Closed
                                                        case 16:
                                                            $badgeClass = 'badge-warning'; $iconClass = 'fas fa-hourglass-half'; break; // Waiting for Offer
                                                        case 17:
                                                            $badgeClass = 'badge-warning'; $iconClass = 'fas fa-pause-circle'; break; // On Hold
                                                        case 18:
                                                            $badgeClass = 'badge-info'; $iconClass = 'fas fa-file-contract'; break; // NDA/MSA Signed
                                                        case 20:
                                                            $badgeClass = 'badge-warning'; $iconClass = 'fas fa-bell'; break; // Take Follow-up
                                                        default:
                                                            $badgeClass = 'badge-secondary'; $iconClass = 'fas fa-question-circle'; break;
                                                    }
                                                @endphp


                                                <!-- Status Badge -->
                                                <a href="{{ route('leads.show', $lead->id) }}" class="badge-link text-decoration-none">
                                                    <span class="badge badge-custom {{ $badgeClass }} mb-1">
                                                        <i class="{{ $iconClass }}"></i>
                                                        {{ $lead->leadStatus->leadstatusname }}
                                                    </span>
                                                </a>

                                                @if(!empty($lead->joining_date))
                                                    <div class="small text-muted">
                                                        <i class="fas fa-calendar-check text-success"></i>
                                                        <strong>Joining Date: {{ $lead->joining_date }}</strong>
                                                    </div>
                                                @endif
                                            </td>

                                            <td class="text-right">
                                                <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="far fa-edit"></i>
                                                </a>
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
                                            <td>
                                                {{$lead->region }}
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
</div>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "bStateSave":true,
            "buttons": ["pdf", "print", "excel"],
            "order": [[1, "desc"]] // Order by the first column (ID) in descending order
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {
        $('.select2').select2();

    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('change', '.read-checkbox', function() {
            var checkbox = $(this);
            var leadId = checkbox.data('leadid');
            var isChecked = checkbox.prop('checked') ? 1 : 0;

            // Send AJAX request to update the 'is_read' column
            $.ajax({
                url: '/leads/' + leadId + '/update-read-status',
                type: 'POST',
                data: {
                    is_read: isChecked,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success response
                    var row = $('#row-' + leadId); // Select the table row with dynamic ID
                    if (isChecked) {
                        row.css('color', 'red'); // Change the color of the corresponding table row to red
                    } else {
                        row.css('color', ''); // Remove the color property
                    }
                },
                error: function(xhr) {
                    // Handle error response if needed
                }
            });
        });
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
            $('#quarterSelect, #interviewStatus, #date_filter_type, #sales_user_id').val('').trigger('change');
        });

    });
</script>
 
@endsection 
