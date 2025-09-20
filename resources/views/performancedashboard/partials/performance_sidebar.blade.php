<?php
// Function to check if a route is active
function isActiveRoute($routeName)
{

    return request()->routeIs($routeName) ? 'active' : '';
}

?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <div class="header-left">
                <a href="{{ route('performance.dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/logo1.png') }}" width="150" height="40" alt="Logo">
                    <span class="text-uppercase">Sales</span>
                </a>
            </div>

            <ul class="sidebar-ul">
                <li class="{{ request()->routeIs('performance.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('performance.dashboard') }}">
                        <i class="fas fa-chart-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->routeIs('performance.targets.index') ? 'active' : '' }}">
                    <a href="{{ route('performance.targets.index') }}">
                        <i class="fas fa-bullseye"></i> <span>Add Targets</span>
                    </a>
                </li>
                <!-- New Menu Item for Running Projects -->
                <li class="{{ request()->routeIs('performance.running.projects.vendors') ? 'active' : '' }}">
                    <a href="{{ route('performance.running.projects.vendors') }}">
                        <i class="fas fa-tasks"></i> <span>Vendor Projects</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-arrow-left"></i> <span>Back to Main</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
