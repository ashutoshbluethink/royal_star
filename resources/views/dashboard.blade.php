@extends('layouts.app')

@section('content')
@section('title', 'Dashboard')

<div class="page-wrapper">
	<div class="content container-fluid">

		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
					<h3 class="page-title mb-0">Dashboard</h3>
				</div>
				<div class="col-md-6">
					<ul class="breadcrumb mb-0 p-0 float-right">
						<li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i> Home</a>
						</li>
						<li class="breadcrumb-item"><span>Dashboard</span></li>
					
					</ul>
					<!--<p><i aria-hidden="true" class="fas fa-calendar-alt"></i> December 6, 2018</p>-->
				</div>
			</div>
		</div>
		<!--<p style="color: red;">Due to scheduled maintenance, the site will be undergoing maintenance from 7 PM to 11 PM. During this period, you may experience disruptions on various pages, such as <span style="color: blue;">lead addition</span>, <span style="color: blue;">user addition</span>, etc.</p>-->

		<!--
		|--------------------------------------------------------------------------
		| sales team Dashboard
		|--------------------------------------------------------------------------
		-->
			@if ($user->role == 4)
				@include('dashboard.salesTeamDashboard')
		
		<!--
		|--------------------------------------------------------------------------
		| Interviee Dashboard
		|--------------------------------------------------------------------------
		-->
			@elseif ($user->role == 3)
				@include('dashboard.IntervieeTeamDashboard')
		<!--
		|--------------------------------------------------------------------------
		| EmailExtractor
		|--------------------------------------------------------------------------
		-->
		@elseif ($user->role == 6)
				@include('dashboard.emailExtractor')
		<!--
		|--------------------------------------------------------------------------
		| Lead Support Team
		|--------------------------------------------------------------------------
		-->
				@elseif ($user->role == 8)
				@include('dashboard.leadSupportTeam')		
			
		<!--
		|--------------------------------------------------------------------------
		| All Adminstrator Dashboard
		|--------------------------------------------------------------------------
		-->
			@else
				@include('dashboard.AdminstratorTeamDashboard')
			@endif
		<!--
		|--------------------------------------------------------------------------
		| Sales Team Today Lead 
		|--------------------------------------------------------------------------
		-->
		
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

