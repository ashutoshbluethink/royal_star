@extends('layouts.app')
@section('title', 'Technology Targets')
@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="text-uppercase mb-0 mt-0 page-title">Technology Targets</h5>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb float-right p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('performance.targets.index') }}">Technology</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span>{{ isset($technology_target) ? 'Edit Target' : 'Add Target' }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Toastr -->
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script>
            $(document).ready(function () {
                @if(session('error'))
                    toastr.error("{{ session('error') }}", "", { timeOut: 5000, progressBar: true, positionClass: "toast-top-center" });
                @endif
                @if(session('success'))
                    toastr.success("{{ session('success') }}", "", { timeOut: 5000, progressBar: true, positionClass: "toast-top-center" });
                @endif

                $('.select2').select2({ width: '100%' });
            });
        </script>

        <div class="row">
            <!-- Form -->
            <div class="col-lg-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-auto"><div class="page-title">{{ isset($technology_target) ? 'Edit Target' : 'Create Target' }}</div></div>
                            </div>
                        </div>

                        <form action="{{ isset($technology_target) ? route('performance.targets.update', $technology_target->id) : route('performance.targets.store') }}" method="POST">
                            @csrf
                            @if(isset($technology_target)) @method('PUT') @endif

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        @php $selected = old('teamname', $technology_target->teamname ?? ''); @endphp
                                        <select name="teamname" class="form-control select2" required>
                                            <option value="">--Select--</option>
                                            @foreach($technologies as $tech)
                                                <option value="{{ $tech->technology_id . '|Day' }}" {{ $selected == $tech->technology_id . '|Day' ? 'selected' : '' }}>☀️ {{ $tech->technology_name }} Team (Day)</option>
                                                <option value="{{ $tech->technology_id . '|Night' }}" {{ $selected == $tech->technology_id . '|Night' ? 'selected' : '' }}>🌙 {{ $tech->technology_name }} Team (Night)</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Team Name <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input type="number" name="year" class="form-control" value="{{ old('year', $technology_target->year ?? date('Y')) }}" required>
                                        <label class="focus-label">Year <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        @php
                                            $quarters = [1 => 'Q1 (Jan-Mar)', 2 => 'Q2 (Apr-Jun)', 3 => 'Q3 (Jul-Sep)', 4 => 'Q4 (Oct-Dec)'];
                                            $currentQuarter = ceil(now()->month / 3);
                                            $selectedQuarter = old('quarter', $technology_target->quarter ?? $currentQuarter);
                                        @endphp
                                        <select name="quarter" class="form-control select2" required>
                                            <option value="">--Select--</option>
                                            @foreach($quarters as $key => $label)
                                                <option value="{{ $key }}" {{ $selectedQuarter == $key ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                        <label class="focus-label">Quarter <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input type="number" name="target" class="form-control" value="{{ old('target', $technology_target->target ?? '') }}" required>
                                        <label class="focus-label">Target <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        <input type="number" name="achieved" class="form-control" value="{{ old('achieved', $technology_target->achieved ?? 0) }}" required>
                                        <label class="focus-label">Achieved <span class="text-danger">*</span></label>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group form-focus">
                                        @php $selectedStatus = old('status', $technology_target->status ?? 'Enabled'); @endphp
                                        <select name="status" class="form-control select2" required>
                                            <option value="Enabled" {{ $selectedStatus == 'Enabled' ? 'selected' : '' }}>Enabled</option>
                                            <option value="Disabled" {{ $selectedStatus == 'Disabled' ? 'selected' : '' }}>Disabled</option>
                                        </select>
                                        <label class="focus-label">Status <span class="text-danger">*</span></label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success">{{ isset($technology_target) ? 'Update' : 'Add' }}</button>
                            @if(isset($technology_target))
                                <a href="{{ route('performance.targets.index') }}" class="btn btn-secondary">Cancel</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>

            <!-- Target List -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><div class="page-title">Technology Target List</div></div>
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Technology</th>
                                    <th>Shift</th>
                                    <th>Year</th>
                                    <th>Quarter</th>
                                    <th>Target</th>
                                    <!-- <th>Achieved</th> -->
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($targets as $target)
                                    <tr>
                                        <td>{{ $target->technology->technology_name ?? '-' }}</td>
                                        <td>{{ $target->shift === 'Day' ? '☀️ Day' : '🌙 Night' }}</td>
                                        <td>{{ $target->year }}</td>
                                        <td>Q{{ $target->quarter }}</td>
                                        <td>{{ $target->target }}</td>
                                        <!-- <td>{{ $target->achieved }}</td> -->
                                        <td>
                                            @if($target->status == 'Enabled')
                                                <span class="badge badge-success">Enabled</span>
                                            @else
                                                <span class="badge badge-danger">Disabled</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('performance.targets.edit', $target->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('performance.targets.destroy', $target->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this target?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('performance.targets.toggleStatus', $target->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm {{ $target->status === 'Enabled' ? 'btn-outline-danger' : 'btn-outline-success' }}">
                                                    {{ $target->status === 'Enabled' ? 'Disable' : 'Enable' }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="8" class="text-center">No records found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable({ "responsive": true, "lengthChange": false, "autoWidth": false });
    });
</script>

@endsection
