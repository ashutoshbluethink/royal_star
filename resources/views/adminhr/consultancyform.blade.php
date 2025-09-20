@extends('layouts.app')

@section('title', 'Form')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Royal Star Management Consultancy</h5>
                </div>
            </div>
        </div>

        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">

                    <!-- Personal Details -->
                    <h5 class="mb-3">Personal Details</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Total Amount:</label>
                        <div class="col-md-2">
                            <input type="text" name="total_amount" class="form-control">
                        </div>
                        <label class="col-md-2 col-form-label">Paid:</label>
                        <div class="col-md-2">
                            <input type="text" name="paid" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">Balance:</label>
                        <div class="col-md-2">
                            <input type="text" name="balance" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        
                        <label class="col-md-2 col-form-label">Name of Candidate:</label>
                        <div class="col-md-4">
                            <input type="text" name="candidate_name" class="form-control">
                        </div>
                         <label class="col-md-2 col-form-label">Contact No:</label>
                        <div class="col-md-4">
                            <input type="text" name="contact_no" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Passport No:</label>
                        <div class="col-md-4">
                            <input type="text" name="passport_no" class="form-control">
                        </div>
                        <label class="col-md-2 col-form-label">Expiry Date:</label>
                        <div class="col-md-4">
                            <input type="date" name="expiry_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                       
                        <label class="col-md-2 col-form-label">Visa Status:</label>
                        <div class="col-md-4">
                            <input type="text" name="visa_status" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">Visa Expiry Date:</label>
                        <div class="col-md-4">
                            <input type="date" name="visa_expiry_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Nationality:</label>
                        <div class="col-md-4">
                            <input type="text" name="nationality" class="form-control">
                        </div>
                        <label class="col-md-2 col-form-label">Address:</label>
                        <div class="col-md-4">
                            <input type="text" name="address" class="form-control">
                        </div>
                    </div>

                    <!-- Job Details -->
                    <h5 class="mb-3">Job Details</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Gender:</label>
                        <div class="col-md-4 pt-2">
                            <label class="mr-3"><input type="checkbox" name="job_details[male]"> Male</label>
                            <label><input type="checkbox" name="job_details[female]"> Female</label>
                        </div>

                        <label class="col-md-2 col-form-label">Job Type:</label>
                        <div class="col-md-4 pt-2">
                            <label class="mr-3"><input type="checkbox" name="job_details[insource]"> Insource</label>
                            <label><input type="checkbox" name="job_details[outside_work]"> Outside Work</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Accommodation:</label>
                        <div class="col-md-4 pt-2">
                            <label class="mr-3"><input type="checkbox" name="job_details[our_accommodation]"> Our Accommodation</label>
                            <label><input type="checkbox" name="job_details[self_accommodation]"> Self Accommodation</label>
                        </div>

                        <label class="col-md-2 col-form-label">Trade Category 1:</label>
                        <div class="col-md-4">
                            <input type="text" name="trade_category_1" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Trade Category 2:</label>
                        <div class="col-md-4">
                            <input type="text" name="trade_category_2" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">Thumb Impression:</label>
                        <div class="col-md-4">
                            <input type="file" name="thumb" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Signature:</label>
                        <div class="col-md-4">
                            <input type="file" name="signature" class="form-control">
                        </div>
                    </div>

                    <!-- Remunerations -->
                    <h5 class="mb-3">Remunerations</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Salary:</label>
                        <div class="col-md-4">
                            <input type="text" name="salary" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">Accommodation:</label>
                        <div class="col-md-4">
                            <input type="text" name="accommodation" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Duty Time:</label>
                        <div class="col-md-4">
                            <input type="text" name="duty_time" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">Transportation:</label>
                        <div class="col-md-4">
                            <input type="text" name="transportation" class="form-control">
                        </div>
                    </div>

                    <!-- References -->
                    <h5 class="mb-3">Reference</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">1st Contact:</label>
                        <div class="col-md-4">
                            <input type="text" name="first_contact" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">2nd Contact:</label>
                        <div class="col-md-4">
                            <input type="text" name="second_contact" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Guardian:</label>
                        <div class="col-md-4">
                            <input type="text" name="guardian" class="form-control">
                        </div>
                    </div>

                     <!-- Terms and Conditions -->
                    <h5 class="mb-3">Terms and Conditions</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Accept Terms:</label>
                        <div class="col-md-4">
                            <input type="checkbox" name="accept_terms" id="accept_terms">
                            <label for="accept_terms">I have read and agree to the Terms and Conditions</label>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-link" id="toggle_terms">Read Full Terms & Conditions</button>
                        </div>
                        <div id="terms_text" style="display:none;">
                            <p>
                                <!-- Full Terms and Conditions Text -->
                                <strong>Term and Conditions:</strong><br>
                                The company will not be held accountable if you cease work without a legitimate justification. The company shall not assume any responsibility for the consequences if you find yourself in a conflict with someone or participate in any unlawful activities. <br><br>

                                We won't be held responsible once the deployment with the hiring company takes place.<br><br>

                                The candidate is required to follow the rules and regulations set by the hiring company.<br><br>

                                <strong>Refund and Relocation Clause:</strong><br>
                                1) Initial Deployment: The initial deployment of the employee to the designated position shall be completed within the mutually agreed time frame. Failure or refusal by the employee to join the assigned role without valid justification shall constitute a breach of contract and may result in appropriate legal and administrative actions as per company policy.<br><br>

                                2) Refund and Relocation: Once the employee has been deployed or commenced their first job assignment, they will have no entitlement to any refund, transfer, or relocation, regardless of personal or professional reasons. The company is only liable to refund the payment if the company fails to provide a job to the client as per the agreed Terms.<br><br>

                                <strong>Legal Action:</strong><br>
                                If the Employee fails to fulfill their obligations under this agreement, including but not limited to refusing to complete the assigned job, abandoning the job without a valid reason, or seeking refund or relocation after commencement of work, the Recruiter reserves the right to take legal action against the Employee for breach of contract.<br><br>

                                <!-- Continue the rest of the terms here -->
                            </p>
                        </div>
                    </div>

                    <!-- Office Use Section -->
                    <h5 class="mb-3" style="color:red;">FOR OFFICE USE</h5>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Remarks:</label>
                        <div class="col-md-4">
                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                        </div>

                        <label class="col-md-2 col-form-label">Date:</label>
                        <div class="col-md-4">
                            <input type="date" name="office_date" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Emp No #:</label>
                        <div class="col-md-4">
                            <input type="text" name="emp_no" class="form-control">
                        </div>

                        <label class="col-md-2 col-form-label">HR Name:</label>
                        <div class="col-md-4">
                            <input type="text" name="hr_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Signature:</label>
                        <div class="col-md-4">
                            <input type="file" name="hr_signature" class="form-control">
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="form-group text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // Toggle the full terms and conditions text
    document.getElementById('toggle_terms').addEventListener('click', function() {
        var termsText = document.getElementById('terms_text');
        if (termsText.style.display === "none") {
            termsText.style.display = "block";
            this.textContent = "Read Less";
        } else {
            termsText.style.display = "none";
            this.textContent = "Read Full Terms & Conditions";
        }
    });
</script>
@endsection
