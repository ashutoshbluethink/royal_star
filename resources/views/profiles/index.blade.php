@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title"> All Profile Lists</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item"><span> Add Profile</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Toastr JS -->
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
            <div class="col-sm-5 col-4">
            </div>
            <div class="col-sm-7 col-8 text-right add-btn-col">
                <a href="{{ route('profiles.create') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Profile</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Profile Lists
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
                                        <th>Profile Name</th>
                                        <th>Ring Central Number</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Comment</th>
                                        <th>Email Password</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($profiles as $profile)
                                        <tr>
                                            <td>{{ $profile->id }}</td>
                                            <td>{{ $profile->profile_name }}</td>
                                            <td>{{ $profile->ring_central_number }}</td>
                                            <td>{{ $profile->username }}</td>
                                            <td>{{ $profile->password }}</td>
                                            <td>{{ $profile->comment }}</td>
                                            <td>
                                                <ul>
                                                    @foreach($profile->emailPasses as $emailPass)
                                                        <li>{{ $emailPass->email_id }} ({{ $emailPass->email_password }})</li>
                                                    @endforeach
                                                </ul>
                                            </td>

                                          
                                            <td>{{ $profile->created_at->format('d M Y') }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary btn-sm mb-1">
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
    </div>

    <!-- Include Notification Section -->
    @include('section/notification')

    <!-- Delete Modal -->
    <div id="delete_employee" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Profile</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20">
                            <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
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
</script>


<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
@endsection

   

