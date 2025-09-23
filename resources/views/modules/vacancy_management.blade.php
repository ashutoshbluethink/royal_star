@extends('layouts.app')
@extends('layouts.app-lite')
@section('title','Vacancy Management')
@section('content')
<div class="page-wrapper">
<div class="row">
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Open</div><div class="value">21</div></div><i class="fas fa-circle-dot text-primary"></i></div></div>
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Interviewing</div><div class="value">8</div></div><i class="far fa-comments text-info"></i></div></div>
  <div class="col-md-4 mb-3"><div class="kpi"><div><div class="title">Filled (MTD)</div><div class="value">9</div></div><i class="fas fa-check-circle text-success"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-7 mb-3">
    <div class="card-modern">
      <div class="card-header d-flex justify-content-between"><div>Kanban</div><button class="btn btn-sm btn-outline-primary">+ Vacancy</button></div>
      <div class="card-body">
        <div class="d-flex overflow-auto" style="gap:16px;">
          <div class="p-2" style="min-width:260px;background:#f8fafc;border-radius:12px;">
            <div class="mb-2 font-weight-bold">Open</div>
            <div class="card-modern p-2 mb-2">Warehouse Helper (DXB) <span class="badge badge-info ml-2">Urgent</span></div>
            <div class="card-modern p-2 mb-2">Office Admin (AUH)</div>
          </div>
          <div class="p-2" style="min-width:260px;background:#f8fafc;border-radius:12px;">
            <div class="mb-2 font-weight-bold">Interviewing</div>
            <div class="card-modern p-2 mb-2">Customer Service — 3 candidates</div>
          </div>
          <div class="p-2" style="min-width:260px;background:#f8fafc;border-radius:12px;">
            <div class="mb-2 font-weight-bold">Filled</div>
            <div class="card-modern p-2 mb-2">Data Entry (DXB)</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 mb-3"><div class="card-modern"><div class="card-header">Fill Rate (MTD)</div><div class="card-body"><div id="vm_fill"></div></div></div></div>
</div>
</div>
<script>
  new ApexCharts(document.querySelector('#vm_fill'), {
    chart:{ type:'line', height:280, toolbar:{show:false} },
    series:[{ name:'Fill %', data:[22,30,35,40,44] }],
    xaxis:{ categories:['W1','W2','W3','W4','W5'] },
    dataLabels:{ enabled:false }, stroke:{ curve:'smooth', width:3 }
  }).render();
</script>
@endsection
