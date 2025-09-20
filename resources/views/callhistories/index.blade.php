@extends('layouts.app')

@section('content')
@section('title', 'Call History')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Create New Call History Entry</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('callhistory.index') }}">Call History</a></li>
                        <li class="breadcrumb-item"><span>Create New Entry</span></li>
                    </ul>
                </div>
            </div>
            
            <div class="col-sm-12 col-12 text-left add-btn-col">
                <a href="{{ route('callhistory.show') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-list"></i> View All Call History </a>
            </div>
        </div>

        <!-- Display Toastr messages -->
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
                                            Create New Call History Entry
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
                         
                            <form class="m-b-30" method="POST" action="{{ route('callhistory.store') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Mobile Number <span class="text-danger">*</span></label></strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="mobile_no" placeholder="Mobile Number" value="{{ old('mobile_no') }}" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-mobile"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>Company Name <span class="text-danger">*</span></label></strong>
                                            <input type="text" class="form-control" name="company_name" placeholder="Company Name" value="{{ old('company_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <strong><label>HR Name <span class="text-danger">*</span></label></strong>
                                            <input type="text" class="form-control" name="hr_name" placeholder="HR Name" value="{{ old('hr_name') }}" required>
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
                                    <button type="submit" class="btn btn-primary btn-lg">Register</button>
                                </div>
                            </form>
                             
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    Call History
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
                                        <th>Mobile Number</th>
                                        <th>Technology</th>
                                        <th>Comment</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($callHistories as $callHistory)
                                    <tr>
                                        <td>{{ $callHistory->id }}</td>
                                        <td>{{ $callHistory->mobile_no }}</td>
                                        <td>{{ $callHistory->technology->technology_name  }}</td>
                                        <td>{{ $callHistory->comment }}</td>
                                        <td>{{ $callHistory->created_by }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('callhistory.edit', $callHistory->id) }}" class="btn btn-primary btn-sm mb-1">
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
            </div> -->
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

$(document).ready(function() {
    $('.select2').select2();
 
});
</script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->


@endsection
