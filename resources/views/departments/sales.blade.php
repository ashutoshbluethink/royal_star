@extends('layouts.app-lite')
@section('title','Sales Dashboard')
@section('content')

<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Active Leads</div><div class="value">1,250</div></div><i class="fas fa-user-plus text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Collections (MTD)</div><div class="value">AED 480K</div></div><i class="fas fa-coins text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Apps In-Progress</div><div class="value">142</div></div><i class="fas fa-clipboard-list text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Commission (MTD)</div><div class="value">AED 62K</div></div><i class="fas fa-percent text-warning"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-7 mb-3">
    <div class="card-modern">
      <div class="card-header"><div>Sales/Application Pipeline</div><span class="chip">Started → Submitted → Admin Review</span></div>
      <div class="card-body"><div id="sales_pipeline"></div></div>
    </div>
  </div>
  <div class="col-lg-5 mb-3">
    <div class="card-modern">
      <div class="card-header">Collections vs Refunds (Today)</div>
      <div class="card-body"><div id="sales_day"></div></div>
    </div>
  </div>
</div>

<div class="card-modern">
  <div class="card-header d-flex justify-content-between">
    <div>Recent Applications</div>
    <div class="d-flex" style="gap:8px;">
      <a href="#" class="btn btn-sm btn-outline-secondary">Leads</a>
      <a href="#" class="btn btn-sm btn-primary">+ New Application</a>
    </div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-modern">
        <thead><tr><th>File No</th><th>Candidate</th><th>Status</th><th>Sales Rep</th><th>Submitted</th><th class="text-right">Action</th></tr></thead>
        <tbody>
          <tr><td>RS-1023</td><td>Parker</td><td><span class="badge badge-warning">Admin Review</span></td><td>Priya</td><td>20/09/2025</td><td class="text-right"><a href="#" class="btn btn-sm btn-outline-info">Open</a></td></tr>
          <tr><td>RS-1024</td><td>Smith</td><td><span class="badge badge-success">Submitted</span></td><td>Arjun</td><td>20/09/2025</td><td class="text-right"><a href="#" class="btn btn-sm btn-outline-info">Open</a></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#sales_pipeline'), {
    chart:{ type:'bar', height:320, stacked:true, toolbar:{show:false} },
    series:[
      {name:'Started', data:[18,22,17,14]},
      {name:'Submitted', data:[12,16,13,10]},
      {name:'Admin Review', data:[8,9,11,7]}
    ],
    xaxis:{ categories:['W1','W2','W3','W4'] }, dataLabels:{enabled:false}, legend:{position:'bottom'}
  }).render();

  new ApexCharts(document.querySelector('#sales_day'), {
    chart:{ type:'donut', height:280 },
    series:[18500,1000], labels:['Collections','Refunds'],
    legend:{ position:'bottom' }, plotOptions:{ pie:{ donut:{ labels:{ show:true }}}}
  }).render();
</script>
@endsection
