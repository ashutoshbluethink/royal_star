@extends('layouts.app')

@section('title', 'Lead')

@section('content')

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #304ffe 0%, #00b8d9 90%);
    }

    .card-surface {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 3px 16px rgba(40,60,120,0.12);
        transition: box-shadow 0.2s;
    }
    .card-surface:hover {
        box-shadow: 0 6px 24px rgba(48,79,254,0.20);
    }

    .chat-sidebar {
        border-left: 4px solid #ffd600;
    }

    .btn-primary, .btn-info {
        background: linear-gradient(90deg, #304ffe 60%, #00b8d9 100%);
        color: #fff;
        border: none;
        box-shadow: 0 2px 8px rgba(76,175,80,0.09);
        transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
    }
    .btn-primary:hover, .btn-info:hover {
        background: linear-gradient(90deg, #00b8d9 40%, #304ffe 100%);
        box-shadow: 0 5px 14px rgba(48,79,254,0.20);
        transform: translateY(-2px) scale(1.03);
    }

    .btn-warning:hover, .btn-danger:hover {
        filter: brightness(1.08);
        box-shadow: 0 2px 8px rgba(229,57,53,0.13);
    }

    .chat-bubble {
        background: #f8f9fa;
        color: #222;
        border-radius: 18px;
        margin-bottom: 8px;
        transition: background 0.17s;
        box-shadow: 0 1px 7px rgba(60,80,200,0.03);
    }
    .chat.chat-left .chat-bubble {
        background: linear-gradient(135deg, #304ffe1A, #ffffff 80%);
    }
    .chat.chat-right .chat-bubble {
        background: linear-gradient(135deg, #00b8d91A, #fff 80%);
    }
    .chat-bubble:hover {
        background: #ffd6002A;
    }

    div#profile_tab {
        padding: 15px;
    }

    .user-img .rounded-circle {
        background: #fff;
        color: #304ffe;
        border: 2px solid #304ffe88;
        transition: border-color 0.2s;
    }
    .user-img:hover .rounded-circle {
        border-color: #ffd600;
    }

    .p-4.mb-4.rounded.shadow {
        background: linear-gradient(135deg, #304ffe 60%, #00b8d9 120%);
        color: #fff;
        border-radius: 16px !important;
    }
    .p-4.mb-4.rounded.shadow h5 {
        color: #ffd600;
        letter-spacing: .05em;
        margin-bottom: 6px;
        font-size: 1.10rem;
    }

    .form-control {
        border-radius: 9px;
        border: 1.5px solid #eee;
        background: #f8f9fa;
        transition: box-shadow 0.17s, border-color 0.18s;
    }
    .form-control:focus {
        box-shadow: 0 2px 5px #304ffe44;
        border-color: #304ffe;
        background: #fff;
    }

    .modal-content {
        border-radius: 18px;
        border-top: 8px solid #00b8d9;
    }

    .chat-time, .typing-text, .user-info small {
        color: #00b8d9 !important;
        font-size: .95em !important;
    }
</style>

<div class="page-wrapper">
    <div class="chat-main-row">
        <div class="chat-main-wrapper">

            {{-- MAIN CHAT WINDOW --}}
            <div class="col-lg-9 message-view task-view">
                <div class="chat-window">
                    {{-- Header --}}
                    <div class="fixed-header bg-gradient-primary text-white p-3 shadow-sm rounded-top">
                        <div class="navbar d-flex justify-content-between align-items-center">
                            
                            {{-- LEFT: Company Info --}}
                            <div class="user-details d-flex align-items-center">
                                <div class="user-img mr-3">
                                    <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center"
                                        style="width: 50px; height: 50px; font-size: 20px; font-weight: bold;">
                                        {{ strtoupper(substr($leadData->company->company_name, 0, 1)) }}
                                    </div>
                                </div>
                                <div class="user-info">
                                    <a href="#" class="text-white text-decoration-none" title="{{ $leadData->company->company_name }}">
                                        <span class="h4 font-weight-bold text-uppercase d-block">
                                            {{ $leadData->company->company_name }}
                                        </span>
                                    </a>
                                    <small class="text-light">
                                        <i class="far fa-clock mr-1"></i>
                                        Last comment {{ \Carbon\Carbon::parse($leadData->updated_at)->diffForHumans() }}
                                    </small>
                                </div>
                            </div>

                            {{-- RIGHT: Offer Letter & Dates --}}
                            <div class="d-flex align-items-center">

                                {{-- Joining / Closing Dates --}}
                                <div class="text-right mr-3 text-white">
                                @if(!empty($leadData->joining_date))
                                        <div>
                                            <i class="fas fa-play-circle text-success mr-1"></i>
                                            <span class="text-white">Joining Date:</span>
                                            <strong class="text-white">{{ $leadData->joining_date }}</strong>
                                        </div>
                                    @endif

                                    @if($leadData->is_project_closed && $leadData->close_date)
                                        <div>
                                            <i class="fas fa-flag-checkered text-danger mr-1"></i>
                                            <span class="text-white">Close Date:</span>
                                            <strong class="text-white">{{ \Carbon\Carbon::parse($leadData->close_date)->format('d-m-Y') }}</strong>
                                        </div>
                                    @endif
                                </div>

                                {{-- Offer Letter Button --}}
                                @if($leadData->offer_letter_path)
                                    @php $ext = strtolower(pathinfo($leadData->offer_letter_path, PATHINFO_EXTENSION)); @endphp
                                    <a href="{{ asset($leadData->offer_letter_path) }}" target="_blank" 
                                    class="btn btn-sm btn-light d-flex align-items-center">
                                        @if($ext === 'pdf')
                                            <i class="far fa-file-pdf text-danger mr-2"></i>
                                        @elseif(in_array($ext, ['doc', 'docx']))
                                            <i class="far fa-file-word text-primary mr-2"></i>
                                        @else
                                            <i class="far fa-file-alt text-secondary mr-2"></i>
                                        @endif
                                        Offer Letter
                                    </a>
                                @endif

                            </div>
                        </div>
                    </div>
                    {{-- Toastr Notifications --}}
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
                        });
                    </script>

                    {{-- Chat History --}}
                    <div class="chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="chats">
                                        @foreach($leadHistories as $history)
                                            <div class="chat {{ $history->leadCreate_user_role == 'Sales Team' ? 'chat-left' : 'chat-right' }}">
                                                <div class="chat-avatar">
                                                    <a href="profile.html" class="avatar">
                                                        <img alt="User Image" src="{{ asset('storage/' . $history->user->user_image) }}"
                                                            class="img-fluid rounded-circle">
                                                    </a>
                                                    <h5>
                                                        <small>{{ $history->leadCreate_user_name }}</small>
                                                        <a href="profile.html">
                                                            <small>{{ $history->leadCreate_user_role }}</small>
                                                        </a>
                                                    </h5>
                                                    <small>{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}</small>
                                                </div>
                                                <div class="chat-body">
                                                    <div class="chat-bubble">
                                                        <div class="chat-content">
                                                            <p>{{ $history->comment }}</p>
                                                            <span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
                                                            <small>Lead Status:</small>
                                                            <i class="typing-text">{{ $history->leadStatus->leadstatusname }}</i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                        <!-- Preview Area -->
                                        <div id="filePreview" class="mt-2" style="display:none;">
                                            <div class="chat chat-right">
                                                <div class="chat-bubble p-2">
                                                    <div class="chat-content d-flex align-items-center">
                                                        <i id="fileIcon" class="far fa-file-alt fa-2x mr-2"></i>
                                                        <span id="fileName" class="font-weight-bold"></span>
                                                        <button type="button" id="removeFile" class="btn btn-sm btn-outline-danger ml-2">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Comment Form --}}
                <form action="{{ route('comments.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="lead_id" value="{{ $history->lead_id }}">
                    <div class="chat-footer">
                        <div class="message-bar">
                            <div class="message-inner">
                                <div class="message-area">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="lead_comment" placeholder="Type a comment ..." required>

