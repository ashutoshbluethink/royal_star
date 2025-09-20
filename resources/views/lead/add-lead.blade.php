@extends('layouts.app')

@section('content')
@section('title', 'ADD Lead Data')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title"> Create New Lead</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">Lead</a></li>
                        <li class="breadcrumb-item"><span> Add Lead</span></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-sm-12 col-12 text-left add-btn-col">
                <a href="{{ route('view.lead') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> View All Lead </a>
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
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <div class="page-title">
                                            Create New Lead
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
                            <!-- @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif -->
                            <form class="m-b-30" method="POST" action="{{ route('add.lead.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="company_id" id="company_select">
                                                <option value="">--Select Company--</option>
                                                <option value="other" {{ old('company_id') == 'other' ? 'selected' : '' }}>Other</option> 
                                                @foreach($companies as $company)
                                                    <option value="{{ $company->company_id }}" {{ (old('company_id') == $company->company_id || session('selected_company_id') == $company->company_id) ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Company<span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="other_company_input" style="display: none;">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control" name="other_company_name" value="{{ old('other_company_name') }}" placeholder="Enter Other Company Name" >
                                            <label class="focus-label">Enter Other Company Name</label>
                                        </div>
                                    </div>
                               

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="vendor_id">
                                                <option value="">--Select vendor--</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{ $vendor->vendor_id }}" {{ old('candidate_id') == $vendor->vendor_id ? 'selected' : '' }}>{{ $vendor->name }} {{$vendor->technology->technology_name }}<span style="color:red"></span> </option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Vendor Name<span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="interviewee_id">
                                                <option value="">--Select Interviewee--</option>
                                                <option value="other">Other</option>
                                                @foreach($interviewee_users as $user)
                                                    <option value="{{ $user->user_id }}" {{ old('interviewee_id') == $user->user_id ? 'selected' : '' }}>{{ $user->firstname }} {{ $user->lastname }} <span style="color:red"> - {{ $user->role_name }}</span></option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Interviewee<span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input name="interview_date" class="form-control datetimepicker-input datetimepicker" type="text" data-toggle="datetimepicker" value="{{ old('interview_date') }}">
                                            <label class="focus-label">Interview Date <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                            
                                    <div class="col-sm-3">
                                        <div class="form-group form-focus">
                                            <!-- For Create: Default interview time is empty initially -->
                                            <input name="interview_time" class="form-control" type="text" placeholder="Enter interview time" value="{{ old('interview_time') }}">
                                            <div id="interview_time_error"></div>
                                            <label class="focus-label">Interview Time(IST)</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group form-focus">
                                            <select name="time_period" class="form-control">
                                                <option value="" {{ old('time_period') == "" ? "selected" : "" }}>Select</option>
                                                <option value="AM" {{ old('time_period') == "AM" ? "selected" : "" }}>AM</option>
                                                <option value="PM" {{ old('time_period') == "PM" ? "selected" : "" }}>PM</option>
                                            </select>
                                            <label class="focus-label">Time Period</label>
                                            <div id="time_period_error"></div>
                                        </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="interview_status" required>
                                                <option value="">--Select--</option>
                                                @foreach($LeadStatuss as $LeadStatus)
                                                    <option value="{{ $LeadStatus->leadstatusid }}"{{ $LeadStatus->leadstatusid ==  1 ? 'selected' : '' }}>{{ $LeadStatus->leadstatusname }}</option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Interview Status<span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input name="company_email" class="form-control" type="company_email" placeholder="Email (Optional)" value="{{ old('company_email') }}">
                                            <label class="focus-label">Client Email(Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input name="company_phone" class="form-control" type="tel" placeholder="Phone (Optional)" value="{{ old('company_phone') }}">
                                            <label class="focus-label">Phone (Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input name="company_rate" class="form-control" type="number" placeholder="Rate (Optional)" value="{{ old('company_rate') }}">
                                            <label class="focus-label">Rate (Optional)</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input name="source" class="form-control" type="text" placeholder="Source (Optional)" value="{{ old('source') }}">
                                            <label class="focus-label">Source (Optional)</label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select name="region" class="form-control select2" required>
                                                <option value="">-- Select --</option>
                                                <option value="Indian" 
                                                    {{ (old('region') == 'Indian' || (isset($editLead) && $editLead->region == 'Indian')) ? 'selected' : '' }}>
                                                    Indian
                                                </option>
                                                <option value="USA" 
                                                    {{ (old('region') == 'USA' || (isset($editLead) && $editLead->region == 'USA')) ? 'selected' : '' }}>
                                                    USA
                                                </option>
                                                <option value="Other" 
                                                    {{ (old('region') == 'Other' || (isset($editLead) && $editLead->region == 'Other')) ? 'selected' : '' }}>
                                                    Other
                                                </option>
                                            </select>
                                            <label class="focus-label">Region <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="lead_supported_by">
                                                <option value="">-- Select Lead Supported By --</option>
                                                @foreach($leadSupportedUsers as $user)
                                                    <option value="{{ $user->user_id }}" {{ old('lead_supported_by') == $user->user_id ? 'selected' : '' }}>
                                                        {{ $user->firstname }} {{ $user->lastname }}
                                                        <span style="color:red"> - {{ $user->role_name }}</span>
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Lead Supported By(Optional)</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group form-focus">
                                            <textarea name="meeting_link" class="form-control" placeholder="Meeting Link (Optional)">{{ old('meeting_link') }}</textarea>
                                            <label class="focus-label">Meeting Link (Optional)</label>
                                        </div>
                                    </div>

                                
                                    <div class="col-sm-12">
                                        <div class="form-group form-focus">
                                            <textarea name="lead_comment" class="form-control" rows="5" placeholder="Lead Comment">{{ old('lead_comment') }}</textarea>
                                            <label class="focus-label">Lead Comment (Optional)</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Create Lead</button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Lead Lists
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th style="display: none;">Id</th>
                                    <th> </th>
                                    <th>Company</th>
                                    <th>Technologies</th>
                                    <th>Vendors</th>
                                    <th>Interviewee</th>
                                    <th>Created BY</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                            </tbody>
                        </table>
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
                // "buttons": ["pdf"],
                "order": [[0, "desc"]] // Order by the first column in ascending order
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });

        $(document).ready(function() {
            $('.select2').select2();

            var selectedCompanyValue = $('#company_select').find(":selected").val();

            if(selectedCompanyValue == 'other'){
                $("#other_company_input").css("display", "block");
            } else {
                $("#other_company_input").css("display", "none");
            }

            $('#company_select').change(function(){ 
                var selectedValue = $(this).val();

                if(selectedValue == 'other'){
                    $("#other_company_input").css("display", "block");
                } else {
                    $("#other_company_input").css("display", "none");
                }
            });
        });
    </script>

    <script src="{{ asset('assets/js/moment.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script>
    $(function () {
        $('.datetimepicker').datetimepicker({
        format: 'DD-MM-YYYY'
        });
    });
    </script>

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


