@extends('layouts.app')

@section('content')
@section('title', 'Edit User')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Edit Users</h5>
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
                <a href="{{ route('view.user') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> View All Users </a>
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
                                             Edit User
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
                         
                            <form class="m-b-30" method="POST" action="{{ route('update.user', $edituser->user_id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Add method spoofing for PUT request -->
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control" value="{{ $edituser->firstname }}" name="firstname" required>
                                            <label class="focus-label">Firstname <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control" value="{{ $edituser->lastname }}" name="lastname" required>
                                            <label class="focus-label">Lastname <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input type="email" class="form-control" value="{{ $edituser->email }}" name="email" required>
                                            <label class="focus-label">Email <span class="text-danger">*</span></label>
                                        </div>
                                    </div>

                                    <!-- ✅ Show Password field ONLY if user role is Admin -->
                                    @php
                                        use Illuminate\Support\Facades\Auth;
                                    @endphp

                                    @if(Auth::user()->role == 1)  {{-- show only if logged-in user is Admin --}}
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input type="password" name="password" class="form-control">
                                            <label class="focus-label">Update Password</label>
                                        </div>
                                    </div>
                                    @endif


                                    <!-- Add other edituser fields here with their corresponding values -->
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <input type="text" class="form-control" value="{{ $edituser->phone }}" name="phone" required>
                                            <label class="focus-label">Phone <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control" name="role" required>
                                                <option value="">--Select--</option>
                                                @foreach($roles as $role)
                                                <option value="{{ $role->role_id }}" {{ $role->role_id == $edituser->role ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                                @endforeach
                                            </select>
                                            <label class="focus-label">Role <span class="text-danger">*</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>User Image</label>
                                            @if($edituser->user_image && file_exists(public_path('storage/' . $edituser->user_image)))
                                                <img id="imagePreview" src="{{ asset('storage/' . $edituser->user_image) }}" alt="User Image" class="img-thumbnail" width="120">
                                            @else
                                                <img id="imagePreview" src="{{ asset('assets/images/no-image.png') }}" alt="No Image" class="img-thumbnail" width="120">
                                            @endif

                                            <input type="file" name="user_image" class="form-control mt-2" onchange="previewImage(this);">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group form-focus">
                                            <select class="form-control" name="user_status" required>
                                                <option value="1" {{ $edituser->user_status == 1 ? 'selected' : '' }}>Active</option>
                                                <option value="0" {{ $edituser->user_status == 0 ? 'selected' : '' }}>Inactive</option>
                                            </select>
                                            <label class="focus-label">Status <span class="text-danger">*</span></label>
                                        </div>
                                    </div>


                                    <!-- Add fields for image upload and preview -->
                                </div>
                                <div class="m-t-20 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Update User</button>
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
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $('.select2').select2();
});
</script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->


@endsection

   

