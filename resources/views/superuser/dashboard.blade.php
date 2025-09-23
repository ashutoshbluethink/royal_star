@extends('layouts.app-lite')
@section('title','Super User Dashboard')

@section('content')
<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Active Users</div><div class="value">128</div></div><i class="fas fa-users text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">MTD Revenue</div><div class="value">AED 1.20M</div></div><i class="fas fa-coins text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Open Vacancies</div><div class="value">21</div></div><i class="fas fa-briefcase text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Tickets Open</div><div class="value">12</div></div><i class="fas fa-ticket text-danger"></i></div></div>
</div>

<div class="mod-grid">
  {{-- Department Dashboards --}}
  <div class="mod-card span-6" style="--grad:#4f46e5; --icon-bg:#4f46e5;">
    <div class="mod-ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-table-columns"></i></div>
        <div>
          <h5 class="mod-title">Department Dashboards</h5>
          <div class="mod-sub">Sales • Admin • Finance • Marketing • IT • Deployment • Drivers</div>
        </div>
        <span class="ml-auto chip">7 spaces</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-eye mr-1"></i> Adoption: <strong>72%</strong></div>
        <div class="mini"><i class="far fa-bell mr-1"></i> Alerts: <strong>3</strong></div>
      </div>
      <div class="bar"><i style="--v:72%; --b1:#818cf8; --b2:#22d3ee"></i></div>
      <div class="mod-actions mt-3">
        <a href="{{ url('/dept/sales') }}" class="btn btn-primary btn-sm"><i class="fas fa-chart-line mr-1"></i> Sales</a>
        <a href="{{ url('/dept/finance') }}" class="btn btn-outline-primary btn-sm">Finance</a>
        <a href="{{ url('/dept/marketing') }}" class="btn btn-outline-primary btn-sm">Marketing</a>
      </div>
    </div>
  </div>

  {{-- Client Management --}}
  <div class="mod-card span-6" style="--grad:#16a34a; --icon-bg:#16a34a;">
    <div class="mod-ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-user-check"></i></div>
        <div>
          <h5 class="mod-title">Client Management</h5>
          <div class="mod-sub">From application → deployment</div>
        </div>
        <span class="ml-auto chip">SLA 24h</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-folder-open mr-1"></i> In Progress: <strong>142</strong></div>
        <div class="mini"><i class="far fa-check-circle mr-1"></i> Approved: <strong>76%</strong></div>
      </div>
      <div class="bar"><i style="--v:56%; --b1:#34d399; --b2:#60a5fa"></i></div>
      <div class="mod-actions mt-3">
        <a href="{{ url('/module/client-management') }}" class="btn btn-success btn-sm"><i class="fas fa-users mr-1"></i> Open</a>
        <a href="#" class="btn btn-outline-success btn-sm">+ New Application</a>
      </div>
    </div>
  </div>

  {{-- Financial Tracking --}}
  <div class="mod-card span-6" style="--grad:#0ea5e9; --icon-bg:#0ea5e9;">
    <div class="mod-ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-file-invoice-dollar"></i></div>
        <div>
          <h5 class="mod-title">Financial Tracking</h5>
          <div class="mod-sub">Payments • Reports • Commissions</div>
        </div>
        <span class="ml-auto chip">Pending 9</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="fas fa-sack-dollar mr-1"></i> Today: <strong>AED 18,500</strong></div>
        <div class="mini"><i class="fas fa-rotate-left mr-1"></i> Refunds: <strong>AED 1,000</strong></div>
      </div>
      <div class="bar"><i style="--v:68%; --b1:#38bdf8; --b2:#22c55e"></i></div>
      <div class="mod-actions mt-3">
        <a href="{{ url('/module/financial-tracking') }}" class="btn btn-info btn-sm text-white"><i class="fas fa-wallet mr-1"></i> Open</a>
        <a href="#" class="btn btn-outline-info btn-sm">Verify</a>
      </div>
    </div>
  </div>

  {{-- Vacancy Management --}}
  <div class="mod-card span-6" style="--grad:#ea580c; --icon-bg:#ea580c;">
    <div class="mod-ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-briefcase"></i></div>
        <div>
          <h5 class="mod-title">Vacancy Management</h5>
          <div class="mod-sub">Shared portal for Marketing ↔ Sales</div>
        </div>
        <span class="ml-auto chip">Sync on</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-circle-dot mr-1"></i> Open: <strong>21</strong></div>
        <div class="mini"><i class="far fa-comments mr-1"></i> Interviewing: <strong>8</strong></div>
      </div>
      <div class="bar"><i style="--v:44%; --b1:#fb923c; --b2:#f472b6"></i></div>
      <div class="mod-actions mt-3">
        <a href="{{ url('/module/vacancy-management') }}" class="btn btn-warning btn-sm text-white"><i class="fas fa-list mr-1"></i> Open</a>
        <a href="#" class="btn btn-outline-warning btn-sm">Kanban</a>
      </div>
    </div>
  </div>

  {{-- Reporting & Analytics (full width) --}}
  <div class="mod-card span-12" style="--grad:#6d28d9; --icon-bg:#6d28d9;">
    <div class="mod-ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-chart-pie"></i></div>
        <div>
          <h5 class="mod-title">Reporting & Analytics</h5>
          <div class="mod-sub">Unified KPIs across departments</div>
        </div>
        <span class="ml-auto chip">Exports</span>
      </div>
      <div id="su_chart_overview" style="height:280px;"></div>
      <div class="mod-actions mt-2">
        <a href="{{ url('/module/reporting-analytics') }}" class="btn btn-primary btn-sm"><i class="fas fa-chart-line mr-1"></i> Open</a>
        <a href="#" class="btn btn-outline-primary btn-sm">Export PDF</a>
        <a href="#" class="btn btn-outline-primary btn-sm">Export Excel</a>
      </div>
    </div>
  </div>
</div>

<script>
  // Super User Overview chart (demo)
  new ApexCharts(document.querySelector('#su_chart_overview'), {
    chart:{ type:'area', height:280, toolbar:{show:false} },
    series:[
      { name:'Revenue', data:[120,150,180,210,260,300,330] },
      { name:'Costs', data:[80,100,115,130,150,165,170] }
    ],
    xaxis:{ categories:['Jan','Feb','Mar','Apr','May','Jun','Jul'] },
    dataLabels:{ enabled:false }, stroke:{ curve:'smooth', width:3 }, fill:{ opacity:.25 }, legend:{ position:'bottom' }
  }).render();
</script>
@endsection
