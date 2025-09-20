@extends('layouts.app')

@section('content')
@section('title', 'Lead Status')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Lead Status</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('add.leadstatus') }}">Lead</a></li>
                        <li class="breadcrumb-item"><span>Lead Status</span></li>
                    </ul>
                </div>
            </div>
            @if(isset($editleadStatus))
                <div class="col-sm-12 col-12 text-left add-btn-col">
                    <a href="{{ route('add.leadstatus') }}" class="btn btn-primary float-right btn-rounded"><i class="fas fa-plus"></i> Add New Lead Status </a>
                </div>
            @endif

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
                                    @if(isset($editleadStatus))
                                        <div class="page-title">
                                                Update Lead Status 
                                        </div>
                                    @else
                                        <div class="page-title">
                                            Add Lead Status
                                        </div>
                                    @endif

                                    </div>
                                </div>
                            </div>
                            
                            <form action="{{ isset($editleadStatus) ? route('leadstatus.update', ['leadstatus' => $editleadStatus->leadstatusid]) : route('add.leadstatus.submit') }}" method="POST">
                                @csrf
                                @if(isset($editleadStatus))
                                    @method('PUT')
                                @endif
                                <div class="form-group">
                                    <label style="font-weight: bold;">LeadStatus Name<span style="color: red;"> *</span></label>
                                    <input type="text" class="form-control" placeholder="Enter the lead status name" name="leadstatusname" id="leadstatusname" value="{{ isset($editleadStatus) ? $editleadStatus->leadstatusname : '' }}">
                                    <div id="leadstatusname_error" class="error" style="color: red; font-weight: bold;"></div>
                                </div>
                                @if(isset($editleadStatus))
                                    <div class="form-group">
                                        <label style="font-weight: bold;">LeadStatus Status<span style="color: red;"> *</span></label>
                                        <select class="form-control" name="leadstatusstatus" id="leadstatusstatus">
                                            <option value="active" {{ $editleadStatus->leadstatusstatus == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $editleadStatus->leadstatusstatus == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="form-group text-center custom-mt-form-group">
                                    <button class="btn btn-primary mr-2" type="submit" name="submit">{{ isset($editleadStatus) ? 'Update' : 'Add' }} Lead Status</button>
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
                                Add Lead Status
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
                                        <th>Status Name</th>
                                        <th>Lead Status Status</th>
                                        <th>No of lead</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leadStatuses as $leadStatus)
                                    <tr>
                                        <td>{{ $leadStatus->leadstatusid }}</td>
                                        <td>{{ $leadStatus->leadstatusname }}</td>
                                        <td style="font-weight: bold; color: {{ $leadStatus->leadstatusstatus == 'active' ? 'green' : 'red' }};">
                                            {{ $leadStatus->leadstatusstatus == "active" ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td>{{ $leadStatusesCount[$leadStatus->leadstatusid] }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('leadstatus.edit', $leadStatus->leadstatusid) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            @if ($leadStatusesCount[$leadStatus->leadstatusid] > 0)
                                                <!-- Hide the delete button if lead count is greater than 0 -->
                                            @else
                                                <button type="submit" data-toggle="modal" data-target="#delete_leadstatus" class="btn btn-danger btn-sm mb-1">
                                                    <i class="far fa-trash-alt"></i>
                                                </button>
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
        @include('section/notification') 
    </div>
    <div id="delete_leadstatus" class="modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Lead Status</h4>
                </div>
                <form id="delete_leadstatus" action="{{ route('leadstatus.delete', $leadStatus->leadstatusid) }}" method="POST">
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
