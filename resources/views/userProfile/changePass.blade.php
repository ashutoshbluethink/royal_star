@extends('layouts.app')

@section('content')
@section('title', 'Change Password')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Change Password</h5>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="card-header">
                            <h4 class="text-center">Update Your Password</h4>
                        </div>

                        <!-- Display Error and Success Messages -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('update.password') }}">
                            @csrf
                            <div class="form-group">
                                <label for="current_password"><strong>Current Password</strong> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password" required>
                            </div>

                            <div class="form-group">
                                <label for="new_password"><strong>New Password</strong> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" required>
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation"><strong>Confirm New Password</strong> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Re-enter New Password" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg">Change Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include Notifications Section -->
        @include('section/notification') 
    </div>
</div>

<!-- Toastr Notifications -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        @if(session('success'))
            toastr.success("{{ session('success') }}", "", { 
                timeOut: 5000, 
                progressBar: true, 
                positionClass: "toast-top-center" 
            });
        @endif

        @if($errors->any())
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}", "", { 
                    timeOut: 5000, 
                    progressBar: true, 
                    positionClass: "toast-top-center" 
                });
            @endforeach
        @endif
    });
</script>

@endsection
