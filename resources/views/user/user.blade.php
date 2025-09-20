@extends('layouts.app')

@section('content')
@section('title', 'Users')

		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<h5 class="text-uppercase mb-0 mt-0 page-title">users</h5>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-12">
							<ul class="breadcrumb float-right p-0 mb-0">
								<li class="breadcrumb-item"><a href="index.html"><i class="fas fa-home"></i> Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Management</a></li>
								<li class="breadcrumb-item"><span>Users</span></li>
							</ul>
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
				<div class="row">
					<div class="col-sm-4 col-4">
					</div>
					<div class="col-sm-8 col-8 text-right add-btn-col">
						<a href="{{ route('add.user') }}" class="btn btn-primary btn-rounded"><i
								class="fas fa-plus"></i> Add User</a>
					</div>
				</div>
				
				<script src="assets/js/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

                <!-- Display Toastr messages -->
                <script>
                    $(document).ready(function() {
                        @if(session('error'))
                            toastr.error("{{ session('errorMessage') }}", "", { 
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
				<div class="content-page">
				
					<div class="row">
						<div class="col-md-12 mb-3">
							<div class="table-responsive">
								<table id="example1" class="table custom-table datatable">
									<thead class="thead-light">
										<tr>
											<th style="display: none;">id</th>		
											<th>user_id</th>
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
											<th>Role</th>
											<th>User Image</th>
											<th>User Status</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>
									<tbody>
										@foreach($users as $user)
										<tr>
											<td style="display: none;">{{ $loop->iteration }}</td>
											<td>
												<a href="#" class="avatar">{{ $user->user_id }}</a>
												<h2><a href="#">{{ $user->firstname }} <span>{{ $user->role_name }}</span></a></h2>
											</td>
											<td>{{ $user->firstname }} {{ $user->lastname }}</td>
											<td>{{ $user->email }}</td>
											<td>{{ $user->phone }}</td>
											<!-- <td><span class="badge badge-danger-border">{{ $user->role_name }}</span></td> -->
											<td>
												@if($user->role == 1)
													<span class="badge badge-danger-border">{{ $user->role_name }}</span>
												@elseif($user->role == 2)
													<span class="badge badge-success-border">{{ $user->role_name }}</span>
												@elseif($user->role == 3)
													<span class="badge badge-info-border">{{ $user->role_name }}</span>
												<!-- Add more conditions for other role IDs if needed -->
												@else
													<span class="badge badge-warning-border">{{ $user->role_name }}</span>
												@endif
											</td>
										
											<td>
												@if($user->user_image)
													<img src="{{ asset('storage/' . $user->user_image) }}" alt="User Image" width="50">
												@else
												    <span class="avatar">
														{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}
													</span>
												@endif
											</td>
											<td style="font-weight: bold; color: {{ $user->user_status == 1 ? 'green' : 'red' }};">
                                                        {{ $user->user_status == 1 ? 'Active' : 'Inactive' }}
											</td>
										
											<td class="text-right">
												<a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-primary btn-sm mb-1">
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

		<div id="delete_user" class="modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content modal-md">
					<div class="modal-header">
						<h4 class="modal-title">Delete Employee</h4>
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
		<script>
			$(function () {
				$("#example1").DataTable({
					"responsive": true,
					"lengthChange": false,
					"autoWidth": false,
					"buttons": ["pdf", "print", "excel"],
					"order": [[0, "desc"]],
					"pageLength": 10 
				}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
			});
		</script>
@endsection
