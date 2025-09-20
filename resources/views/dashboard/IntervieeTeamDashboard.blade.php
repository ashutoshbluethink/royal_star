	<!--
    |--------------------------------------------------------------------------
    | Interviee Dashboard
    |--------------------------------------------------------------------------
    -->
    @if(Auth::check() && Auth::user()->email !== 'ck2ck32@gmail.com')

    <div class="row">
    @php
        // Define an array of light background colors
        $backgroundColors = ['#f0f0f0', '#fafafa', '#f5f5f5', '#fcfcfc', '#f9f9f9'];
        $colorIndex = 0;
    @endphp
    @foreach($interviewers as $interviewee)
    @if($interviewee->user_id == $user->user_id)
        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
            <a href="{{ route('user.leads.show', ['userId' => $interviewee->user_id]) }}">
                <div class="dash-widget dash-widget5" style="background-color: {{ $backgroundColors[$colorIndex % count($backgroundColors)] }}; {{ $interviewee->todayInterviewCount > 0 ? 'border: 3px solid green; font-weight: bold;' : '' }}">
                    <div class="profile-img">
                        @if($interviewee->user_image)
                            <span class="avatar">
                                <img class="img-fluid" src="{{ asset('storage/' . $interviewee->user_image) }}" alt="">
                            </span>
                        @else
                            <span class="avatar">{{ strtoupper(substr($interviewee->firstname, 0, 1)) }}{{ strtoupper(substr($interviewee->lastname, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="dash-widget-info text-right">
                        <strong><span>{{ $interviewee->firstname }} {{ $interviewee->lastname }}</span></strong>
                        <h4>Scheduled for today : {{ $interviewee->todayInterviewCount }}</h4>
                        <span>Total interview in this month : {{ $interviewee->monthLeadCount }}</span>
                    </div>
                </div>
            </a>
        </div>
        @endif
        @php
            $colorIndex++;
        @endphp
    @endforeach
@endif
</div>