@extends('layouts.app')
@section('title', 'Quater Wise Lead View in Performance Dashboard')
@section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="page-title">
                                Viewing Quater Wise Lead Lists
                                </div>
                            </div>
                            <div class="col text-end">
                                <div>
                                    <div class="col text-end">
                                        <div>
                                            @if (!empty($technology))
                                                Technology: <strong>{{ $technology->technology_name }}</strong>
                                            @elseif (!empty($memberuser))
                                                Team Member: <strong>{{ $memberuser->firstname }} {{ $memberuser->lastname }}</strong>
                                            @else
                                                <strong>N/A</strong>
                                            @endif
                                            &nbsp; | &nbsp; Quarter: <strong>{{ $quarter }}</strong>
                                            &nbsp; | &nbsp; Year: <strong>{{ $year }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1qatartable" class="table custom-table">
                                <thead class="thead-dark">
                                    <tr>    
                                        <th>Company</th>
                                        <th>Vendor</th>
                                        <th>Interviewee</th>
                                        <th>Lead Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Created BY</th>
                                        <th>Updated At</th>
                                        <th>Region</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $lead)
                                        <tr>
                                            <td title="{{ $lead->company->company_name }}">
                                                <i class="fa fa-building"></i> 
                                                <span style="color: blue; font-weight: bold;">
                                                    {{ mb_strimwidth($lead->company->company_name, 0, 10, '...') }}
                                                </span><br>
                                                    @if(!empty($lead->leadSupportedBy))
                                                        <span class="text-muted small">
                                                            <i class="fa fa-user-shield"></i>By: 
                                                            <strong>{{ $lead->leadSupportedBy->firstname }} {{ $lead->leadSupportedBy->lastname }}</strong>
                                                        </span>
                                                    @endif
                                            </td>
                                            <td>
                                                <i class="fa fa-user"></i> {{ $lead->vendor->name }}  <h6 style="color: #666;">{{ $lead->vendor->technology->technology_name }}</a></h6>
                                            </td>
                                            
                                            <td>
                                                <i class="fa fa-id-card"></i> {{ $lead->interviewer->firstname }}  <h6 style="color: #666;"><i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') }}</a></h6>
                                            </td>

                                            <td title="{{ $lead->lead_comment }}">
                                                <textarea name="lead_comment" class="form-control" rows="2" readonly>{{ $lead->lead_comment }}</textarea>
                                            </td>
                                            <td>
                                                @php
                                                    $statusId = $lead->leadStatus->leadstatusid;
                                                    $badgeClass = '';
                                                    $iconClass = '';
                                                    switch ($statusId) {
                                                        case 1: $badgeClass = 'badge-primary'; $iconClass = 'fas fa-search'; break;
                                                        case 2: $badgeClass = 'badge-secondary'; $iconClass = 'fas fa-phone'; break;
                                                        case 3: $badgeClass = 'badge-info'; $iconClass = 'fas fa-cog'; break;
                                                        case 4: $badgeClass = 'badge-success'; $iconClass = 'fas fa-file-alt'; break;
                                                        case 5: $badgeClass = 'badge-success'; $iconClass = 'fas fa-file-signature'; break;
                                                        case 6: $badgeClass = 'badge-danger'; $iconClass = 'fas fa-file-invoice'; break;
                                                        case 13: $badgeClass = 'badge-danger'; $iconClass = 'fas fa-times-circle'; break;
                                                        case 14: $badgeClass = 'badge-dark'; $iconClass = 'fas fa-users'; break;
                                                        default: $badgeClass = 'badge-danger'; $iconClass = 'fas fa-question-circle'; break;
                                                    }
                                                @endphp
                                                <a href="{{ route('leads.show', $lead->id) }}" class="badge-link text-decoration-none">
                                                    <span class="badge badge-custom {{ $badgeClass }} mb-1">
                                                        <i class="{{ $iconClass }}"></i>
                                                        {{ $lead->leadStatus->leadstatusname }}
                                                    </span>
                                                </a>

                                                @if(!empty($lead->joining_date))
                                                    <div class="small text-muted">
                                                        <i class="fas fa-calendar-check text-success"></i>
                                                        <strong>Joining Date: {{ $lead->joining_date }}</strong>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <!-- <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                                    <i class="far fa-edit"></i>
                                                </a> -->
                                                <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                            </td>
                                            <td>
                                                {{ $lead->createdUser->firstname }}
                                                <h2><a href="{{ route('leads.show', $lead->id) }}">{{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}</a></h2>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($lead->updated_at)->format('d M Y') }}
                                            </td>
                                            <td>
                                                {{ $lead->region }}
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
</div>



<script>
    $(function () {
        $("#example1qatartable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": true,
            "bStateSave":true,
            buttons: [
                {
                    extend: 'excel',
                    text: 'Export Excel'
                }
            ],
            "order": [[1, "desc"]] // Order by the first column (ID) in descending order
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection
