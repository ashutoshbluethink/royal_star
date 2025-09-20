@extends('layouts.app')

@section('content')
@section('title', 'Role')

<div class="page-wrapper">
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title"> Add Role</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="add-card.php">Role</a></li>
                    <li class="breadcrumb-item"><span> Add Role</span></li>
                </ul>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-12 text-left add-btn-col">
            <a href="store_add.php" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Role </a>
        </div> -->
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

    
    <div class="row">
        <div class="col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Add Role Name
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <form action="{{ route('add.role.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" placeholder="Enter the role name" name="role_name" id="role_name">
                                <div id="role_name_error" class="error" style="color: red; font-weight: bold;"></div>
                            </div>
                            
                            <div class="form-group text-center custom-mt-form-group">
                                <button class="btn btn-primary mr-2" type="submit" name="submit">Add Role</button>
                                <button class="btn btn-secondary" type="reset">Reset</button>
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
                                Role Lists
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    @if(isset($_GET['store_id']))
                                        <th> </th>
                                    @endif
                                    <th>Role Id</th>
                                    <th>Role Name</th>
                                    <th>Role Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->role_id }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td style="font-weight: bold; color: {{ $role->role_status == 1 ? 'green' : 'red' }};">
                                        {{ $role->role_status == 1 ? 'Active' : 'Inactive' }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('edit.role', $role->role_id) }}" class="btn btn-primary btn-sm mb-1">
                                            <i class="far fa-edit"></i>
                                        </a>
                                        <!-- <a href="{{ route('delete.role', $role->role_id) }}" class="btn btn-danger btn-sm mb-1">
                                            <i class="far fa-trash-alt"></i>
                                        </a> -->
                                        <!-- <button type="submit" data-toggle="modal" data-target="#delete_role"
                                            class="btn btn-danger btn-sm mb-1">
                                            <i class="far fa-trash-alt"></i>
                                        </button> -->
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
<div id="delete_role" class="modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h4 class="modal-title">Delete Role</h4>
            </div>
            <form id="delete_role_form" action="{{ route('delete.role', $role->role_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>Are you sure want to delete this?</p>
                    <div class="m-t-20">
                        <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger" >Delete</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

   

