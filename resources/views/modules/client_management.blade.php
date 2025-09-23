@extends('layouts.app-lite')
@section('title','Client Management')
@section('content')

<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Total Clients</div><div class="value">3,240</div></div><i class="fas fa-users text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">In Progress</div><div class="value">142</div></div><i class="fas fa-spinner text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Approved</div><div class="value">76%</div></div><i class="fas fa-check text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">This Week</div><div class="value">58</div></div><i class="fas fa-calendar-week text-warning"></i></div></div>
</div>

<div class="card-modern mb-3">
  <div class="card-header d-flex justify-content-between">
    <div>Applications</div>
    <div class="d-flex" style="gap:8px;"><button class="btn btn-sm btn-outline-secondary">Filter</button><button class="btn btn-sm btn-primary">+ New</button></div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-modern">
        <thead><tr><th>Client ID</th><th>Name</th><th>Contact</th><th>Status</th><th>Sales Rep</th><th>Submission</th><th class="text-right">Action</th></tr></thead>
        <tbody>
          <tr><td>C-1001</td><td>Parker</td><td>+971-55-123-4567</td><td><span class="badge badge-warning">Admin Review</span></td><td>Priya</td><td>20/09/2025</td><td class="text-right"><a href="#" class="btn btn-sm btn-outline-info">Open</a></td></tr>
          <tr><td>C-1002</td><td>Smith</td><td>+971-55-987-6543</td><td><span class="badge badge-success">Submitted</span></td><td>Arjun</td><td>20/09/2025</td><td class="text-right"><a href="#" class="btn btn-sm btn-outline-info">Open</a></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Pipeline</div><div class="card-body"><div id="cm_pipe"></div></div></div></div>
  <div class="col-lg-6 mb-3"><div class="card-modern"><div class="card-header">Lead Sources</div><div class="card-body"><div id="cm_sources"></div></div></div></div>
</div>

<script>
  new ApexCharts(document.querySelector('#cm_pipe'), {
    chart:{ type:'bar', height:300, stacked:true, toolbar:{show:false} },
    series:[
      {name:'Started', data:[25,20,18,15]},
      {name:'Submitted', data:[18,16,14,12]},
      {name:'Review', data:[12,10,9,8]}
    ],
    xaxis:{ categories:['W1','W2','W3','W4'] },
    legend:{ position:'bottom' }, dataLabels:{ enabled:false }
  }).render();

  new ApexCharts(document.querySelector('#cm_sources'), {
    chart:{ type:'bar', height:300, toolbar:{show:false} },
    series:[{ name:'Clients', data:[45,28,19,12,6] }],
    xaxis:{ categories:['Website','Referral','Social','Walk-in','Other'] },
    dataLabels:{ enabled:false }, plotOptions:{ bar:{ columnWidth:'45%' } }
  }).render();
</script>
@endsection
