@extends('layouts.app')

@section('content')
@section('title', 'Edit Lead')

<div class="page-wrapper">
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title"> Update Lead</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="add-card.php">Lead</a></li>
                    <li class="breadcrumb-item"><span> Update Lead</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-12 col-12 text-left add-btn-col">
            <a href="{{ route('view.lead') }}" class="btn btn-danger float-right btn-rounded"><i class="far fa-eye"></i> View All Lead </a>
            <a href="{{ route('leads.show', $editLead->id) }}" class="btn btn-warning float-right btn-rounded"><i class="far fa-eye"></i>Show Comments </a>
            <a href="{{ route('add.lead') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Lead </a>
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
    <div class="row">
        <div class="col-lg-12 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Edit Lead Data
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form class="m-b-30" method="POST" action="{{ route('leads.update', $editLead->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                    <select class="form-control select2" name="company_id">
                                        <option value="">--Select Company--</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->company_id }}" {{ $editLead->company_id == $company->company_id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                        @endforeach
                                    </select>
                                        <label class="focus-label">Company</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="vendor_id">
                                            <option value="">--Select vendor--</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor->vendor_id }}"{{ $editLead->vendor_id ==  $vendor->vendor_id ? 'selected' : '' }}>{{ $vendor->name }} {{ $vendor->technology->technology_name }}<span style="color:red">{{ $vendor->role_name }}</span></option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Vendors</label>
                                    </div>
                                </div>

                          
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="interviewee_id">
                                            <option value="">--Select Interviewee--</option>
                                            @foreach($interviewee_users as $interviewee_user)
                                                <option value="{{ $interviewee_user->user_id }}"{{ $editLead->interviewee_id ==  $interviewee_user->user_id ? 'selected' : '' }}>{{ $interviewee_user->firstname }} {{ $interviewee_user->lastname }} <span style="color:red">-{{ $interviewee_user->role_name }}</span> </option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Interviewee</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="interview_date" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker" value="{{ \Carbon\Carbon::parse($editLead->interview_date)->format('d-m-Y') }}">
                                        <label class="focus-label">Interview Date <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group form-focus">
                                        <?php 
                                            $parts = explode(' ', $editLead->interview_time ?? '');
                                            $time = $parts[0] ?? ''; // Default to an empty string if undefined
                                            $period = $parts[1] ?? ''; // Default to an empty string if undefined
                                        ?>
                                        <input name="interview_time" class="form-control" type="text" placeholder="interview_time" value="{{ $time }}">
                                        <div id="interview_time_error"></div>
                                        <label class="focus-label">interview_time(IST)</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group form-focus">
                                        <select name="time_period" class="form-control">
                                            <option value="" {{ empty($period) ? "selected" : "" }}>Select</option>
                                            <option value="AM" {{ $period == "AM" ? "selected" : "" }}>AM</option>
                                            <option value="PM" {{ $period == "PM" ? "selected" : "" }}>PM</option>
                                        </select>
                                        <label class="focus-label">time_period</label>
                                        <div id="time_period_error"></div> 

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select class="form-control select2" name="interview_status" id="interview_status" onchange="showDiv('joining_date_field', this)">
                                            <option value="">--Select--</option>
                                            @foreach($LeadStatuss as $LeadStatus)
                                                <option value="{{ $LeadStatus->leadstatusid }}" {{ $LeadStatus->leadstatusid ==  $editLead->interview_status ? 'selected' : '' }}>
                                                    {{ $LeadStatus->leadstatusname }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Interview Status</label>
                                    </div>
                                </div>

                                <!-- Joining Date Field (Hidden Initially) -->
                                <div class="col-sm-6" id="joining_date_field" style="display: none;">
                                    <div class="form-group form-focus">
                                        <input id="joining_date" name="joining_date"
                                            class="form-control datetimepicker-input datetimepicker"
                                            type="text"
                                            data-toggle="datetimepicker"
                                            value="{{ $editLead->joining_date ? \Carbon\Carbon::parse($editLead->joining_date)->format('d-m-Y') : '' }}">
                                        <label class="focus-label">Joining Date <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <!-- Datepicker Initialization and Logic -->
                                <script>
                                    $(function () {
                                        $('#joining_date').datetimepicker({
                                            format: 'DD-MM-YYYY',
                                            useCurrent: false // 🚫 Prevent auto-filling current date
                                        });

                                        let dateManuallyPicked = false;

                                        $('#joining_date').on('change.datetimepicker', function (e) {
                                            if (e.date) {
                                                dateManuallyPicked = true;
                                                $(this).val(e.date.format('DD-MM-YYYY'));
                                            } else {
                                                if (!dateManuallyPicked) {
                                                    $(this).val('');
                                                }
                                            }
                                        });

                                        $('#joining_date').on('focus', function () {
                                            dateManuallyPicked = false;
                                        });
                                    });
                                </script>

                                <!-- Interview Status Toggle Logic -->
                                <script>
                                    function showDiv(divId, element) {
                                        const field = document.getElementById(divId);
                                        const input = document.getElementById('joining_date');

                                        if (element.value == '5') {
                                            field.style.display = 'block';
                                            input.setAttribute('required', 'required');
                                        } else {
                                            field.style.display = 'none';
                                            input.removeAttribute('required');

                                            const hasDbValue = "{{ $editLead->joining_date ? 'true' : 'false' }}";
                                            if (!hasDbValue) {
                                                input.value = '';
                                            }
                                        }
                                    }

                                    document.addEventListener('DOMContentLoaded', function () {
                                        const interviewStatus = document.getElementById('interview_status');
                                        showDiv('joining_date_field', interviewStatus);

                                        interviewStatus.addEventListener('change', function () {
                                            showDiv('joining_date_field', this);
                                        });
                                    });
                                </script>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_email" class="form-control" type="company_email" placeholder="Email (Optional)" value="{{ $editLead->company_email }}">
                                        <label class="focus-label">Email (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_phone" class="form-control" type="tel" placeholder="Phone (Optional)" value="{{ $editLead->company_phone }}">
                                        <label class="focus-label">Phone (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="company_rate" class="form-control" type="number" placeholder="Rate (Optional)" value="{{ $editLead->company_rate }}">
                                        <label class="focus-label">Rate (Optional)</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input name="source" class="form-control" type="text" placeholder="Source" value="{{ $editLead->source }}">
                                        <label class="focus-label">Source</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <textarea name="meeting_link" class="form-control" placeholder="Meeting Link (Optional)">{{ $editLead->meeting_link }}</textarea>
                                        <label class="focus-label">Meeting Link (Optional)</label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select name="region" class="form-control select2" required>
                                            <option value="">-- Select --</option>
                                            <option value="Indian" {{ (isset($editLead) && $editLead->region == 'Indian') ? 'selected' : '' }}>Indian</option>
                                            <option value="USA" {{ (isset($editLead) && $editLead->region == 'USA') ? 'selected' : '' }}>USA</option>
                                            <option value="Other" {{ (isset($editLead) && $editLead->region == 'Other') ? 'selected' : '' }}>Other</option>
                                        </select>
                                        <label class="focus-label">Region <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <select name="lead_supported_by" id="lead_supported_by" class="form-control select2">
                                            <option value="">-- Select Support User --</option>
                                            @foreach($leadSupportedUsers as $user)
                                                <option value="{{ $user->user_id }}"
                                                    @if(old('lead_supported_by', $editLead->lead_supported_by) == $user->user_id) selected @endif>
                                                    {{ $user->firstname }} {{ $user->lastname }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Lead Supported By(Optional)</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group form-focus">
                                        <textarea name="lead_comment" class="form-control" rows="2" placeholder="Lead Comment" required ></textarea>
                                        <label class="focus-label">Lead Comment <Small>(Please update comment)</Small></label>
                                    </div>
                                </div>
                                @if(request()->query('user_id'))
                                    <input type="hidden" name="edit_user_id" value="{{ request()->query('user_id') }}">
                                @endif
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Update Lead</button>
                                <a href="javascript:history.back()" class="btn btn-secondary btn-lg ml-2">Back</a>
                            </div>

                        </form>
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
        "buttons": ["pdf"]
        // "order": [[0, "desc"]] 
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});
</script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>


<script>
    function validateForm(event) {
        var interviewTime = document.querySelector('input[name="interview_time"]');
        var timePeriod = document.querySelector('select[name="time_period"]');
        var timeErrorDiv = document.getElementById("time_period_error");
        var interviewTimeErrorDiv = document.getElementById("interview_time_error");

  
        timeErrorDiv.innerHTML = "";
        interviewTimeErrorDiv.innerHTML = "";
        timePeriod.classList.remove("is-invalid");
        interviewTime.classList.remove("is-invalid");

        var interviewTimeValue = interviewTime.value.trim();
        var timeRegex = /^([0-9]{1,2}):([0-9]{2})$/;

   
        if (interviewTimeValue === "" && timePeriod.value === "") {
            return true; 
        }

       
        if (interviewTimeValue === "" && timePeriod.value !== "") {
            interviewTimeErrorDiv.innerHTML = "<span class='text-danger'>Please fill the interview time.</span>";
            interviewTime.classList.add("is-invalid");
            event.preventDefault();
            return false;
        }

      
        if (!timeRegex.test(interviewTimeValue)) {
            interviewTimeErrorDiv.innerHTML = "<span class='text-danger'>Please enter a valid interview time (e.g., 12:30).</span>";
            interviewTime.classList.add("is-invalid");
            event.preventDefault();
            return false;
        }

        var timeParts = interviewTimeValue.split(":");
        var hours = parseInt(timeParts[0], 10);
        var minutes = parseInt(timeParts[1], 10);


        if (hours < 0 || hours > 23) {
            interviewTimeErrorDiv.innerHTML = "<span class='text-danger'>Hours must be between 00 and 23.</span>";
            interviewTime.classList.add("is-invalid");
            event.preventDefault();
            return false;
        }

    
        if (minutes < 0 || minutes > 59) {
            interviewTimeErrorDiv.innerHTML = "<span class='text-danger'>Minutes must be between 00 and 59.</span>";
            interviewTime.classList.add("is-invalid");
            event.preventDefault();
            return false;
        }

     
        if (interviewTimeValue !== "" && timePeriod.value === "") {
            timeErrorDiv.innerHTML = "<span class='text-danger'>Please select AM or PM.</span>";
            timePeriod.classList.add("is-invalid");
            event.preventDefault();
            return false;
        }

        return true; 
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector("form").addEventListener("submit", validateForm);
    });
</script>
@endsection


