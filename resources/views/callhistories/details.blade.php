@extends('layouts.app')

@section('content')
@section('title', 'Lead')

<div class="page-wrapper">
	<div class="chat-main-row">
		<div class="chat-main-wrapper">
			<div class="col-lg-9 message-view task-view">
				<div class="chat-window">
					<div class="fixed-header">
						<div class="navbar">
							<div class="user-details mr-auto">
								<div class="float-left user-img m-r-10">
									<a href="#" title="Mike Litorus"><img src="assets/img/user.jpg"
											alt="" class="w-40 rounded-circle"><span
											class="status online"></span></a>
								</div>
								<div class="user-info float-left">
									<a href="#" title="Mike Litorus"><span class="font-bold">{{ $callHistory->mobile_no }}</span> </a>
									<!-- <span class="Last-seen">Last seen today at 7:50 AM</span> -->
								</div>
							</div>
							
							<ul class="nav custom-menu">
								<li class="nav-item">
									<a href="#chat_sidebar"
										class="nav-link task-chat profile-rightbar float-right"><i
											class="fas fa-user" aria-hidden="true"></i></a>
								</li>
							</ul>
						</div>
					</div>
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
					
					<div class="chat-contents">
						<div class="chat-content-wrap">
							<div class="chat-wrap-inner">
								<div class="chat-box">
									<div class="chats">
									@foreach($callHistoryDetails as $history)
									<p> </p>
									@php
										$currentUser = Auth::user();
										$userName = $currentUser->firstname . ' ' . $currentUser->lastname;
									@endphp

									@if ($history->created_by == $userName)
										<div class="chat chat-right">
											<div class="chat-avatar">
											<a href="profile.html" class="avatar">
												<div class="initials-avatar">
													@php
														$names = explode(' ', $history->created_by);
														$initials = '';
														foreach ($names as $name) {
															$initials .= strtoupper(substr($name, 0, 1));
														}
													@endphp
													<span>{{ $initials }}</span>
												</div>
											</a>
											<h5>
												<small>{{ $history->created_by }}</small>
												<a href="profile.html">
													<small>....</small>
												</a>
											</h5>
											</div>
											<div class="chat-body">
												<div class="chat-bubble">
													<div class="chat-content">
														<p>{{ $history->comment }}</p>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>

														
													</div>
													<span></span>
												</div>
											</div>
										</div>
									@else
										<div class="chat chat-left">
											<div class="chat-avatar">
											<a href="profile.html" class="avatar">
												<div class="initials-avatar">
													@php
														$names = explode(' ', $history->created_by);
														$initials = '';
														foreach ($names as $name) {
															$initials .= strtoupper(substr($name, 0, 1));
														}
													@endphp
													<span>{{ $initials }}</span>
												</div>
											</a>
												<h5>
													<small>{{ $history->created_by }}</small>
													<a href="profile.html">
														<small>....</small>
													</a>
												</h5>
												<small> 
													{{ \Carbon\Carbon::parse($history->created_at)->format('d M Y') }}
												</small>
											</div>
											<div class="chat-body">
												<div class="chat-bubble">
													<div class="chat-content">
														<p>{{ $history->comment }}</p>
														<span class="chat-time">{{ \Carbon\Carbon::parse($history->created_at)->format('h:i A') }}</span>
													</div>
													<span></span>
												</div>
											</div>
										</div>
										@endif
									@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
					<style>
						textarea {
							resize: vertical;
						}
					</style>

					<form action="{{ route('save.comment') }}" method="POST">
						@csrf
						<input type="hidden" name="callHistory_id" value="{{ $callHistory->id }}">
						<div class="chat-footer">
							<div class="message-bar">
								<div class="message-inner">
									<div class="message-area">
										<div class="input-group">
											<textarea class="form-control" name="comment" placeholder="Type a comment ..." required></textarea>
											<span class="input-group-append">
												<button class="btn btn-info" type="submit"><i class="fas fa-paper-plane"></i></button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="chat_sidebar">
				<div class="chat-window video-window">
					<div class="fixed-header">
						<ul class="nav nav-tabs nav-tabs-bottom">
							
							<li class="nav-item"><a class="nav-link active" href="#profile_tab"
									data-toggle="tab">Details</a></li>
						</ul>
					</div>
					<div class="tab-content chat-contents">
						<div class="content-full tab-pane show active" id="profile_tab">
							<div class="display-table">
								<div class="table-row">
									<div class="table-body">
										<div class="table-content">
											<div class="chat-profile-img">
												<div class="invoice-details">
												
												</div>
												<br>
											
											</div>
											<div class="chat-profile-info">
												<ul class="user-det-list">
													<h3 class="text-uppercase">Call History Details</h3>
													<li><strong>Mobile Number: </strong>{{ $callHistory->mobile_no }}</li>
													<li>
														<strong class="float-left text">Technology:</strong>
														<span>
															@php
															$technology = \App\Models\Company\Technology::find($callHistory->technology_id);
															if($technology) {
																echo '<span>' . $technology->technology_name . '</span>';
															} else {
																echo '<span>Unknown</span>';
															}
															@endphp
														</span>
													</li>

													
													<li><strong>Created By: </strong>{{ $callHistory->created_by }}</li>
													<li><strong>Company Name: </strong>{{ $callHistory->company_name }}</li>
													<li><strong>HR Name: </strong>{{ $callHistory->hr_name }}</li>
													<li><strong>Created At: </strong>{{ $callHistory->created_at }}</li>
													<!-- <li><strong>Updated At: </strong>{{ $callHistory->updated_at }}</li> -->
												</ul>
											</div>

										
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    function copyMeetingLink() {
        /* Get the text field */
        var meetingLink = document.getElementById("meetingLink");

        /* Select the text field */
        meetingLink.select();
        meetingLink.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        document.execCommand("copy");

        /* Alert the copied text */
        alert("Meeting link copied: " + meetingLink.value);
    }
</script>

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

<script>
	$(document).ready(function() {
	$('.select2').select2();
	});
</script>

<script src="{{ asset('assets/js/moment.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datetimepicker/js/tempusdominus-bootstrap-4.min.js') }}"></script>

<!-- <script src="{{ asset('assets/js/app.js') }}"></script> -->
@endsection


