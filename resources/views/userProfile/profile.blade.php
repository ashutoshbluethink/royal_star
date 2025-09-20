@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h5 class="text-uppercase mb-0 mt-0 page-title">my Profile</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <ul class="breadcrumb float-right p-0 mb-0">
                            <li class="breadcrumb-item"><a href="indeX-2.html"><i class="fas fa-home"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Pages</a></li>
                            <li class="breadcrumb-item"><span> Profile</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-box m-b-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-view">
                            <div class="profile-img-wrap">
                                <div class="profile-img">
                                    <a href="#"><img class="avatar" src="{{ asset('storage/' . $user->user_image) }}" alt=""></a>
                                </div>
                            </div>
                            <div class="profile-basic">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="profile-info-left">
                                            <h3 class="user-name m-t-0">{{ $user->firstname }} {{ $user->lastname }}</h3>
                                            <h5 class="company-role m-t-0 m-b-0">{{ $roleName }} </h5>
                                            <small class="staff-id" style="font-weight: bold; color: {{ $user->user_status == 1 ? 'green' : 'red' }}">
                                               {{ $user->user_status == 1 ? 'Active' : $user->user_status }}
                                            </small>


                                            <div class="staff-id">Employee ID : {{ $user->employee_id }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul class="personal-info">
                                            <li>
                                                <span class="title">Phone:</span>
                                                <span class="text"><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></span>
                                            </li>
                                            <li>
                                                <span class="title">Email:</span>
                                                <span class="text"><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></span>
                                            </li>
                                            <li>

                                            <span class="title">Change your password:</span>
                                            <span class="text"><a href="{{ route('changepassword') }}">Click here</a></span>
                                            
                                            </li>
                          
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        @include('section/notification') 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

