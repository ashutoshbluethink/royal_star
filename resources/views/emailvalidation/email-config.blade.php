@extends('layouts.app')

@section('title', 'Manage Email Filters')

@section('content')


<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <h5 class="text-uppercase mb-0 mt-0 page-title">Email Filter Management</h5>
            <ul class="breadcrumb float-right p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a></li>
                <li class="breadcrumb-item"><span>Email Filters</span></li>
            </ul>
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

        <div class="row justify-content-center">
            <div class="col-lg-6">
                <!-- Dynamic Filter Management Form -->

                <div class="card">
                    <div class="card-body">
                        <h6>Manage Email Filters</h6>
                        <!-- Form to add new filter -->
                        <form method="POST" action="{{ route('email_filters.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="filter_value">Add New Filter</label>
                                <input type="text" name="filter_value" class="form-control" id="filter_value" placeholder="Enter filter value" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Add Filter</button>
                        </form>
                     </div>
                </div>
         
            <div class="card">
                <div class="card-body">
                        <!-- List of existing filters -->
                        <h6 class="mt-4">Current Filters:</h6>
                        <?php $i=1; ?>
                        <ul class="list-group">
                            @foreach($filters as $filter)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <h5>{{ $i }}</h5>{{ $filter->filter_value }}
                                    <form method="POST" action="{{ route('email_filters.destroy', $filter->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </li>
                                <?php $i++; ?>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
