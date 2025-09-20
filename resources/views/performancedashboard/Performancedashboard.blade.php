@extends('layouts.app')
@section('title', 'Performance Dashboard')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">

        {{-- Sales team cards --}}
        @include('performancedashboard.partials.sales_team')

        {{-- Quarter target tables --}}
        @include('performancedashboard.partials.technology_target')

        {{-- Quarter target tables --}}
        @include('performancedashboard.partials.team_targets')

        {{-- Intervie target tables --}}
        @include('performancedashboard.partials.interview_team')

        {{-- Intervie target tables --}}
        @include('performancedashboard.partials.closedLeadsQuarterCounts')

    </div>
</div>


@endsection
