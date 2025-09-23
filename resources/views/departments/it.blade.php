@extends('layouts.app-lite')
@section('title','IT & Assets Dashboard')
@section('content')

<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Devices Allocated</div><div class="value">58</div></div><i class="fas fa-laptop text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">In Stock</div><div class="value">23</div></div><i class="fas fa-box text-info"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Under Repair</div><div class="value">6</div></div><i class="fas fa-screwdriver-wrench text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Tickets Open</div><div class="value">12</div></div><i class="fas fa-ticket text-danger"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-4 mb-3"><div class="card-modern"><div class="card-header">Device Inventory</div><div class="card-body"><div id="it_inv"></div></div></div></div>
  <div class="col-lg-4 mb-3"><div class="card-modern"><div class="card-header">Access Provisioning</div><div class="card-body"><div id="it_access"></div></div></div></div>
  <div class="col-lg-4 mb-3">
    <div class="card-modern">
      <div class="card-header d-flex justify-content-between"><div>SIM Allocation</div><button class="btn btn-sm btn-outline-primary">Assign SIM</button></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-modern table-sm mb-0">
            <thead><tr><th>Employee</th><th>SIM</th><th>Pkg</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>Maryam</td><td>97155•••821</td><td>10GB</td><td><span class="badge badge-success">Active</span></td></tr>
              <tr><td>Arjun</td><td>97150•••243</td><td>5GB</td><td><span class="badge badge-warning">Expiring</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#it_inv'), {
    chart:{ type:'bar', height:300, toolbar:{show:false} },
    series:[{ name:'Devices', data:[58,23,6] }], xaxis:{ categories:['Allocated','In Stock','Repair'] },
    dataLabels:{enabled:false}, plotOptions:{ bar:{ columnWidth:'45%' } }
  }).render();

  new ApexCharts(document.querySelector('#it_access'), {
    chart:{ type:'bar', height:300, toolbar:{show:false} },
    series:[{ name:'Users', data:[120,85,35] }], xaxis:{ categories:['Email','CRM','Social'] },
    dataLabels:{enabled:false}, plotOptions:{ bar:{ columnWidth:'45%' } }
  }).render();
</script>
@endsection
