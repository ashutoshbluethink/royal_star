@extends('layouts.app-lite')
@section('title','Deployment Dashboard')
@section('content')

<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Assigned</div><div class="value">48</div></div><i class="fas fa-list-check text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Driver Arranged</div><div class="value">33</div></div><i class="fas fa-truck-moving text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Deployed</div><div class="value">27</div></div><i class="fas fa-circle-check text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Temp Accommodation</div><div class="value">6</div></div><i class="fas fa-house-user text-warning"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-7 mb-3"><div class="card-modern"><div class="card-header">Deployment Pipeline</div><div class="card-body"><div id="dep_pipe"></div></div></div></div>
  <div class="col-lg-5 mb-3">
    <div class="card-modern">
      <div class="card-header d-flex justify-content-between"><div>Driver Dispatch (Today)</div><button class="btn btn-sm btn-outline-secondary">Optimize Route</button></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-modern table-sm mb-0">
            <thead><tr><th>Driver</th><th>Drop-off</th><th>Time</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>Ali Z.</td><td>AUH – Client #CST0002</td><td>14:30</td><td><span class="badge badge-info">En Route</span></td></tr>
              <tr><td>Lara V.</td><td>DXB – Client #CST0005</td><td>15:10</td><td><span class="badge badge-primary">Assigned</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#dep_pipe'), {
    chart:{ type:'bar', height:320, stacked:true, toolbar:{show:false} },
    series:[
      { name:'DXB', data:[18,12,10] },
      { name:'AUH', data:[12,9,8] },
      { name:'SHJ', data:[10,7,6] },
      { name:'RAK', data:[ 8,5,3] }
    ],
    xaxis:{ categories:['Assigned','Driver Arranged','Deployed'] },
    plotOptions:{ bar:{ columnWidth:'45%' } }, dataLabels:{ enabled:false }, legend:{ position:'bottom' }
  }).render();
</script>
@endsection
