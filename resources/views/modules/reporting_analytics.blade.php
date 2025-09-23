@extends('layouts.app')
@extends('layouts.app-lite')
@section('title','Reporting & Analytics')
@section('content')
<div class="page-wrapper">
<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">KPI Coverage</div><div class="value">61%</div></div><i class="fas fa-bullseye text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Exports (30d)</div><div class="value">54</div></div><i class="fas fa-file-export text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Dashboards</div><div class="value">12</div></div><i class="fas fa-table-columns text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Alerts</div><div class="value">3</div></div><i class="fas fa-bell text-warning"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Revenue vs Cost</div><div class="card-body"><div id="ra_rev_cost"></div></div></div></div>
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Dept KPI Scorecard</div><div class="card-body"><div id="ra_score"></div></div></div></div>
</div>

<div class="card-modern">
  <div class="card-header d-flex justify-content-between"><div>Exports</div><div><button class="btn btn-sm btn-outline-primary">PDF</button> <button class="btn btn-sm btn-outline-primary">Excel</button></div></div>
  <div class="card-body">
    <ul class="mb-0">
      <li class="mb-2"><i class="far fa-file-pdf mr-2"></i> Weekly Exec Pack</li>
      <li class="mb-2"><i class="far fa-file-excel mr-2"></i> Sales Source Drilldown</li>
      <li class="mb-2"><i class="far fa-file-excel mr-2"></i> Commission by Rep</li>
    </ul>
  </div>
</div>
</div>
<script>
  new ApexCharts(document.querySelector('#ra_rev_cost'), {
    chart:{ type:'area', height:280, toolbar:{show:false} },
    series:[
      { name:'Revenue', data:[120,150,180,210,260,300,330] },
      { name:'Cost', data:[80,100,115,130,150,165,170] }
    ],
    xaxis:{ categories:['Jan','Feb','Mar','Apr','May','Jun','Jul'] }, dataLabels:{ enabled:false }, stroke:{ curve:'smooth', width:3 }, fill:{opacity:.25}, legend:{position:'bottom'}
  }).render();

  new ApexCharts(document.querySelector('#ra_score'), {
    chart:{ type:'bar', height:280, toolbar:{show:false} },
    series:[{ name:'KPI %', data:[78,72,66,61,58,54,49] }],
    xaxis:{ categories:['Sales','Finance','Marketing','Admin','IT','Deployment','Drivers'] },
    dataLabels:{ enabled:false }, plotOptions:{ bar:{ columnWidth:'45%' } }
  }).render();
</script>
@endsection
