<!-- resources/views/email_validation.blade.php -->

@extends('layouts.app')

@section('title', 'Email Validation')

@section('content')
<style>
    /* Add this to your CSS file or within a <style> tag in your Blade template */

/* Ensuring responsive design */
.email-status-cards {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: center; /* Center the cards */
}

.email-status-card {
    flex: 1;
    min-width: 200px;
    max-width: 300px; /* Add max-width for better responsiveness */
    border: 1px solid #dee2e6;
    border-radius: 50px;
    background: #f8f9fa;
    padding: 15px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.email-status-card .card-body {
    text-align: center;
}

.email-status-card .badge {
    font-size: 1.0em; /* Reduce the font size for smaller circles */
    padding: 10px; /* Adjust padding for smaller circles */
    border-radius: 50%; /* Ensure the badges are circular */
    display: inline-block; /* Ensure proper display */
    /* width: 50px;  */
    /* height: 50px;  */
    line-height: 30px; /* Center the text/icon vertically */
}

.email-status-card .badge .fas {
    line-height: 30px; /* Ensure the icon is centered vertically */
}

.email-status-card .card-title-email {
    margin-top: 10px;
    font-weight: bold;
}

.email-status-card .card-text {
    margin: 5px 0;
}
/* Example of media query for additional responsiveness */
@media (max-width: 576px) {
    .email-status-card {
        min-width: 100%;
    }

    .email-status-card .badge {
        width: 40px; /* Smaller width for very small screens */
        height: 40px; /* Smaller height for very small screens */
        line-height: 20px; /* Adjust line height accordingly */
    }
}
/* ------------------------
 */

 #loader {
    position: fixed;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    color: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    border: 16px solid #f3f3f3; /* Light grey */
    border-top: 16px solid #3498db; /* Blue */
    border-radius: 50%;
    width: 120px;
    height: 120px;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <h5 class="text-uppercase mb-0 mt-0 page-title">Email Validation Form</h5>
            <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item"><span>Email Validation</span></li>
            </ul>
        </div>
<!-- Email Count Section -->

<div id="loader" style="display: none;">
    <div class="spinner"></div>
    <p>Processing your emails, please wait...</p>
</div>

<div class="mt-4">
    <div class="row">
        <div class="col-12">
            <div class="email-status-cards">
                @php
                    $totalValid = 0;
                    $totalInvalid = 0;
                    $totalDuplicate = 0;
                @endphp

                @foreach ($emailCounts as $user => $counts)
                    @php
                        $validCount = $counts['valid_count'] ?? 0;
                        $invalidCount = $counts['invalid_count'] ?? 0;
                        $duplicateCount = $counts['duplicate_count'] ?? 0;

                        $totalValid += $validCount;
                        $totalInvalid += $invalidCount;
                        $totalDuplicate += $duplicateCount;
                    @endphp
                    
                    <div class="email-status-card text-center">
                        <div class="card-body bg-light">
                            <span class="badge badge-info mb-2">
                                <i class="fas fa-user"></i> {{ $user }}
                            </span>
                            <h6 class="card-title-email" style="margin: 10px 0;">
                                <i class="fas fa-check-circle" style="color: green;"></i> 
                                <span style="color: green;">Valid Emails: {{ $validCount }}</span>
                            </h6>
                            <h6 class="card-title-email" style="margin: 10px 0;">
                                <i class="fas fa-times-circle" style="color: red;"></i> 
                                <span style="color: red;">Invalid Emails: {{ $invalidCount }}</span>
                            </h6>
                            <h6 class="card-title-email" style="margin: 10px 0;">
                                <i class="fas fa-exclamation-circle" style="color: orange;"></i> 
                                <span style="color: orange;">Duplicate Emails: {{ $duplicateCount }}</span>
                            </h6>
                        </div>
                    </div>
                @endforeach

                <!-- Total Counts -->
                <div class="email-status-card text-center">
                    <div class="card-body bg-light">
                        <span class="badge badge-success mb-2">
                            <i class="fas fa-envelope"></i> Total
                        </span>
                        <h6 class="card-title-email">Total Valid Emails: {{ $totalValid }}</h6>
                        <h6 class="card-title-email">Total Invalid Emails: {{ $totalInvalid }}</h6>
                        <h6 class="card-title-email">Total Duplicate Emails: {{ $totalDuplicate }}</h6>
                    </div>
                </div>
                <!-- End of Total Counts -->

            </div>
        </div>
    </div>
</div>


<!-- End of Email Count Section -->
        <!-- Display Toastr messages -->
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('email.validate') }}" class="rawemailform">
                            @csrf
                            <div class="form-group">
                                <label for="allemail">Raw Emails <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="allemail" name="allemail" rows="10" required>{{ old('allemail') }}</textarea>
                            </div>
                            <!-- Additional fields or inputs can be added as needed -->
                        
                            <button type="submit" class="btn btn-search rounded btn-block mb-3 mr-2">
                                <i class="fas fa-check-circle"></i> Validate
                            </button>
                        </form>
                        <br>
                        <form method="post" action="{{ route('export.valid.emails') }}" id="exportForm">
                            @csrf
                            <h5>Export Valid Emails</h5>
                            <div class="row filter-row">
                                <div class="col-sm-6 col-md-3">
                                    @if(auth()->user()->user_id == 10) <!-- Check if the current user ID is 10 -->
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="created_by" id="createdBy">
                                                <option value="">--Select--</option>
                                                <option value="all">All</option>
                                                @foreach($createdByNames as $name)
                                                    <option value="{{ $name->created_by }}">{{ $name->created_by }}</option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Created By</label>
                                        </div>
                                    @else
                                        <div class="form-group form-focus">
                                            <select class="form-control select2" name="created_by" id="createdBy" disabled>
                                                <option value="">--Select--</option>
                                                <option value="all">All</option>
                                                @foreach($createdByNames as $name)
                                                    <option value="{{ $name->created_by }}">{{ $name->created_by }}</option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Created By</label>
                                            <small>You do not have access to filter.</small>
                                        </div>
                                    @endif
                                </div>
                                <div class="col-sm-6 col-md-3 d-flex align-items-end">
                                    <button type="button" id="exportButton" class="btn btn-search rounded btn-block mb-3 mr-2" @if($totalValid == 0) disabled @endif>
                                        <i class="fas fa-file-csv"></i> Export
                                    </button>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        $(document).ready(function() {
        $('.select2').select2();

    });

    document.addEventListener('DOMContentLoaded', function () {
        var exportButton = document.getElementById('exportButton');
        var form = document.getElementById('exportForm');
        var userId = {{ auth()->user()->user_id }}; // Assuming user ID is available in Blade
        if (exportButton) {
            exportButton.addEventListener('click', function () {
                if (userId == 10) {
                    if (confirm("You are a super user. If you export, the data will be permanently deleted. Are you sure you want to proceed?")) {
                        form.submit();
                    }
                } else {
                    form.submit();
                }
            });
        }
    });


    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('exportForm'); // Replace with your form ID
        const loader = document.getElementById('loader');

        form.addEventListener('submit', function(event) {
            loader.style.display = 'flex';
        });

        // Optional: Hide loader if needed based on response (e.g., with AJAX)
    });

</script>
@endsection
