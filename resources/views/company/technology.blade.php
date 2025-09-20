@extends('layouts.app')

@section('content')
@section('title', 'technology')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">technology</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item"><a href="add-card.php">technology</a></li>
                        <li class="breadcrumb-item"><span> Add technology</span></li>
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
                                            Add technology Name
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($editTechnology))
                                <!-- Form for editing technology -->
                                <form action="{{ route('add.technology.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" class="form-control" value="{{ $editTechnology->technology_id }}" name="technology_id">
                                    <div class="form-group">
                                        <label>Technology Name</label>
                                        <input type="text" class="form-control" value="{{ $editTechnology->technology_name }}" name="technology_name" id="technology_name">
                                        <div id="technology_name_error" class="error" style="color: red; font-weight: bold;"></div>
                                    </div>

                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" name="technology_status">
                                            <option value="1" {{ $editTechnology->technology_status == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $editTechnology->technology_status == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Technology Image</label>
                                        <input type="file" class="form-control" name="tech_image" accept="image/*" onchange="previewImage(this)">
                                        @if(isset($editTechnology) && $editTechnology->tech_image)
                                            <img id="imagePreview" src="{{ asset($editTechnology->tech_image) }}" class="mt-2" height="60">
                                        @else
                                            <img id="imagePreview" class="mt-2" height="60" style="display: none;">
                                        @endif
                                    </div>

                                    <div class="form-group text-center custom-mt-form-group">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit">Update Technology</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                            @else
                                <!-- Form for adding technology -->
                                <form action="{{ route('add.technology.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label>Technology Name</label>
                                        <input type="text" class="form-control" placeholder="Enter the Technology Name" name="technology_name" id="technology_name">
                                        <div id="technology_name_error" class="error" style="color: red; font-weight: bold;"></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Technology Image</label>
                                        <input type="file" class="form-control" name="tech_image" accept="image/*" onchange="previewImage(this)">
                                        @if(isset($editTechnology) && $editTechnology->tech_image)
                                            <img id="imagePreview" src="{{ asset($editTechnology->tech_image) }}" class="mt-2" height="60">
                                        @else
                                            <img id="imagePreview" class="mt-2" height="60" style="display: none;">
                                        @endif
                                    </div>

                                    <div class="form-group text-center custom-mt-form-group">
                                        <button class="btn btn-primary mr-2" type="submit" name="submit">Add Technology</button>
                                        <button class="btn btn-secondary" type="reset">Reset</button>
                                    </div>
                                </form>
                            @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                    technology Lists
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>technology Id</th>
                                        <th>technology Name</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($technologys as $technology)
                                        <tr>
                                            <td>{{ $technology->technology_id }}</td>
                                            <td>{{ $technology->technology_name }}</td>
                                            <td style="font-weight: bold; color: {{ $technology->technology_status == 1 ? 'green' : 'red' }};">
                                                {{ $technology->technology_status == 1 ? 'Active' : 'Inactive' }}
                                            </td>
                                            <td>
                                                @if($technology->tech_image)
                                                    <img src="{{ asset($technology->tech_image) }}" height="40">
                                                @else
                                                    <span>No Image</span>
                                                @endif
                                            </td>

                                            <td class="text-right">
                                                <a href="{{ route('edit.technology', $technology->technology_id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="far fa-edit"></i>
                                                </a>
                                                <!--<a href="{{ route('delete.technology', $technology->technology_id) }}" class="btn btn-danger btn-sm mb-1">-->
                                                <!--    <i class="far fa-trash-alt"></i>-->
                                                <!--</a>-->
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

