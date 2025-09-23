@extends('layouts.app-lite')
@section('title','Drivers Dashboard')
@section('content')

<div class="row">
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Assigned Today</div><div class="value">12</div></div><i class="fas fa-list text-primary"></i></div></div>
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Completed</div><div class="value">7</div></div><i class="fas fa-check-circle text-success"></i></div></div>
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Delayed</div><div class="value">2</div></div><i class="fas fa-clock text-warning"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-7 mb-3">
    <div class="card-modern">
      <div class="card-header">Assigned Drop-offs</div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-modern">
            <thead><tr><th>Client</th><th>Destination</th><th>Time</th><th>Status</th></tr></thead>
            <tbody>
              <tr><td>Parker</td><td>RAK – Site A</td><td>14:30</td><td><span class="badge badge-info">En Route</span></td></tr>
              <tr><td>Smith</td><td>DXB – Office B</td><td>15:10</td><td><span class="badge badge-primary">Assigned</span></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 mb-3">
    <div class="card-modern"><div class="card-header">Vehicle & Maintenance</div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="mb-2"><i class="fas fa-car mr-2"></i> Vehicle: <strong>Toyota Hiace</strong> • Plate: <strong>DXB-12345</strong></li>
          <li class="mb-2"><i class="far fa-calendar-check mr-2"></i> Last Service: <strong>10/09/2025</strong> • Next Due: <strong>10/11/2025</strong></li>
          <li class="mb-2"><i class="fas fa-sim-card mr-2"></i> SIM: <strong>97155•••821</strong> • Pkg: <strong>10GB</strong></li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