@if($leadData->interview_status == 5)
    <div class="input-group-append">
        <label class="btn btn-secondary mb-0" for="offerLetter" title="Attach Offer Letter">
            <i class="fas fa-paperclip"></i>
        </label>
        <input type="file" id="offerLetter" name="offer_letter" accept=".pdf,.doc,.docx" style="display: none;">
    </div>
@endif
<script>

document.addEventListener('DOMContentLoaded', function () {
    const fileInput = document.getElementById('offerLetter');
    const previewArea = document.getElementById('filePreview');
    const fileNameEl = document.getElementById('fileName');
    const fileIcon = document.getElementById('fileIcon');
    const removeBtn = document.getElementById('removeFile');

    function scrollChatToBottom() {
        const chatContents = document.querySelector('.chat-contents');
        if (chatContents) {
            chatContents.scrollTop = chatContents.scrollHeight;
        }
    }

    fileInput.addEventListener('change', function () {
        if (this.files && this.files[0]) {
            const file = this.files[0];
            const ext = file.name.split('.').pop().toLowerCase();

            // Set icon based on extension
            if (ext === 'pdf') {
                fileIcon.className = 'far fa-file-pdf fa-2x text-danger mr-2';
            } else if (['doc', 'docx'].includes(ext)) {
                fileIcon.className = 'far fa-file-word fa-2x text-primary mr-2';
            } else {
                fileIcon.className = 'far fa-file-alt fa-2x text-secondary mr-2';
            }

            fileNameEl.textContent = file.name;
            previewArea.style.display = 'block';

            // Auto scroll to bottom after small delay
            setTimeout(scrollChatToBottom, 100);
        }
    });

    removeBtn.addEventListener('click', function () {
        fileInput.value = '';
        previewArea.style.display = 'none';
    });
});


