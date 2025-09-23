@extends('layouts.app')
@section('content')
@section('title', 'Dashboard')

<div class="page-wrapper">
	<div class="content container-fluid">

		<!-- <div class="page-header">
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
					
				</div>
			</div>
		</div> -->


		<!--
		|--------------------------------------------------------------------------
		| sales team Dashboard
		|--------------------------------------------------------------------------
		-->
			@if ($user->role == 3)
				<!-- @include('dashboard.salesTeamDashboard') -->
				@include('departments.sales')
		
		<!--
		|--------------------------------------------------------------------------
		| sales Dashboard
		|--------------------------------------------------------------------------
		-->
			@elseif ($user->role == 4)
				@include('departments.marketing')

		<!--
		|--------------------------------------------------------------------------
		| Finance Dashboard
		|--------------------------------------------------------------------------
		-->
			@elseif ($user->role == 5)
				@include('departments.finance')
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
<!-- <script>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
@endsection

