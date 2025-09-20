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
                 <a href="{{ route('vendors.createVendor') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Vendor </a>
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
                                        <th>Id</th>
                                        <th>Vendor Name</th>
                                        <th>Email</th>
                                        <th>Alternate Email</th>
                                        <th>Phone Number</th>
                                        <th>Alternate Phone Number</th>
                                        <th>Technology</th>
                                        <th>Comment</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->vendor_id }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>{{ $vendor->alternate_email }}</td>
                                        <td>{{ $vendor->phone_number }}</td>
                                        <td>{{ $vendor->alternate_phone_number }}</td>
                                        <td>{{ $vendor->technology->technology_name }}</td>
                                        <td>{{ $vendor->comment }}</td>
                                        <td>{{ $vendor->created_at }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('vendors.editVendor', $vendor->vendor_id) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a>
                                          
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

   

