<?php
function isActiveRoute($routeName)
{
    return request()->routeIs($routeName) ? 'active' : '';
}

?>

<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <div class="header-left">
                <a href="{{ route('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/logo.png') }}" width="150" height="100" alt="">
                    <!-- <span class="text-uppercase">Group</span> -->
                </a>
            </div>
            <ul class="sidebar-ul">
                <!-- <li class="menu-title">Menu</li> -->
                <li class="{{ isActiveRoute('dashboard') }}">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/sidebar/icon-1.png') }}" alt="icon">
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role != 6)

                <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
                        <span> Call History</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('callhistory.index') }}" class="{{ isActiveRoute('callhistory.index') }}"><span>Add Call</span></a></li>
                        <li><a href="{{ route('callhistory.show') }}" class="{{ isActiveRoute('callhistory.show') }}" ><span>View Call</span></a></li>
                    </ul>
                </li>
                @endif

                <?php 
                if($user->role == 4 || $user->role == 1){
                ?>
                <!-- Leads Menu -->
                <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-7.png') }}" alt="icon"><span> Lead</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('leads.searchform') }}" class="{{ request()->routeIs('leads.searchform') ? 'active' : '' }}"><span>Add Leads</span></a></li>

                        <!-- <li><a href="{{ route('add.lead') }}" class="{{ request()->routeIs('add.lead') ? 'active' : '' }}"><span>Add Leads</span></a></li> -->

                        <li>
                            <a href="{{ route('view.lead') }}" class="{{ request()->routeIs('view.lead') || request()->routeIs('search.leads') ? 'active' : '' }}">
                                <span>View All Lead</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('view.c2clead') }}" class="{{ request()->routeIs('view.c2clead') ? 'active' : '' }}">
                                <span>View C2C Lead</span>
                            </a>
                        </li>

                        @if(request()->routeIs('leads.edit'))
                            <li><a href="" class="{{ isActiveRoute('leads.edit') }}"><span>Edit Lead</span></a></li>
                        @endif
                        
                        @if(request()->routeIs('leads.show'))
                            <li><a href="#" class="{{ isActiveRoute('leads.show') }}"><span>Show Lead</span></a></li>
                        @endif

                    </ul>
                </li>

                <!-- Vendors Menu -->
                <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-3.png') }}" alt="icon"><span> Vendors</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('vendors.createVendor') }}" class="{{ request()->routeIs('vendors.createVendor') ? 'active' : '' }}"><span>Add Vendor</span></a></li>
                        @if(request()->routeIs('vendors.edit'))
                            <li><a href="{{ route('vendors.edit', $vendor->id) }}" class="{{ isActiveRoute('vendors.edit') }}"><span>Edit Vendor</span></a></li>
                        @endif
                        <li><a href="{{ route('vendors.index') }}" class="{{ request()->routeIs('vendors.index') ? 'active' : '' }}"><span>View Vendors</span></a></li>
                    </ul>
                </li>

                <!-- Users Menu -->
                <li class="submenu">
                    <a href="#"><img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon"><span> User</span>
                        <span class="menu-arrow"></span></a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('add.user') }}" class="{{ isActiveRoute('add.user') }}"><span>Add Users</span></a></li>
                        @if(request()->routeIs('user.edit'))
                            <li><a href="{{ route('user.edit', $user->user_id) }}" class="{{ isActiveRoute('user.edit') }}"><span>Edit Users</span></a></li>
                        @endif
                            <li><a href="{{ route('view.user') }}" class="{{ isActiveRoute('view.user') }}"><span>View Users</span></a></li>

                        @if(request()->routeIs('user.leads.show') || request()->routeIs('user.leadsearchhow'))
                            <li><a href="#" class="{{ isActiveRoute('user.leads.show') || request()->routeIs('user.leadsearchhow') ? 'active' : '' }}"><span>user Lead</span></a></li>
                        @endif
                    </ul>
                </li>

                <!-- Profiles Menu -->
                <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon">
                        <span> Profiles</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('profiles.create') }}" class="{{ isActiveRoute('profiles.create') }}"><span>Add Profile</span></a></li>
                        @if(Route::currentRouteName() == 'profiles.edit')
                        <li><a href="{{ route('profiles.edit', $profile->id) }}" class="{{ isActiveRoute('profiles.edit') }}"><span>Edit Profile</span></a></li>
                        @endif
                        <li><a href="{{ route('profiles.index') }}" class="{{ isActiveRoute('profiles.index') }}"><span>View Profiles</span></a></li>
                    </ul>
                </li>

                <!-- Configurations Menu -->
                <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
                        <span> Configurations</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                        <li><a href="{{ route('add.company') }}" class="{{ isActiveRoute('add.company') }}"><span>Add Company</span></a></li>
                        <li><a href="{{ route('add.technology') }}" class="{{ isActiveRoute('add.technology') }}"><span>Add Technology</span></a></li>
                        <li><a href="{{ route('add.role') }}" class="{{ isActiveRoute('add.role') }}"><span>Add Role</span></a></li>
                        <li><a href="{{ route('add.leadstatus') }}" class="{{ isActiveRoute('add.leadstatus') }}"><span>Lead Status</span></a></li>
                       
                    </ul>
                </li>
                        
                <?php
                }
                ?>
                
                <!-- Email Validation -->

                <!-- <li class="submenu">
                    <a href="#">
                        <img src="{{ asset('assets/img/sidebar/icon-19.png') }}" alt="icon">
                        <span> Email Validation</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="list-unstyled" style="display: none;">
                    <li><a href="{{ route('email.form') }}" class="{{ isActiveRoute('email.form') }}"><span>Email Validation Form</span></a></li>
                    <li><a href="{{ route('email.config') }}" class="{{ isActiveRoute('email.config') }}"><span>Email Configuration</span></a></li> 
                </li> -->
                <!-- Email Validation -->
              
            </ul>
        </div>
    </div>
</div>



