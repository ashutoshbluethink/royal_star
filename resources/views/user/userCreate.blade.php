@extends('layouts.app')

@section('content')
@section('title', 'Users')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Create New Users</h5>
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
                                            Create New Users
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
                         
                        <form class="m-b-30" method="POST" action="{{ route('add.user.submit') }}" enctype="multipart/form-data">
							@csrf
							<div class="row">
							
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<input type="text" class="form-control" value="{{ old('firstname') }}" name="firstname" required>
										<label class="focus-label">Firstname <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<input type="text" class="form-control" value="{{ old('lastname') }}" name="lastname" required>
										<label class="focus-label">Lastname <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<input type="email" class="form-control" value="{{ old('email') }}" name="email" required>
										<label class="focus-label">Email <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<input type="password" class="form-control" name="password" required>
										<label class="focus-label">Password <span class="text-danger">*</span></label>
									</div>
								</div>
							
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<input type="text" class="form-control"  value="{{ old('phone') }}" name="phone" required>
										<label class="focus-label">Phone <span class="text-danger">*</span></label>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group form-focus">
										<select class="form-control select2" name="role" required>
											<option value="">--Select--</option>
											@foreach($roles as $role)
												<option value="{{ $role->role_id }}">{{ $role->role_name }}</option>
											@endforeach
										</select>
										<label class="focus-label">Role <span class="text-danger">*</span></label>
									</div>
								</div>
							
								<div class="container">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Image</label>
												<input type="file" name="user_image" accept="image/*" class="form-control" id="user_image" onchange="previewImage(this);">
												<br>
											
												<div id="user_image_error" class="error" style="color: red; font-weight: bold;"></div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Image Preview</label><br>
												<img id="imagePreview" src="{{ asset('assets/img/store_logo/placeholder.jpg') }}" alt="Image Preview" width="80" height="80">
											</div>
										</div>
									</div>
								</div>
								
							</div>
							<div class="m-t-20 text-center">
								<button type="submit" class="btn btn-primary btn-lg">Create User</button>
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

   

