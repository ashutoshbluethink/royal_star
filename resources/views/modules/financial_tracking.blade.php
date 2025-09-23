@extends('layouts.app')
@extends('layouts.app-lite')
@section('title','Financial Tracking')
@section('content')
<div class="page-wrapper">
<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Today Collections</div><div class="value">AED 18,500</div></div><i class="fas fa-sack-dollar text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Today Refunds</div><div class="value">AED 1,000</div></div><i class="fas fa-rotate-left text-danger"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Pending Verifications</div><div class="value">9</div></div><i class="fas fa-magnifying-glass-dollar text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Budget Utilization</div><div class="value">68%</div></div><i class="fas fa-chart-area text-info"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Verification Queue</div><div class="card-body">
    <div class="table-responsive">
      <table class="table table-modern">
        <thead><tr><th>Txn ID</th><th>Type</th><th>Amount</th><th>Client/Payee</th><th>Status</th><th class="text-right">Action</th></tr></thead>
        <tbody>
          <tr><td>T-23001</td><td>Client Payment</td><td>AED 2,000</td><td>Parker</td><td><span class="badge badge-warning">Pending</span></td><td class="text-right"><button class="btn btn-sm btn-outline-success">Verify</button></td></tr>
          <tr><td>T-23002</td><td>Refund</td><td>AED 1,000</td><td>Smith</td><td><span class="badge badge-info">Review</span></td><td class="text-right"><button class="btn btn-sm btn-outline-secondary">Details</button></td></tr>
        </tbody>
      </table>
    </div>
  </div></div></div>

  <div class="col-lg-6 mb-3">
    <div class="card-modern"><div class="card-header">Collections vs Refunds (Today)</div><div class="card-body"><div id="ft_day"></div></div></div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Commission (MTD by Rep)</div><div class="card-body"><div id="ft_comm"></div></div></div></div>
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Budget vs Actual (Dept)</div><div class="card-body"><div id="ft_budget"></div></div></div></div>
</div>
</div>
<script>
  new ApexCharts(document.querySelector('#ft_day'), {
    chart:{ type:'donut', height:280 }, series:[18500,1000], labels:['Collections','Refunds'], legend:{position:'bottom'}, plotOptions:{pie:{donut:{labels:{show:true}}}}
  }).render();

  new ApexCharts(document.querySelector('#ft_comm'), {
    chart:{ type:'bar', height:280, toolbar:{show:false} },
    series:[{ name:'Commission (AED)', data:[3200,2100,1800,1100]}],
    xaxis:{ categories:['Priya','Arjun','Maryam','Omar'] }, dataLabels:{ enabled:false }
  }).render();

  new ApexCharts(document.querySelector('#ft_budget'), {
    chart:{ type:'line', height:280, toolbar:{show:false} },
    series:[
      { name:'Budget', data:[120,130,140,150,160,170,180] },
      { name:'Actual', data:[100,125,135,145,150,165,172] }
    ],
    xaxis:{ categories:['Jan','Feb','Mar','Apr','May','Jun','Jul'] }, stroke:{ curve:'smooth', width:3 }, dataLabels:{ enabled:false }, legend:{ position:'bottom' }
  }).render();
</script>
@endsection
