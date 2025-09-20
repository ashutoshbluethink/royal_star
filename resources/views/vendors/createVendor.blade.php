@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Create New Vendor</h5>
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
                <a href="{{ route('vendors.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> View All Vendors </a>
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
                                            Create New Vendor
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
                         
                            <form class="m-b-30" method="POST" action="{{ route('add.vendor.submit') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Vendor Name <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="name" placeholder="Vendor Name" value="{{ old('name') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-building"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Vendor Email <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="email" placeholder="Vendor Email" value="{{ old('email') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Technology <span class="text-danger">*</span></label></strong>
                                            <select class="form-control select2" name="technology_id">
                                                <option value="">--Select Technologies--</option>
                                                @foreach($technologies as $technology)
                                                    <option value="{{ $technology->technology_id }}" {{ old('technology_id') == $technology->technology_id ? 'selected' : '' }}>{{ $technology->technology_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Phone Number <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Alternate Email(Optional)</label></strong>
                                            <div class="input-group">
                                                <input type="email" class="form-control" name="alternate_email" placeholder="Alternate Email" value="{{ old('alternate_email') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-envelope"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Alternate Phone Number(Optional)</label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="alternate_phone_number" placeholder="Alternate Phone Number" value="{{ old('alternate_phone_number') }}">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-phone"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <strong><label>Comment (Optional)</label></strong>
                                            <div class="input-group">
                                                <textarea class="form-control" name="comment" rows="3" placeholder="Comment">{{ old('comment') }}</textarea>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-comment"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Register Vendor</button>
                                </div>
                            </form>



                    </div>
                </div>
            </div>

    
            
        </div>
        @include('section/notification') 
    </div>

    <div id="delete_employee" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Role</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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

$(document).ready(function() {
    $('.select2').select2();
    $('#company_select').change(function(){ 
        var value = $(this).val();
        if(value=='other'){
        $("#other_company_input").css("display", "block");
        }else{
        $("#other_company_input").css("display", "none");
        }
    });
});
</script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@endsection

   

