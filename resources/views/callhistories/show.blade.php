@extends('layouts.app')

@section('content')
@section('title', 'Lead')
<div class="page-wrapper">
    <div class="content container-fluid">
    
        
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
        <div class="content-page">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <h5 class="text-uppercase mb-0 mt-0 page-title">Call History</h5>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <ul class="breadcrumb float-right p-0 mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('callhistory.index') }}">Call History</a></li>
                            <li class="breadcrumb-item"><span>All Entry</span></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-sm-12 col-12 text-left add-btn-col">
                    <a href="{{ route('callhistory.index') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-list"></i> Add Call History </a>
                </div>
            </div>

     

            <!-- <form class="m-b-30" method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input class="form-control datetimepicker-input floating datetimepicker" type="text" name="from_date" data-toggle="datetimepicker" value="{{ isset($selectedValues['from_date']) ? $selectedValues['from_date'] : '' }}">
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <input class="form-control datetimepicker-input datetimepicker floating" type="text" name="to_date" data-toggle="datetimepicker" value="{{ isset($selectedValues['to_date']) ? $selectedValues['to_date'] : '' }}">
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                        <select class="form-control select2" name="interview_status">
                            <option value="">--Select--</option>
                       
                        </select>
                            <label class="focus-label">Interview Status</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <button type="submit" class="btn btn-search rounded btn-block mb-3">Search</button>
                    </div>
                </div>
            </form> -->

            <div class="row">
                <div class="col-lg-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="page-title">
                                        Call Lists
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
                                            <th>Company Name</th>
                                            <th>Hr Name</th>
                                            <th>Created BY</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($callHistories as $callHistory)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <i class="fas fa-mobile-alt mr-1" title="Mobile Number"></i>{{ $callHistory->mobile_no }}
                                            </td>
                                            <td>
                                                <i class="fas fa-cogs mr-1" title="Technology Name"></i>{{ $callHistory->technology->technology_name }}
                                            </td>

                                            <td>
                                                <textarea class="form-control" rows="2" readonly data-toggle="popover" title="{{ $callHistory->comment }}" data-content="{{ $callHistory->comment }}" style="width: 100%;">{{ $callHistory->comment }}</textarea>
                                            </td>
                                            <td style="font-weight: bold; color: #00008B;">
                                                {{ $callHistory->company_name }}
                                                @if($callHistory->company_name)
                                                    <i class="fas fa-building ml-1" title="Company Name"></i>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $callHistory->hr_name }}
                                                @if($callHistory->hr_name)
                                                    <i class="fas fa-user ml-1" title="HR Name"></i>
                                                @endif
                                            </td>
                                            <!-- <td>{{ $callHistory->created_at->format('d-M-Y h:i A') }}</td> -->
                                            <td>
                                                {{ $callHistory->created_by }}
                                            </td>
                                            <td class="text-right">
                                                <a href="{{ route('callhistory.viewCallDetails', $callHistory->id) }}" class="btn btn-warning btn-sm mb-1">
                                                    <i class="far fa-eye"></i> View Log
                                                </a>
                                                @if(auth()->user()->role != 3)
                                                    <a href="{{ route('callhistory.edit', $callHistory->id) }}" class="btn btn-primary btn-sm mb-1">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('callhistory.destroy', $callHistory->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Are you sure you want to delete this call history?')">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
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
            "buttons": ["pdf"],
            "order": [[0, "desc"]] // Order by the first column (ID) in descending order
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->

@endsection

   