</script>

                                        <span class="input-group-append">
                                            <button class="btn btn-info" type="submit">
                                                <i class="fas fa-paper-plane"></i>
                                            </button>
                                        </span>
                                    </div>

                                    @if($leadData->interview_status != 5)
                                        <div class="form-group d-flex align-items-center mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="followupToggle" name="is_followup" value="1"
                                                    {{ $leadData->interview_status == 20 ? 'checked' : '' }}>
                                                <label class="custom-control-label text-primary font-weight-bold" for="followupToggle">
                                                    Mark this Lead as a <span class="badge badge-warning">Follow-up</span>
                                                </label>
                                            </div>
                                        </div>
                                    @endif

                                    @if($leadData->interview_status == 5)
                                        <div class="form-group d-flex align-items-center mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="projectClosedToggle" name="is_project_closed" value="1"
                                                    {{ $leadData->is_project_closed ? 'checked' : '' }}>
                                                <label class="custom-control-label text-danger font-weight-bold" for="projectClosedToggle">
                                                    Mark Running Project as <span class="badge badge-danger">Closed</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group mt-2" id="closeDateGroup" style="display: {{ $leadData->is_project_closed ? 'block' : 'none' }};">
                                            <label for="closeDate" class="text-dark font-weight-bold">Select Close Date:</label>
                                            <input type="date" class="form-control" id="closeDate" name="close_date" value="{{ $leadData->close_date }}">
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const toggle = document.getElementById('projectClosedToggle');
                            const closeDateGroup = document.getElementById('closeDateGroup');
                            if (toggle) {
                                toggle.addEventListener('change', function () {
                                    closeDateGroup.style.display = this.checked ? 'block' : 'none';
                                });
                            }
                        });
                    </script>

                </div>
            </div>

            {{-- CHAT PROFILE SIDEBAR --}}
            <div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="chat_sidebar">
                <div class="chat-window video-window">

                    <div class="fixed-header bg-gradient-primary text-white shadow-sm rounded-top">
                        <div class="d-flex justify-content-between align-items-center px-3 pt-2">
                            <div class="d-flex align-items-center">
                                <!-- <a href="{{ url()->previous() }}" class="text-white mr-3" title="Back">
                                    <i class="fas fa-arrow-left fa-lg"></i>
                                </a> -->
                                <ul class="nav nav-tabs nav-tabs-bottom mb-0">
                                    <li class="nav-item">
                                        <a class="nav-link active text-white font-weight-bold" href="#profile_tab" data-toggle="tab">
                                            <i class="fas fa-info-circle mr-1"></i> Lead Details
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            @if(auth()->user()->role != 3 && auth()->user()->role != 8)
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('leads.edit', $leadData->id) }}" class="btn btn-warning text-white" title="Edit">
                                        <i class="far fa-edit"></i>
                                    </a>
                                    <a href="{{ route('view.lead') }}" class="btn btn-danger text-white" title="View">
                                        <i class="far fa-eye"></i>
                                    </a>
                                    <a href="{{ route('add.lead') }}" class="btn btn-primary text-white" title="Add New Lead">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('updateLeadName') }}" method="POST">
                        @csrf
                        <input type="hidden" name="lead_id" value="{{ $history->lead_id }}">
                        <div class="chat-footer">
                            <div class="message-bar">
                                <div class="message-inner">
                                    <div class="message-area">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="end_client_or_company_name" placeholder="Enter End Client or Company Name" required>
                                            <span class="input-group-append">
                                                <button class="btn btn-info" type="submit">
                                                    <i class="fas fa-save"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="tab-pane show active" id="profile_tab">
                        <h5 class="mb-3">Lead Details</h5>
                        <hr>
                        <h6 class="font-weight-bold">End Company / Client Details</h6>
                        <ul>
                            @if($LeadEndClientOrCompanyNames->isNotEmpty())
                                <li>
                                    <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#previousDetailsModal">
                                        <i class="fas fa-history"></i> View Previous
                                    </button>
                                </li>
                            @else
                                <li>No details available</li>
                            @endif
                        </ul>
                        <hr>
                        <h6 class="font-weight-bold">Company Details</h6>
                        <ul>
                            <li><strong>Email:</strong> {{ $leadData->company_email }}</li>
                            <li><strong>Phone:</strong> {{ $leadData->company_phone }}</li>
                            <li><strong>Rate:</strong> {{ $leadData->company_rate }}</li>
                        </ul>
                        <hr>
                        <h6 class="font-weight-bold">Other Info</h6>
                        <ul>
                            <li><strong>Tech:</strong> {{ $leadData->vendor->technology->technology_name ?? '-' }}</li>
                            <li><strong>Vendor:</strong> {{ $leadData->vendor->name ?? '-' }}</li>
                            <li><strong>Interviewer:</strong> {{ $leadData->interviewer->firstname ?? '' }} {{ $leadData->interviewer->lastname ?? '' }}</li>
                            <li><strong>By:</strong> {{ $leadData->leadSupportedBy->firstname ?? '-' }}</li>
                        </ul>
                        <hr>
                        <h6 class="font-weight-bold">Lead Insights</h6>
                        <ul>
                            @if($leadData->meeting_link)
                                <li>
                                    <strong>Meeting Link:</strong> 
                                    <button class="btn btn-sm btn-outline-primary" type="button" onclick="copyMeetingLink()" title="Copy Link">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                    <br>
                                    <small>{{ $leadData->meeting_link }}</small>
                                </li>
                            @endif
                            <li><strong>Source:</strong> {{ $leadData->source ?? '-' }}</li>
                            <li><strong>Status:</strong> {{ $history->leadStatus->leadstatusname ?? '-' }}</li>
                            @if($leadData->region)
                                <li><strong>Region:</strong> {{ $leadData->region }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Previous End Client/Company Names Modal --}}
<div class="modal fade" id="previousDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Previous End Company Details</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($LeadEndClientOrCompanyNames as $LeadEndClientOrCompanyName)
                        <li>{{ $LeadEndClientOrCompanyName->end_client_or_company_name }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyMeetingLink() {
        const tempInput = document.createElement("input");
        tempInput.value = "{{ $leadData->meeting_link }}";
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand("copy");
        document.body.removeChild(tempInput);
        alert("Meeting link copied to clipboard");
    }
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

@endsection
