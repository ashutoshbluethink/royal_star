@extends('layouts.app')

@section('title', 'Employee Previous Employment History')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <h5 class="text-uppercase">Employee Previous Employment History</h5>
        </div>

        <form action="#" method="POST">
            @csrf
            <div class="card">
                <div class="card-body">
                    
                    <!-- Personal Information -->
                    <h5 class="mb-3">Personal Information</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Full Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}">
                        </div>

                        <label class="col-md-2 col-form-label">Entry Date in UAE:</label>
                        <div class="col-md-4">
                            <input type="date" name="entry_date_uae" class="form-control" value="{{ old('entry_date_uae') }}">
                        </div>
                    </div>

                    <!-- Employment History Section -->
                    <h5 class="mb-3">Previous Employment Details</h5>

                    @for($i = 1; $i <= 3; $i++)
                    <div class="border p-3 mb-4">
                        <h6 class="text-primary">Employment Detail {{ $i }}</h6>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Company Name:</label>
                            <div class="col-md-4">
                                <input type="text" name="company_name_{{ $i }}" class="form-control" value="{{ old('company_name_' . $i) }}">
                            </div>

                            <label class="col-md-2 col-form-label">Trade:</label>
                            <div class="col-md-4">
                                <input type="text" name="trade_{{ $i }}" class="form-control" value="{{ old('trade_' . $i) }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label">Duration (From - To):</label>
                            <div class="col-md-4">
                                <input type="text" name="duration_{{ $i }}" class="form-control" value="{{ old('duration_' . $i) }}">
                            </div>

                            <label class="col-md-2 col-form-label">Reason for Leaving:</label>
                            <div class="col-md-4">
                                <input type="text" name="reason_leaving_{{ $i }}" class="form-control" value="{{ old('reason_leaving_' . $i) }}">
                            </div>
                        </div>
                    </div>
                    @endfor

                    <!-- Declaration -->
                    <h5 class="mb-3">Declaration</h5>
                    <p class="mb-3">
                        I hereby declare that the information provided above is true and correct to the best of my knowledge. I understand that any false information may lead to termination of employment.
                    </p>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Date:</label>
                        <div class="col-md-4">
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                        </div>

                        <label class="col-md-2 col-form-label">Signature:</label>
                        <div class="col-md-4">
                            <input type="text" name="signature" class="form-control" value="{{ old('signature') }}">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>

                </div>
            </div>
        </form>

    </div>
</div>
@endsection
