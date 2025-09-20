    <!--
    |--------------------------------------------------------------------------
    | Email Extractor Dashboard
    |--------------------------------------------------------------------------
    -->
    <div class="row">
	@php
		// Define an array of light background colors
		$backgroundColors = ['#ffe5e5', '#e5ffe5', '#e5e5ff', '#ffffcc', '#ccffff'];
		$colorIndex = 0;
	@endphp
	@foreach($emailExtractors as $email_extractor)
	
		<div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
			<!-- <a href="{{ route('user.leads.show', ['userId' => $user->user_id]) }}"> -->
				<div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }};">
					<div class="profile-img">
						@if($email_extractor->user_image)
							<span class="avatar">
								<img class="img-fluid" src="{{ asset('storage/' . $email_extractor->user_image) }}" alt="">
							</span>
						@else
							<span class="avatar">{{ strtoupper(substr($email_extractor->firstname, 0, 1)) }}{{ strtoupper(substr($email_extractor->lastname, 0, 1)) }}</span>
						@endif
					</div>
					
					<div class="dash-widget-info text-right">
						<strong><span>{{ $email_extractor->firstname }} {{ $email_extractor->lastname }}</span></strong>
						<!-- You can use the countLeads() method to get the count -->
						<!-- <h3>Today : </h3>
						<span>Total Lead in this month : </span> -->
					</div>
				</div>
			<!-- </a> -->
		</div>

		@php
		$colorIndex++;
		@endphp
	@endforeach
</div>
