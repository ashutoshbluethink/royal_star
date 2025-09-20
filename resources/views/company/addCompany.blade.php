@extends('layouts.app')

@section('content')
@section('title', 'Company')

<div class="page-wrapper">
<div class="content container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <h5 class="text-uppercase mb-0 mt-0 page-title">Store</h5>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <ul class="breadcrumb float-right p-0 mb-0">
                    <li class="breadcrumb-item"><a href="dashboard.php"><i class="fas fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="add-card.php">Store</a></li>
                    <li class="breadcrumb-item"><span> Add Store</span></li>
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
                                        Add Company Name
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @if(isset($editCompanies))
                        <form action="{{ route('add.company.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" class="form-control" value="{{ $editCompanies->company_id }}" name="company_id">

                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name" value="{{ $editCompanies->company_name }}">
                            <div id="company_name_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="company_status">
                                <option value="1" {{ $editCompanies->company_status == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $editCompanies->company_status == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="company_image" accept="image/*" class="form-control" id="company_image" onchange="previewImage(this);">
                                        <br>
                                        <p><strong>Image should be less than 1 MB and only logo formats (PNG, JPG, JPEG) are allowed.</strong></p>
                                        <div id="company_image_error" class="error" style="color: red; font-weight: bold;"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image Preview</label><br>
                                        <img id="imagePreview" src="{{ asset('storage/' . $editCompanies->company_image) }}" alt="Image Preview" width="80" height="80">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center custom-mt-form-group">
                            <button class="btn btn-primary mr-2" type="submit" name="submit">Update Company</button>
                            <button class="btn btn-secondary" type="reset">Reset</button>
                        </div>
                        </form>
                        @else
                        <!-- Add Company Form -->
                        <form action="{{ route('add.company.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" name="company_name" id="company_name">
                            <div id="company_name_error" class="error" style="color: red; font-weight: bold;"></div>
                        </div>

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" name="company_image" accept="image/*" class="form-control" id="company_image" onchange="previewImage(this);">
                                        <br>
                                        <p><strong>Image should be less than 1 MB and only logo formats (PNG, JPG, JPEG) are allowed.</strong></p>
                                        <div id="company_image_error" class="error" style="color: red; font-weight: bold;"></div>
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
                        <div class="form-group text-center custom-mt-form-group">
                            <button class="btn btn-primary mr-2" type="submit" name="submit">Add Company</button>
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
                                Company Lists
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Company Id</th>
                                    <th>Company Name</th>
                                    <th>Company Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($companies as $company)
                                    <tr>
                                        <td>{{ $company->company_id }}</td>
                                        <td>{{ $company->company_name }}</td>
                                        <td>
                                            @if($company->company_image)
                                                <img src="{{ asset('public/storage/' . $company->company_image) }}" alt="Company Image" width="50" height="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td style="font-weight: bold; color: {{ $company->company_status == 1 ? 'green' : 'red' }};">
                                            {{ $company->company_status == 1 ? 'Active' : 'Inactive' }}
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('edit.company', $company->company_id) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a>
                                            <!--<a href="{{ route('delete.company', $company->company_id) }}" class="btn btn-danger btn-sm mb-1">-->
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

