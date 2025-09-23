@extends('layouts.app-lite')
@section('title','Admin & HR Dashboard')
@section('content')

<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Verification Pending</div><div class="value">37</div></div><i class="fas fa-file-shield text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Inside / Outside</div><div class="value">64% / 36%</div></div><i class="fas fa-arrows-left-right text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Avg SLA (hrs)</div><div class="value">18</div></div><i class="fas fa-clock text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Files Today</div><div class="value">55</div></div><i class="fas fa-folder-open text-success"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3">
    <div class="card-modern"><div class="card-header">Hiring Pathway Split</div><div class="card-body"><div id="admin_pathway"></div></div></div>
  </div>
  <div class="col-lg-6 mb-3">
    <div class="card-modern"><div class="card-header">Admin Throughput (Files/Day)</div><div class="card-body"><div id="admin_throughput"></div></div></div>
  </div>
</div>

<div class="card-modern">
  <div class="card-header">T&C Acknowledgments & Refund Window</div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-modern">
        <thead><tr><th>Client</th><th>Emirates ID</th><th>Clause</th><th>Ack</th><th>Signed</th><th>Eligible Until</th><th class="text-right">Action</th></tr></thead>
        <tbody>
          <tr><td>Parker</td><td>784-1976-•••-1</td><td>No Further Demands</td><td><span class="badge badge-success">Yes</span></td><td>18/09/2025</td><td>02/10/2025</td><td class="text-right"><button class="btn btn-sm btn-outline-info">View</button></td></tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#admin_pathway'), {
    chart:{ type:'donut', height:300 },
    series:[64,36], labels:['Inside Office','Outside Deployment'],
    legend:{position:'bottom'}
  }).render();

  new ApexCharts(document.querySelector('#admin_throughput'), {
    chart:{ type:'line', height:300, toolbar:{show:false} },
    series:[{name:'Files', data:[42,55,49,60,58,40,37]}],
    xaxis:{ categories:['Mon','Tue','Wed','Thu','Fri','Sat','Sun'] },
    stroke:{ curve:'smooth', width:3 }, dataLabels:{ enabled:false }
  }).render();
</script>
@endsection
