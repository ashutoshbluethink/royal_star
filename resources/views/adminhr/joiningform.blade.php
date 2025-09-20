@extends('layouts.app')

@section('title', 'Joining Form')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col-md-8 text-center">
                    <h2 class="text-primary text-uppercase" style="font-family: 'Arial', sans-serif; font-weight: bold;">
                        النجم الملكي للاستشارات الادارية
                    </h2>
                    <h5 class="text-muted font-weight-bold">ROYAL STAR MANAGEMENT CONSULTANCY</h5>
                    <h4 class="text-primary font-weight-bold text-decoration-underline my-3">
                        JOINING FORM
                    </h4>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 150px;" />
                    <div style="border: 2px solid #2a4a87; width: 150px; height: 150px; margin: 15px auto; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                        <img id="imagePreview" src="{{ asset('assets/img/store_logo/placeholder.jpg') }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Application + Joining Date --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Application Date:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="application_date" value="{{ old('application_date') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Joining Date:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="joining_date" value="{{ old('joining_date') }}" required>
                </div>
            </div>

            {{-- Name + Nationality --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Full Name:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Nationality:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="nationality" value="{{ old('nationality') }}" required>
                </div>
            </div>

            {{-- Passport + Visa --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Passport No:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="passport_no" value="{{ old('passport_no') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Visa Status:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="visa_status" value="{{ old('visa_status') }}" required>
                </div>
            </div>

            {{-- Expiry + Upload --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Expiry Date:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="expiry_date" value="{{ old('expiry_date') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Upload Image:</label>
                <div class="col-md-4">
                    <input type="file" name="user_image" accept="image/*" class="form-control" onchange="previewImage(this);">
                </div>
            </div>

            {{-- Mobile Numbers --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Mobile No #1:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="mobile_no_1" value="{{ old('mobile_no_1') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Mobile No #2:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="mobile_no_2" value="{{ old('mobile_no_2') }}" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Mobile No #3:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="mobile_no_3" value="{{ old('mobile_no_3') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Mobile No #4:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="mobile_no_4" value="{{ old('mobile_no_4') }}" required>
                </div>
            </div>

            {{-- Salary + Commission --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Basic Salary:</label>
                <div class="col-md-4">
                    <input type="number" step="any" class="form-control" name="basic_salary" value="{{ old('basic_salary') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Commission (%):</label>
                <div class="col-md-4">
                    <input type="number" step="any" class="form-control" name="commission" value="{{ old('commission') }}" required>
                </div>
            </div>

            {{-- Start + End Date --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Starting Date:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="starting_date" value="{{ old('starting_date') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">End Date:</label>
                <div class="col-md-4">
                    <input type="date" class="form-control" name="end_date" value="{{ old('end_date') }}" required>
                </div>
            </div>

            {{-- Commission % + Target --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Commission %:</label>
                <div class="col-md-4">
                    <input type="number" step="any" class="form-control" name="commission_percent" value="{{ old('commission_percent') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Monthly Target:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="monthly_target" value="{{ old('monthly_target') }}" required>
                </div>
            </div>

            {{-- Visa Charges + HR --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Visa Charges:</label>
                <div class="col-md-4">
                    <input type="number" step="any" class="form-control" name="visa_charges" value="{{ old('visa_charges') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">HR Name:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="hr_name" value="{{ old('hr_name') }}" required>
                </div>
            </div>

            {{-- Signatures --}}
            <div class="form-group row">
                <label class="col-md-2 col-form-label font-weight-bold">Applicant Signature:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="applicant_signature" value="{{ old('applicant_signature') }}" required>
                </div>
                <label class="col-md-2 col-form-label font-weight-bold">Thumbprint:</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="thumbprint" value="{{ old('thumbprint') }}" required>
                </div>
            </div>

            <hr style="border-top: 2px dotted #000;">

            {{-- Office Use --}}
            <div class="border p-3 mb-4" style="border: 2px dotted #2a4a87;">
                <h5 class="text-center text-danger font-weight-bold mb-4">FOR OFFICE USE</h5>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label" style="color: orange; font-weight: bold;">Sr. No#</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="sr_no" value="{{ old('sr_no') }}" required>
                    </div>
                    <label class="col-md-2 col-form-label font-weight-bold">Issued Number#</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="issued_number" value="{{ old('issued_number') }}" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-2 col-form-label font-weight-bold">Number of Devices#</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="number_of_devices" value="{{ old('number_of_devices') }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <strong class="text-primary">Documents Submission:</strong><br>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doc_passport" value="1" class="form-check-input" {{ old('doc_passport') ? 'checked' : '' }}>
                        <label class="form-check-label">Passport</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doc_picture" value="1" class="form-check-input" {{ old('doc_picture') ? 'checked' : '' }}>
                        <label class="form-check-label">Picture</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doc_visit_visa" value="1" class="form-check-input" {{ old('doc_visit_visa') ? 'checked' : '' }}>
                        <label class="form-check-label">Visit Visa Paper</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doc_cancellation" value="1" class="form-check-input" {{ old('doc_cancellation') ? 'checked' : '' }}>
                        <label class="form-check-label">Cancellation Paper</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="checkbox" name="doc_noc" value="1" class="form-check-input" {{ old('doc_noc') ? 'checked' : '' }}>
                        <label class="form-check-label">NOC Paper</label>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label class="col-md-2 col-form-label font-weight-bold">HR Name:</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control" name="office_hr_name" value="{{ old('office_hr_name') }}">
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="text-center my-4">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
