
<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Open Vacancies</div><div class="value">21</div></div><i class="fas fa-briefcase text-primary"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Posts (7d)</div><div class="value">18</div></div><i class="fab fa-instagram text-danger"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Engagement (7d)</div><div class="value">2,770</div></div><i class="fas fa-bolt text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Filled (MTD)</div><div class="value">9</div></div><i class="fas fa-circle-check text-success"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-7 mb-3">
    <div class="card-modern">
      <div class="card-header">Vacancies Kanban</div>
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
            <div class="card-modern p-2 mb-2">Social Media Intern</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 mb-3">
    <div class="card-modern"><div class="card-header">Social Engagement (7d)</div><div class="card-body"><div id="mkt_engage"></div></div></div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#mkt_engage'), {
    chart:{ type:'bar', height:280, toolbar:{show:false} },
    series:[{ name:'Engagement', data:[920,760,480,610] }],
    xaxis:{ categories:['TikTok','Instagram','Facebook','YouTube'] },
    plotOptions:{ bar:{ columnWidth:'45%' } }, dataLabels:{ enabled:false }, legend:{ show:false }
  }).render();
</script>

