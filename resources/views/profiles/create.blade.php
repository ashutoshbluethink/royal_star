@extends('layouts.app')

@section('content')
@section('title', 'Profile')

<div class="page-wrapper">
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Profile</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="add-card.php">Profile</a></li>
                    <li class="breadcrumb-item"><span> Add Profile</span></li>
                </ul>
            </div>
        </div>
        <!-- <div class="col-sm-12 col-12 text-left add-btn-col">
            <a href="" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Record </a>
        </div> -->
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

    <div class="row">
        <div class="col-lg-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Add Profile Name
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('profiles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Profile Name</label>
                            <input type="text" class="form-control" name="profile_name" id="profile_name">
                            <div id="profile_name_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="form-group">
                            <label>Ring Central Number</label>
                            <input type="text" class="form-control" name="ring_central_number" id="ring_central_number">
                            <div id="ring_central_number_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" id="username">
                            <div id="username_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="form-group">
                            <label>Password </label>
                            <input type="password" class="form-control" name="password" id="password">
                            <div id="password_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="form-group">
                            <label for="comment">Comment</label>
                            <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
                            <div id="comment_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>
                        
                        <div class="card-body">
                            <div id="variant-section">
                                <div class="row mt-12">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Email ID <i class="fas fa-envelope"></i></label>
                                            <input type="email" class="form-control" placeholder="Enter Email ID" name="email_id[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Password for Email <i class="fas fa-lock"></i></label>
                                            <input type="password" class="form-control" placeholder="Enter Password" name="email_password[]">
                                        </div>
                                    </div>
                                    <div class="col-sm-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-primary btn-sm mb-1 mr-1" onclick="addVariant()"><i class="fas fa-plus"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm mb-1" onclick="removeVariant(this)"><i class="far fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center custom-mt-form-group">
                            <button class="btn btn-primary mr-2" type="submit" name="submit">Add Profile</button>
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
                                            <td>{{ $profile->created_at->format('d M Y') }}</td>
                                            <td class="text-right">
                                                <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <!-- <a href="" class="btn btn-warning btn-sm mb-1">
                                                    <i class="far fa-eye"></i>
                                                </a> -->
                                                <!-- Add delete button if needed -->
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
    function addVariant() {
        var clone = document.querySelector('#variant-section .row').cloneNode(true);
        clone.querySelectorAll('input').forEach(function(input) {
            input.value = '';
        });
        document.querySelector('#variant-section').appendChild(clone);
    }

    function removeVariant(button) {
        var row = button.parentNode.parentNode;
        if (row.parentNode.childElementCount > 1) {
            row.parentNode.removeChild(row);
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

