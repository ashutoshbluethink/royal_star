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
                        <li class="menu-title">Main Navigation</li>

                <!-- <li class="menu-title">Menu</li> -->
                <li class="{{ isActiveRoute('dashboard') }}">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/img/sidebar/icon-1.png') }}" alt="icon">
                        <span>Dashboard</span>
                    </a>
                </li>

        <!-- ===== New Royal Star Menus ===== -->
 <?php 
                if($user->role == 1){
                ?>
                <!-- Sales -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
            <span>Sales & Client </span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Client Leads</a></li>
            <li><a href="#">Applications Tracking</a></li>
            <li><a href="#">Payment Collection</a></li>
            <li><a href="#">Commission Reports</a></li>
            <li><a href="#">Vacancy Access</a></li>
            <li><a href="#">Sales Analytics</a></li>
          </ul>
        </li>
        
        <!-- Admin / HR -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-3.png') }}" alt="icon">
            <span>Admin & HR</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="{{ route('adminhr.joiningForm') }}" class="{{ isActiveRoute('adminhr.joiningForm') }}" >Joining Form </a></li>
             <li><a href="{{ route('adminhr.consultancyForm') }}" class="{{ isActiveRoute('adminhr.consultancyForm') }}">Employee Form</a></li>
             <li><a href="{{ route('adminhr.employeHistoryForm') }}" class="{{ isActiveRoute('adminhr.employeHistoryForm') }}">Employee History</a></li>

            <li><a href="#">Client File </a></li>
            <li><a href="#">Payment Verification</a></li>
            <li><a href="#">Hiring Pathway (Inside/Outside)</a></li>
            <li><a href="#">Interview Scheduling</a></li>
            <li><a href="#">Deploy Form Management</a></li>
            <li><a href="#">HR Accommodation</a></li>
           
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Daily HR Progress</a></li>
          </ul>
        </li>

        <!-- Finance -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-7.png') }}" alt="icon">
            <span>Finance</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Payment Verification & Reconciliation</a></li>
            <li><a href="#">Payment Records</a></li>
            <li><a href="#">Salary Structure</a></li>
            <li><a href="#">Commission Structure</a></li>
            <li><a href="#">Financial Reporting</a></li>
            <li><a href="#">Budgeting & Forecasting</a></li>
            <li><a href="#">Audit Trail</a></li>
          </ul>
        </li>

        <!-- Marketing -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
            <span>Marketing</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Vacancy Management</a></li>
            <li><a href="#">External Company Communication</a></li>
            <li><a href="#">Interview Arrangements</a></li>
            <li><a href="#">Social Media Planner</a></li>
            <li><a href="#">Daily Social Media Work</a></li>
            <li><a href="#">Performance Analytics</a></li>
            <li><a href="#">Resource Library</a></li>
          </ul>
        </li>

        <!-- IT -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-2.png') }}" alt="icon">
            <span>IT & Assets</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Device Allocation / Inventory</a></li>
            <li><a href="#">Access Provisioning</a></li>
            <li><a href="#">SIM Card Management</a></li>
            <li><a href="#">Support Ticket System</a></li>
            <li><a href="#">Asset Lifecycle</a></li>
          </ul>
        </li>

        <!-- Deployment -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-14.png') }}" alt="icon">
            <span>Deployment</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Client Assignment</a></li>
            <li><a href="#">Vacancy Coordination</a></li>
            <li><a href="#">Driver Arrangement & Tracking</a></li>
            <li><a href="#">Deployment Status</a></li>
            <li><a href="#">Temporary Accommodation</a></li>
            <li><a href="#">Feedback & Issue Reporting</a></li>
          </ul>
        </li>

        <!-- Drivers -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-19.png') }}" alt="icon">
            <span>Drivers</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Assigned Drop-offs</a></li>
            <li><a href="#">Route Optimization</a></li>
            <li><a href="#">Status Updates</a></li>
            <li><a href="#">Vehicle Info & Maintenance</a></li>
            <li><a href="#">Direct Communication</a></li>
          </ul>
        </li>
        <!-- ===== End Royal Star Menus ===== -->
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
                <?php }?>   
                <?php 
                if($user->role == 3){
                ?>
        <!-- Sales -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
            <span>Sales & Client </span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Client Leads</a></li>
            <li><a href="#">Applications Tracking</a></li>
            <li><a href="#">Payment Collection</a></li>
            <li><a href="#">Commission Reports</a></li>
            <li><a href="#">Vacancy Access</a></li>
            <li><a href="#">Sales Analytics</a></li>
          </ul>
        </li>
     <?php }?>   
     <?php 
                if($user->role == 5){
                ?>
        <!-- Finance -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-7.png') }}" alt="icon">
            <span>Finance</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Payment Verification & Reconciliation</a></li>
            <li><a href="#">Payment Records</a></li>
            <li><a href="#">Salary Structure</a></li>
            <li><a href="#">Commission Structure</a></li>
            <li><a href="#">Financial Reporting</a></li>
            <li><a href="#">Budgeting & Forecasting</a></li>
            <li><a href="#">Audit Trail</a></li>
          </ul>
        </li>
     <?php }?>   
      <?php 
                if($user->role == 4){
                ?>
         <!-- Marketing -->
        <li class="submenu">
          <a href="#">
            <img src="{{ asset('assets/img/sidebar/icon-18.png') }}" alt="icon">
            <span>Marketing</span>
            <span class="menu-arrow"></span>
          </a>
          <ul class="list-unstyled" style="display:none;">
            <li><a href="#">Vacancy Management</a></li>
            <li><a href="#">External Company Communication</a></li>
            <li><a href="#">Interview Arrangements</a></li>
            <li><a href="#">Social Media Planner</a></li>
            <li><a href="#">Daily Social Media Work</a></li>
            <li><a href="#">Performance Analytics</a></li>
            <li><a href="#">Resource Library</a></li>
          </ul>
        </li>
     <?php }?>   
            </ul>
        </div>
    </div>
</div>



