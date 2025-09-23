<div class="row">
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Collections (Today)</div><div class="value">AED 18,500</div></div><i class="fas fa-sack-dollar text-success"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Refunds (Today)</div><div class="value">AED 1,000</div></div><i class="fas fa-rotate-left text-danger"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Pending Verifications</div><div class="value">9</div></div><i class="fas fa-magnifying-glass-dollar text-warning"></i></div></div>
  <div class="col-md-3 mb-3"><div class="kpi"><div><div class="title">Commission (MTD)</div><div class="value">AED 190K</div></div><i class="fas fa-percent text-info"></i></div></div>
</div>

<div class="row">
  <div class="col-lg-6 mb-3">
    <div class="card-modern">
      <div class="card-header d-flex justify-content-between"><div>Payment Verification Queue</div><span class="chip"><i class="far fa-hourglass"></i> SLA: 24h</span></div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-modern">
            <thead><tr><th>Client</th><th>File #</th><th>Amount</th><th>Proof</th><th>Status</th><th class="text-right">Action</th></tr></thead>
            <tbody>
              <tr><td>Parker</td><td>RS-1023</td><td>AED 2,000</td><td><a href="#">receipt_1023.pdf</a></td><td><span class="badge badge-warning">Pending</span></td><td class="text-right"><button class="btn btn-sm btn-outline-success">Verify</button></td></tr>
              <tr><td>Hensley</td><td>RS-1050</td><td>AED 2,200</td><td><a href="#">receipt_1050.pdf</a></td><td><span class="badge badge-danger">Discrepancy</span></td><td class="text-right"><button class="btn btn-sm btn-outline-danger">Flag</button></td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 mb-3">
    <div class="card-modern"><div class="card-header">Collections vs Refunds (Today)</div><div class="card-body"><div id="fin_day"></div></div></div>
  </div>
</div>

<script>
  new ApexCharts(document.querySelector('#fin_day'), {
    chart:{ type:'donut', height:300 },
    series:[18500,1000], labels:['Collections','Refunds'],
    legend:{position:'bottom'}, plotOptions:{ pie:{ donut:{ labels:{show:true}}}}
  }).render();
</script>
