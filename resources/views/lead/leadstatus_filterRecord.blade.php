@extends('layouts.app')
@section('content')
@section('title', 'Status Base Leads')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="mb-0 text-primary d-flex align-items-center flex-wrap">
                                    <i class="fas fa-stream mr-2"></i>

                                    <span class="badge badge-pill badge-info ml-2">
                                        {{ $LeadstatusNameById->leadstatusname }} Leads 

                                        @isset($user_detail)
                                            of {{ $user_detail->firstname }} {{ $user_detail->lastname }}
                                        @endisset

                                        @if(request('from_date') && request('to_date'))
                                            <br>
                                            <small>
                                                (Updated Between: 
                                                {{ \Carbon\Carbon::createFromFormat('d-m-Y', request('from_date'))->format('d M Y') }} 
                                                to 
                                                {{ \Carbon\Carbon::createFromFormat('d-m-Y', request('to_date'))->format('d M Y') }})
                                            </small>
                                        @endif
                                    </span>

                                    <span class="text-dark font-weight-normal float-right">
                                        Total Leads: <strong>{{ $leads->total() }}</strong>
                                    </span>

                                </h4>

                            </div>
                        </div>
                    </div>
                    <div class="card-body"> 
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Id</th>
                                        <th>Company</th>
                                        <th style="display: none;">email</th>
                                        <th>Vendor</th>
                                        <th>Interviewee</th>
                                        <th>Lead Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Created BY</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($leads as $lead)
                                    <tr>
                                        <td>{{ $lead->id }}</td>
                                        <td>
                                            <span style="color: blue; font-weight: bold; word-break: break-word; white-space: normal; display: inline-block; max-width: 100px;">
                                                {{ $lead->company->company_name }}
                                            </span><br>
                                            @if(!empty($lead->leadSupportedBy))
                                                <span class="text-muted small" style="color: #666;">
                                                    <i class="fa fa-user-shield"></i>By: 
                                                    <strong>{{ $lead->leadSupportedBy->firstname }} {{ $lead->leadSupportedBy->lastname }}</strong>
                                                </span>
                                            @endif
                                        </td>

                                        <td style="display: none;">
                                            {{ $lead->company_email }}
                                        </td>
                                        <td>
                                            <i class="fa fa-user"></i> {{ $lead->vendor->name }}  
                                            <h2>
                                                <a href="{{ route('leads.show', $lead->id) }}">
                                                {{ $lead->vendor->technology->technology_name }}
                                                </a>
                                            </h2>
                                        </td>
                                        
                                        <td>
                                            <i class="fa fa-id-card"></i> {{ $lead->interviewer->firstname }}  <h2><a href="{{ route('leads.show', $lead->id) }}" title="Interview Date"> <i class="fas fa-calendar-alt"></i>{{ \Carbon\Carbon::parse($lead->interview_date)->format('d-m-Y') }}</a></h2>
                                        </td>

                                        <td title="{{ $lead->lead_comment }}">
                                            <textarea name="lead_comment" class="form-control" rows="2" readonly data-toggle="popover"  data-content="{{ $lead->lead_comment }}">{{ $lead->lead_comment }}</textarea>
                                        </td>
                                        
                                        <td>
                                            <span class="badge badge-custom">
                                                <i></i> {{ $lead->leadStatus->leadstatusname }}
                                            </span>
                                                 @if(!empty($lead->joining_date))
                                                    <div class="small text-muted">
                                                        <i class="fas fa-calendar-check text-success"></i>
                                                        <strong>Joining Date: {{ $lead->joining_date }}</strong>
                                                    </div>
                                                @endif
                                        </td>

                                        <td class="text-right">
                                            @if(auth()->user()->role != 3 && auth()->user()->role != 8)
                                            <a href="{{ route('leads.edit', $lead->id) }}" class="btn btn-primary btn-sm mb-1">
                                                <i class="far fa-edit"></i>
                                            </a>
                                                
                                            @endif
                                            <a href="{{ route('leads.show', $lead->id) }}" class="btn btn-warning btn-sm mb-1">
                                                <i class="far fa-eye"></i>
                                            </a>
                                        </td>
                                        <td @if(request('created_by')) class="bg-warning" title="Filtered by Sales" @endif>
                                            {{ $lead->createdUser->firstname }}
                                        </td>


                                        <td>
                                            {{ \Carbon\Carbon::parse($lead->created_at)->format('d M Y') }}
                                        </td>

                                        <td>
                                            {{ \Carbon\Carbon::parse($lead->updated_at)->format('d M Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="disable-next-prev">
                        {{ $leads->appends(request()->query())->links() }}
                    </div>

                </div>
            </div>
        </div>
       
        @include('section/notification') 
    </div>
</div>

@endsection
