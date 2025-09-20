
<div class="header-outer">
	<div class="header">
		<a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fas fa-bars"
				aria-hidden="true"></i></a>
		<a id="toggle_btn" class="float-left" href="javascript:void(0);">
			<img src="{{ asset('assets/img/sidebar/icon-21.png') }}" alt="">
		</a>
		@php
			if (!auth()->check() || auth()->user()->role === null) {
				header("Location: " . route('login'));
				exit();
			}
		@endphp
		@if(auth()->user()->role != 3)
			<ul class="nav float-left search-dropdown-box">
				<li class="nav-item dropdown d-none d-sm-block">
<center>
					 <div class=" col-12 head-joining">
                    
                    <h2 class="text-primary text-uppercase" style="font-family: 'Arial', sans-serif; font-weight: bold;">
                        النجم الملكي للاستشارات الادارية
                    </h2>
                    <h5 class="text-muted font-weight-bold">ROYAL STAR MANAGEMENT CONSULTANCY</h5>
                   
                </div> </center>
					<!-- <div class="top-nav-search">
						<input class="dropdown-toggle nav-link form-control" data-toggle="dropdown" type="text" class="dropdown-toggle nav-link" placeholder="Search here" onkeyup="liveSearch()">
						<button class="btn" type="submit"><i class="fa fa-search"></i></button>

						<div class="dropdown-menu notifications" id="search-results">
							<div class="topnav-dropdown-header">
								<span>Search Results</span>
							</div>
							<div class="drop-scroll">
								<ul class="notification-list" id="search-result-list">
									
								</ul>
							</div>
							<div class="topnav-dropdown-footer">
								<a href="{{ route('view.lead') }}">View all Leads</a>
							</div>
						</div>
					</div> -->
				</li>
				<li>
					<a href="index.html" class="mobile-logo d-md-block d-lg-none d-block"><img
					src="{{ asset('assets/img/logo1.png') }}" alt="" width="30" height="30"></a>
				</li>
			</ul>
		@endif

		<ul class="nav user-menu float-right">

			<li class="nav-item dropdown has-arrow">
				<a href="#" class="nav-link user-link" data-toggle="dropdown">
					<span class="user-img">
						@if($user->user_image)
							<img class="rounded-circle" src="{{ asset('storage/' . $user->user_image) }}" width="30" alt="Admin">
						@else
							<span class="avatar">{{ strtoupper(substr($user->firstname, 0, 1)) }}{{ strtoupper(substr($user->lastname, 0, 1)) }}</span>
						@endif
						<span class="status online"></span>
					</span>
					
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
					<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
				</div>
			</li>

		</ul>
		@auth
		<ul class="nav user-menu float-right">
			<li>
				<h5>Welcome, {{ $user->firstname }} {{ $user->lastname }}</h5>
				<p>{{ $user->email }}  <span class="badge badge-success-border">{{ $role->role_name }}</span></p>
			</li>
		</ul>
		@endauth
		<div class="dropdown mobile-user-menu float-right">
			<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
					class="fas fa-ellipsis-v"></i></a>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
				<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
			</div>
		</div>
	</div>
</div>