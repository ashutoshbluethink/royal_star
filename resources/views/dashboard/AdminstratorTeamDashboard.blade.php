<!--
    |--------------------------------------------------------------------------
    | Royal Star • Admin / Super User Dashboard
    |--------------------------------------------------------------------------
-->
{{-- ===== Module Overview Boxes ===== --}}
<style>
  .mod-grid { display:grid; grid-template-columns: repeat(12,1fr); gap:16px; }
  @media (max-width:1199.98px){ .mod-grid{ grid-template-columns: repeat(8,1fr);} }
  @media (max-width:767.98px){ .mod-grid{ grid-template-columns: repeat(4,1fr);} }
  @media (max-width:575.98px){ .mod-grid{ grid-template-columns: repeat(2,1fr);} }

  .mod-card {
    grid-column: span 6; /* 2 per row on desktop */
    position: relative; overflow: hidden;
    border-radius: 16px; background:#fff;
    border:1px solid #e9eef7; box-shadow:0 6px 20px rgba(15,23,42,.06);
    transition: transform .18s ease, box-shadow .18s ease, border-color .18s;
  }
  .mod-card:hover{ transform: translateY(-3px); box-shadow:0 10px 26px rgba(15,23,42,.1); border-color:#d8e2fb; }
  .mod-card .ink {
    position:absolute; inset:0; pointer-events:none; opacity:.12;
    background: radial-gradient(1200px 200px at 0% 0%, var(--grad) 0, transparent 60%);
  }
  .mod-body{ padding:16px; position:relative; z-index:1; }
  .mod-top{ display:flex; align-items:center; gap:12px; margin-bottom:10px; }
  .mod-icon{
    width:44px; height:44px; border-radius:12px; display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:1.1rem; background: var(--icon-bg, #6366f1);
    box-shadow: 0 6px 18px rgba(99,102,241,.35);
  }
  .mod-title{ font-weight:700; color:#0f172a; margin:0; line-height:1.2; }
  .mod-sub{ color:#64748b; font-size:.85rem; }
  .mod-kpis{ display:flex; gap:16px; flex-wrap:wrap; margin:10px 0 12px; }
  .chip { display:inline-flex; align-items:center; gap:6px; padding:4px 10px; border-radius:999px; background:#eef2ff; font-size:.78rem; color:#334155; }
  .mini { font-size:.8rem; color:#475569; }
  .mini strong{ color:#0f172a; }
  .bar{
    height:8px; border-radius:999px; background:#eef2f7; overflow:hidden; margin:4px 0 2px;
  }
  .bar > i{ display:block; height:100%; width:var(--v,40%); background:linear-gradient(90deg,var(--b1),var(--b2)); border-radius:999px; }
  .mod-actions{ display:flex; gap:8px; flex-wrap:wrap; }
  .mod-actions .btn{ border-radius:10px; padding:.4rem .65rem; font-size:.8rem; }
  .badge-soft{ background:#f1f5ff; color:#3b82f6; border:1px solid #dbe7ff; }
  .badge-soft-amber{ background:#fff7ed; color:#f59e0b; border:1px solid #fde7c7; }
  .badge-soft-green{ background:#ecfdf5; color:#10b981; border:1px solid #c9f3e5; }

  /* span widths for different breakpoints */
  .span-12{ grid-column: span 12; }
  .span-6{ grid-column: span 6; }
  .span-4{ grid-column: span 4; }
  @media (max-width:1199.98px){ .span-6{ grid-column: span 8; } .span-4{ grid-column: span 8; } }
  @media (max-width:767.98px){ .span-6, .span-4{ grid-column: span 4; } }
  @media (max-width:575.98px){ .span-6, .span-4{ grid-column: span 2; } }
</style>

<div class="mod-grid">

  {{-- 1) Department Dashboards --}}
  <div class="mod-card span-6" style="--grad:#4f46e5; --icon-bg:#4f46e5;">
    <div class="ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-table-columns"></i></div>
        <div>
          <h5 class="mod-title">Department Dashboards</h5>
          <div class="mod-sub">Sales • Admin • Finance • Marketing • IT • Deployment • Drivers</div>
        </div>
        <span class="ml-auto badge badge-soft">7 spaces</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-eye mr-1"></i> Active users: <strong>128</strong></div>
        <div class="mini"><i class="far fa-clock mr-1"></i> Avg load: <strong>0.8s</strong></div>
        <div class="mini"><i class="far fa-bell mr-1"></i> Alerts: <strong>3</strong></div>
      </div>
      <div class="bar" style="--v:72%; --b1:#818cf8; --b2:#22d3ee"></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">Adoption</div>
        <div class="text-dark small font-weight-600">72%</div>
      </div>
      <div class="mod-actions mt-3">
        <a href="#/dept/sales" class="btn btn-primary btn-sm"><i class="fas fa-chart-line mr-1"></i> Open Sales</a>
        <a href="#/dept/finance" class="btn btn-outline-primary btn-sm">Finance</a>
        <a href="#/dept/marketing" class="btn btn-outline-primary btn-sm">Marketing</a>
      </div>
    </div>
  </div>

  {{-- 2) Client Management --}}
  <div class="mod-card span-6" style="--grad:#16a34a; --icon-bg:#16a34a;">
    <div class="ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-user-check"></i></div>
        <div>
          <h5 class="mod-title">Client Management</h5>
          <div class="mod-sub">From application to deployment, all in one place</div>
        </div>
        <span class="ml-auto badge badge-soft-green">SLA 24h</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-folder-open mr-1"></i> In Progress: <strong>142</strong></div>
        <div class="mini"><i class="far fa-file mr-1"></i> New Today: <strong>18</strong></div>
        <div class="mini"><i class="far fa-check-circle mr-1"></i> Approved: <strong>76%</strong></div>
      </div>
      <div class="bar" style="--v:56%; --b1:#34d399; --b2:#60a5fa"></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">Pipeline Health</div>
        <div class="text-dark small font-weight-600">56%</div>
      </div>
      <div class="mod-actions mt-3">
        <a href="#/clients" class="btn btn-success btn-sm"><i class="fas fa-users mr-1"></i> View Clients</a>
        <a href="#/applications/new" class="btn btn-outline-success btn-sm">+ New Application</a>
        <a href="#/documents" class="btn btn-outline-success btn-sm">Documents</a>
      </div>
    </div>
  </div>

  {{-- 3) Financial Tracking --}}
  <div class="mod-card span-6" style="--grad:#0ea5e9; --icon-bg:#0ea5e9;">
    <div class="ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-file-invoice-dollar"></i></div>
        <div>
          <h5 class="mod-title">Financial Tracking</h5>
          <div class="mod-sub">Payments, reconciliation, and commission controls</div>
        </div>
        <span class="ml-auto badge badge-soft-amber">Pending 9</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="fas fa-sack-dollar mr-1"></i> Collections (Today): <strong>AED 18,500</strong></div>
        <div class="mini"><i class="fas fa-rotate-left mr-1"></i> Refunds: <strong>AED 1,000</strong></div>
        <div class="mini"><i class="fas fa-percent mr-1"></i> Commission (MTD): <strong>AED 190K</strong></div>
      </div>
      <div class="bar" style="--v:68%; --b1:#38bdf8; --b2:#22c55e"></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">Reconciliation</div>
        <div class="text-dark small font-weight-600">68% complete</div>
      </div>
      <div class="mod-actions mt-3">
        <a href="#/finance" class="btn btn-info btn-sm text-white"><i class="fas fa-wallet mr-1"></i> Finance Hub</a>
        <a href="#/finance/verify" class="btn btn-outline-info btn-sm">Verify Payments</a>
        <a href="#/finance/commissions" class="btn btn-outline-info btn-sm">Commissions</a>
      </div>
    </div>
  </div>

  {{-- 4) Vacancy Management --}}
  <div class="mod-card span-6" style="--grad:#ea580c; --icon-bg:#ea580c;">
    <div class="ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-briefcase"></i></div>
        <div>
          <h5 class="mod-title">Vacancy Management</h5>
          <div class="mod-sub">Shared portal for Marketing ↔ Sales</div>
        </div>
        <span class="ml-auto badge badge-soft">Sync on</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-circle-dot mr-1"></i> Open: <strong>21</strong></div>
        <div class="mini"><i class="far fa-comments mr-1"></i> Interviewing: <strong>8</strong></div>
        <div class="mini"><i class="far fa-circle-check mr-1"></i> Filled (MTD): <strong>9</strong></div>
      </div>
      <div class="bar" style="--v:44%; --b1:#fb923c; --b2:#f472b6"></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">Fill Rate</div>
        <div class="text-dark small font-weight-600">44% this month</div>
      </div>
      <div class="mod-actions mt-3">
        <a href="#/vacancies" class="btn btn-warning btn-sm text-white"><i class="fas fa-list mr-1"></i> View Vacancies</a>
        <a href="#/vacancies/kanban" class="btn btn-outline-warning btn-sm">Kanban</a>
        <a href="#/vacancies/new" class="btn btn-outline-warning btn-sm">+ New</a>
      </div>
    </div>
  </div>

  {{-- 5) Reporting & Analytics --}}
  <div class="mod-card span-12" style="--grad:#6d28d9; --icon-bg:#6d28d9;">
    <div class="ink"></div>
    <div class="mod-body">
      <div class="mod-top">
        <div class="mod-icon"><i class="fas fa-chart-pie"></i></div>
        <div>
          <h5 class="mod-title">Reporting & Analytics</h5>
          <div class="mod-sub">Unified KPIs across departments for data-driven decisions</div>
        </div>
        <span class="ml-auto badge badge-soft">Exports</span>
      </div>
      <div class="mod-kpis">
        <div class="mini"><i class="far fa-file-excel mr-1"></i> Weekly Exec Pack</div>
        <div class="mini"><i class="far fa-chart-bar mr-1"></i> KPI Scorecards</div>
        <div class="mini"><i class="far fa-download mr-1"></i> PDF / Excel</div>
      </div>
      <div class="bar" style="--v:61%; --b1:#a78bfa; --b2:#60a5fa"></div>
      <div class="d-flex justify-content-between align-items-center">
        <div class="text-muted small">Coverage</div>
        <div class="text-dark small font-weight-600">61% of metrics wired</div>
      </div>
      <div class="mod-actions mt-3">
        <a href="#/reports" class="btn btn-primary btn-sm"><i class="fas fa-chart-line mr-1"></i> Open Reports</a>
        <a href="#/reports/export?fmt=pdf" class="btn btn-outline-primary btn-sm">Export PDF</a>
        <a href="#/reports/export?fmt=xlsx" class="btn btn-outline-primary btn-sm">Export Excel</a>
      </div>
    </div>
  </div>

</div>

<div class="row">
  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <span class="float-left"><img src="assets/img/dash/dash-1.png" alt="" width="80"></span>
      <div class="dash-widget-info text-right">
        <span>Active Leads</span>
        <h3>1,250</h3>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <div class="dash-widget-info text-left d-inline-block">
        <span>Payments Verified</span>
        <h3>AED 480K</h3>
      </div>
      <span class="float-right"><img src="assets/img/dash/dash-2.png" width="80" alt=""></span>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <span class="float-left"><img src="assets/img/dash/dash-3.png" alt="" width="80"></span>
      <div class="dash-widget-info text-right">
        <span>Opportunities</span>
        <h3>3,200</h3>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
    <div class="dash-widget dash-widget5">
      <div class="dash-widget-info d-inline-block text-left">
        <span>Revenue (MTD)</span>
        <h3>AED 1.2M</h3>
      </div>
      <span class="float-right"><img src="assets/img/dash/dash-4.png" alt="" width="80"></span>
    </div>
  </div>
</div>


<!-- ===============Start================== -->

<!-- New Customers -->
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title">New Customers</div>
          </div>
          <div class="col-sm-6 text-sm-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-outline-primary mr-2"><img src="assets/img/excel.png" alt=""><span class="ml-2">Excel</span></button>
              <button class="btn btn-outline-danger mr-2"><img src="assets/img/pdf.png" alt="" height="18"><span class="ml-2">PDF</span></button>
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Columns</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="table-responsive">
              <table class="table custom-table">
                <thead class="thead-light">
                  <tr>
                    <th>Name</th>
                    <th>Customer ID</th>
                    <th>Account Manager</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Onboarded On</th>
                    <th>Invoice</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <h2><a href="profile.html" class="avatar text-white"><img src="assets/img/profile/img-1.jpg" alt=""></a>
                        <a href="profile.html">Parker <span></span></a>
                      </h2>
                    </td>
                    <td>CST-0001</td>
                    <td>Priya N.</td>
                    <td>+971-55-123-4567</td>
                    <td>9946 Baker Rd, Marysville</td>
                    <td>20/09/2025</td>
                    <td><img src="assets/img/pdf.png" alt=""></td>
                    <td class="text-right">
                      <a href="edit-customer.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2><a href="profile.html" class="avatar text-white"><img src="assets/img/profile/img-2.jpg" alt=""></a>
                        <a href="profile.html">Smith <span></span></a>
                      </h2>
                    </td>
                    <td>CST-0002</td>
                    <td>Arjun S.</td>
                    <td>+971-55-987-6543</td>
                    <td>193 S. Harrison Drive</td>
                    <td>20/09/2025</td>
                    <td><img src="assets/img/pdf.png" alt=""></td>
                    <td class="text-right">
                      <a href="edit-customer.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>

                  <tr>
                    <td>
                      <h2><a href="profile.html" class="avatar text-white"><img src="assets/img/profile/img-3.jpg" alt=""></a>
                        <a href="profile.html">Hensley <span></span></a>
                      </h2>
                    </td>
                    <td>CST-0003</td>
                    <td>Maryam K.</td>
                    <td>+971-50-222-3344</td>
                    <td>8949 Golf St, Palm Coast</td>
                    <td>20/09/2025</td>
                    <td><img src="assets/img/pdf.png" alt=""></td>
                    <td class="text-right">
                      <a href="edit-customer.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>

                 

                </tbody>
              </table>
            </div> <!-- /.table-responsive -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ================================================== -->
<div class="row">
  <!-- 1) Verification Pending -->
  <div class="col-12 col-sm-6 col-xl-3 mb-3">
    <div class="card shadow-sm border-0" style="background:#f8fafc;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted small">Verification Pending</div>
          <h3 class="mb-1">37</h3>
          <div class="small"><span class="text-success">▲ +5</span> today</div>
        </div>
        <img src="{{ asset('assets/img/dash/dash-2.png') }}" alt="" width="56" height="56">
      </div>
    </div>
  </div>

  <!-- 2) Inside vs Outside -->
  <div class="col-12 col-sm-6 col-xl-3 mb-3">
    <div class="card shadow-sm border-0" style="background:#f9fbff;">
      <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
          <div class="text-muted small">Inside vs Outside</div>
          <img src="{{ asset('assets/img/dash/dash-1.png') }}" alt="" width="56" height="56">
        </div>
        <h3 class="mb-2">
          <span class="text-success">64%</span>
          <span class="text-muted"> / </span>
          <span class="text-info">36%</span>
        </h3>
        <!-- tiny inline progress -->
        <div style="height:6px; background:#e9ecef; border-radius:4px; overflow:hidden;">
          <div style="width:64%; height:6px; background:#28a745;"></div>
        </div>
        <div class="small mt-1 text-muted">Inside Office / Outside Deployment</div>
      </div>
    </div>
  </div>

  <!-- 3) Collections Today -->
  <div class="col-12 col-sm-6 col-xl-3 mb-3">
    <div class="card shadow-sm border-0" style="background:#f8f9fb;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted small">Collections (Today)</div>
          <h3 class="mb-1">AED 18,500</h3>
          <div class="small text-muted">Refunds: AED 1,000</div>
        </div>
        <div class="text-right">
          <span class="badge badge-success">+12%</span>
        </div>
      </div>
    </div>
  </div>

  <!-- 4) Leads Today -->
  <div class="col-12 col-sm-6 col-xl-3 mb-3">
    <div class="card shadow-sm border-0" style="background:#f9f9ff;">
      <div class="card-body d-flex align-items-center justify-content-between">
        <div>
          <div class="text-muted small">Leads (Today)</div>
          <h3 class="mb-1">128</h3>
          <div class="small text-muted">MTD: 1,250</div>
        </div>
        <div class="text-right">
          <span class="badge badge-info">Top: Website</span>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ================================================== -->

<!-- --------------------------------------- -->
<!-- ApexCharts (remove if already included) -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="row">
  <!-- Payment Verification Queue -->
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Payment Verification Queue</div>
        <span class="badge badge-warning">Pending: <span id="badge-pending">0</span></span>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table custom-table">
            <thead class="thead-light">
              <tr><th>Client</th><th>File #</th><th>Amount</th><th>Proof</th><th>Status</th><th class="text-right">Action</th></tr>
            </thead>
            <tbody id="tbl-verify">
              <!-- filled by JS -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">SLA: verify within 24h • Discrepancies auto-notified to Finance</div>
    </div>
  </div>

  <!-- Collections vs Refunds (Today) -->
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Collections vs Refunds (Today)</div>
        <div>
          <span class="badge badge-success mr-1">Collections: AED <span id="badge-collections">0</span></span>
          <span class="badge badge-danger">Refunds: AED <span id="badge-refunds">0</span></span>
        </div>
      </div>
      <div class="card-body"><div id="chart_finance_day"></div></div>
      <div class="card-footer small text-muted">Reconciliation status: <span class="text-success">On track</span></div>
    </div>
  </div>
</div>

<script>
  // ===== Dummy data =====
  const verificationItems = [
    { client:'Parker', file:'RS-1023', amount:2000, proof:'receipt_1023.pdf', status:'Pending' },
    { client:'Smith',  file:'RS-1041', amount:1500, proof:'receipt_1041.pdf', status:'Pending' },
    { client:'Hensley',file:'RS-1050', amount:2200, proof:'receipt_1050.pdf', status:'Discrepancy' },
    { client:'Maryam', file:'RS-1066', amount: 900, proof:'receipt_1066.pdf', status:'Pending' },
    { client:'Omar',   file:'RS-1082', amount:1200, proof:'receipt_1082.pdf', status:'Verified' },
    { client:'Lara',   file:'RS-1089', amount: 750, proof:'receipt_1089.pdf', status:'Pending' },
    { client:'Ali',    file:'RS-1102', amount:1800, proof:'receipt_1102.pdf', status:'Pending' },
    { client:'Noor',   file:'RS-1115', amount:1300, proof:'receipt_1115.pdf', status:'Pending' }
  ];

  // Financials (today)
  const financeToday = {
    collections: 18500,
    refunds: 1000
  };

  // ===== Render Verification Table =====
  (function renderVerificationTable(){
    const tbody = document.getElementById('tbl-verify');
    const row = (r) => `
      <tr>
        <td>${r.client}</td>
        <td>${r.file}</td>
        <td>AED ${r.amount.toLocaleString()}</td>
        <td><a href="#">${r.proof}</a></td>
        <td>
          <span class="badge badge-${
            r.status === 'Pending' ? 'warning' :
            r.status === 'Discrepancy' ? 'danger' : 'success'
          }">${r.status}</span>
        </td>
        <td class="text-right">
          <button class="btn btn-sm btn-outline-success">Verify</button>
          <button class="btn btn-sm btn-outline-danger">Flag</button>
        </td>
      </tr>
    `;
    tbody.innerHTML = verificationItems.map(row).join('');

    // Update "Pending" badge
    const pendingCount = verificationItems.filter(x => x.status === 'Pending').length;
    document.getElementById('badge-pending').textContent = pendingCount;
  })();

  // ===== Update Finance Badges =====
  document.getElementById('badge-collections').textContent = financeToday.collections.toLocaleString();
  document.getElementById('badge-refunds').textContent = financeToday.refunds.toLocaleString();

  // ===== Render Collections vs Refunds chart =====
  (function renderFinanceDonut(){
    const chart = new ApexCharts(document.querySelector('#chart_finance_day'), {
      chart: { type: 'donut', height: 300 },
      series: [financeToday.collections, financeToday.refunds],
      labels: ['Collections', 'Refunds'],
      legend: { position: 'bottom' },
      dataLabels: { enabled: true },
      tooltip: {
        y: {
          formatter: (val) => `AED ${val.toLocaleString()}`
        }
      },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              total: {
                show: true,
                label: 'Total',
                formatter: (w) => {
                  const s = w.globals.seriesTotals.reduce((a,b)=>a+b,0);
                  return 'AED ' + s.toLocaleString();
                }
              }
            }
          }
        }
      }
    });
    chart.render();
  })();
</script>

<!-- =========================START========================= -->
<div class="row">
  <!-- Hiring Pathway Split -->
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header"><div class="page-title">Hiring Pathway Split</div></div>
      <div class="card-body"><div id="chart_pathway_split"></div></div>
    </div>
  </div>

  <!-- Admin Throughput (Files/Day) -->
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Admin Throughput (Files/Day)</div>
        <button id="btn-admin-calendar" class="btn btn-light btn-sm">Calendar View</button>
      </div>
      <div class="card-body"><div id="chart_admin_throughput"></div></div>
    </div>
  </div>
</div>

<script>
  // ===== Dummy data =====
  // Hiring pathway split (percentages)
  const pathway = { inside: 62, outside: 38 };

  // Admin throughput over the last 7 days (Mon-Sun)
  const adminThroughput = {
    days: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
    files: [42, 55, 49, 60, 58, 40, 37]  // number of files processed per day
  };

  // ===== Render Hiring Pathway Split (Donut) =====
  (function renderPathwaySplit() {
    const el = document.querySelector('#chart_pathway_split');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type: 'donut', height: 300, toolbar: { show: false } },
      series: [pathway.inside, pathway.outside],
      labels: ['Inside Office', 'Outside Deployment'],
      legend: { position: 'bottom' },
      dataLabels: { enabled: true },
      tooltip: { y: { formatter: (v) => v + '%' } },
      plotOptions: {
        pie: {
          donut: {
            labels: {
              show: true,
              total: {
                show: true,
                label: 'Total',
                formatter: () => (pathway.inside + pathway.outside) + '%'
              }
            }
          }
        }
      }
    }).render();
  })();

  // ===== Render Admin Throughput (Line) =====
  (function renderAdminThroughput() {
    const el = document.querySelector('#chart_admin_throughput');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type: 'line', height: 300, toolbar: { show: false } },
      series: [{ name: 'Files', data: adminThroughput.files }],
      xaxis: { categories: adminThroughput.days },
      stroke: { curve: 'smooth', width: 3 },
      markers: { size: 4 },
      dataLabels: { enabled: false },
      tooltip: { y: { formatter: (v) => v + ' files' } },
      grid: { strokeDashArray: 4 }
    }).render();
  })();

  // Demo click (you can hook to a modal/calendar later)
  document.getElementById('btn-admin-calendar')?.addEventListener('click', () => {
    alert('Calendar view (demo):\n' +
      adminThroughput.days.map((d,i)=> `${d}: ${adminThroughput.files[i]} files`).join('\n'));
  });
</script>

<!-- ------------------------END--------------------------------- -->

<!-- ==========================START====================== -->
<style>
  /* small helpers (optional) */
  .kanban-col { min-width: 260px; background:#f8f9fa; border-radius:8px; padding:8px; }
  .kanban-col h6 { font-weight:600; }
  .kanban-card { border:1px solid #e5e7eb; border-radius:8px; background:#fff; padding:8px 10px; margin-bottom:8px; }
  .kanban-card .meta { font-size:.8rem; color:#6c757d; }
</style>

<div class="row">
  <div class="col-lg-7 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Vacancies Kanban</div>
        <div class="small text-muted">Open • Interviewing • Filled</div>
      </div>
      <div class="card-body">
        <div id="vacancy-kanban" class="d-flex overflow-auto" style="gap:16px;">
          <div class="kanban-col">
            <h6>Open</h6>
            <div class="kanban-list" id="vac_open"></div>
          </div>
          <div class="kanban-col">
            <h6>Interviewing</h6>
            <div class="kanban-list" id="vac_interview"></div>
          </div>
          <div class="kanban-col">
            <h6>Filled</h6>
            <div class="kanban-list" id="vac_filled"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-5 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Social Content Planner</div>
        <div class="small text-muted">TikTok • IG • FB • YT</div>
      </div>
      <div class="card-body">
        <div id="social-calendar" class="mb-3"></div>
        <div id="chart_social_engagement"></div>
      </div>
    </div>
  </div>
</div>

<script>
  // ===== Dummy data =====
  const vacancies = {
    open: [
      { role:'Warehouse Helper (DXB)', tag:'Urgent', owner:'Marketing', openings:12 },
      { role:'Office Admin (AUH)',     tag:'New',    owner:'Admin',     openings:2  },
      { role:'Driver (RAK)',           tag:'New',    owner:'Deployment',openings:4  },
      { role:'CS Exec (SHJ)',          tag:'Hot',    owner:'Sales',     openings:3  }
    ],
    interviewing: [
      { role:'Customer Service', tag:'3 candidates', owner:'Sales',     openings:1 },
      { role:'Finance Junior',   tag:'2 candidates', owner:'Finance',   openings:1 },
      { role:'IT Support L1',    tag:'Scheduling',   owner:'IT',        openings:2 }
    ],
    filled: [
      { role:'Social Media Intern', tag:'Filled', owner:'Marketing', openings:0 },
      { role:'Data Entry (DXB)',    tag:'Filled', owner:'Admin',     openings:0 }
    ]
  };

  // Social calendar (next few posts)
  const socialCalendar = [
    { date:'21 Sep', channel:'Instagram', title:'Reel: Warehouse Helpers', status:'Scheduled' },
    { date:'22 Sep', channel:'TikTok',    title:'Day in the Life (DXB)',  status:'Draft' },
    { date:'23 Sep', channel:'Facebook',  title:'Hiring: Office Admin',   status:'Approved' },
    { date:'24 Sep', channel:'YouTube',   title:'Onboarding Walkthrough', status:'Production' },
    { date:'25 Sep', channel:'Instagram', title:'Story: Office Tour',     status:'Idea' }
  ];

  // Engagement last 7d (fake numbers)
  const engagement = {
    channels: ['TikTok','Instagram','Facebook','YouTube'],
    values:   [920, 760, 480, 610] // likes+comments+shares combined
  };

  // ===== Render Vacancies Kanban =====
  function vacCard(v) {
    return `
      <div class="kanban-card">
        <div class="d-flex justify-content-between">
          <strong>${v.role}</strong>
          <span class="badge badge-info">${v.tag}</span>
        </div>
        <div class="meta mt-1">Owner: ${v.owner}</div>
        <div class="meta">Openings: ${v.openings}</div>
      </div>
    `;
  }
  document.getElementById('vac_open').innerHTML       = vacancies.open.map(vacCard).join('');
  document.getElementById('vac_interview').innerHTML  = vacancies.interviewing.map(vacCard).join('');
  document.getElementById('vac_filled').innerHTML     = vacancies.filled.map(vacCard).join('');

  // ===== Render Social Calendar list =====
  (function renderSocialCalendar(){
    const container = document.getElementById('social-calendar');
    container.innerHTML = `
      <ul class="list-unstyled mb-0">
        ${socialCalendar.map(i => `
          <li class="mb-2 d-flex align-items-start">
            <div style="width:70px;" class="text-muted"><strong>${i.date}</strong></div>
            <div>
              <div><strong>${i.channel}</strong> — ${i.title}</div>
              <div class="small text-muted">Status: ${i.status}</div>
            </div>
          </li>
        `).join('')}
      </ul>
    `;
  })();

  // ===== Social Engagement chart =====
  (function renderSocialEngagement(){
    const el = document.querySelector('#chart_social_engagement');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type:'bar', height: 280, toolbar: { show:false } },
      series: [{ name:'Engagement (7d)', data: engagement.values }],
      xaxis: { categories: engagement.channels },
      plotOptions: { bar: { columnWidth:'45%' } },
      dataLabels: { enabled:false },
      tooltip: {
        y: { formatter: (val) => `${val} interactions` }
      },
      legend:{ show:false }
    }).render();
  })();
</script>

<!-- ---------------------------END------------------------------------- -->

<!-- ===============================Start=============================== -->
<div class="row">
  <div class="col-lg-4 d-flex">
    <div class="card flex-fill">
      <div class="card-header"><div class="page-title">Device Inventory</div></div>
      <div class="card-body"><div id="chart_it_inventory"></div></div>
      <div class="card-footer small text-muted">Allocated / In Stock / Repair</div>
    </div>
  </div>

  <div class="col-lg-4 d-flex">
    <div class="card flex-fill">
      <div class="card-header"><div class="page-title">Access Provisioning</div></div>
      <div class="card-body"><div id="chart_access_roles"></div></div>
      <div class="card-footer small text-muted">Email • CRM • Social</div>
    </div>
  </div>

  <div class="col-lg-4 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">SIM Allocation</div>
        <button id="btn-assign-sim" class="btn btn-sm btn-outline-primary">Assign SIM</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm mb-0">
            <thead><tr><th>Employee</th><th>SIM</th><th>Pkg</th><th>Status</th></tr></thead>
            <tbody id="sim-table-body">
              <!-- filled by JS -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // ===== Dummy data =====
  const inventory = {
    labels: ['Allocated', 'In Stock', 'Repair'],
    counts: [58, 23, 6]
  };

  const accessProvisioning = {
    labels: ['Email', 'CRM', 'Social'],
    counts: [120, 85, 35] // provisioned users
  };

  const simRows = [
    { emp:'Maryam K.', sim:'97155•••821', pkg:'10GB', status:'Active' },
    { emp:'Arjun S.',  sim:'97150•••243', pkg:'5GB',  status:'Expiring' },
    { emp:'Omar H.',   sim:'97152•••910', pkg:'20GB', status:'Hold' },
    { emp:'Lara V.',   sim:'97156•••112', pkg:'10GB', status:'Inactive' },
    { emp:'Ali Z.',    sim:'97158•••745', pkg:'15GB', status:'Active' }
  ];

  // ===== Helpers =====
  const badge = (s) => {
    switch (s) {
      case 'Active':    return 'success';
      case 'Expiring':  return 'warning';
      case 'Hold':      return 'secondary';
      case 'Inactive':  return 'dark';
      default:          return 'light';
    }
  };

  // ===== Render charts =====
  (function renderITInventory(){
    const el = document.querySelector('#chart_it_inventory');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type: 'bar', height: 300, toolbar: { show:false } },
      series: [{ name:'Devices', data: inventory.counts }],
      xaxis: { categories: inventory.labels },
      plotOptions: { bar:{ columnWidth:'45%' } },
      dataLabels: { enabled:false },
      tooltip:{ y:{ formatter:(v)=> v + ' units' } },
      legend:{ show:false }
    }).render();
  })();

  (function renderAccess(){
    const el = document.querySelector('#chart_access_roles');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type: 'bar', height: 300, toolbar: { show:false } },
      series: [{ name:'Provisioned Users', data: accessProvisioning.counts }],
      xaxis: { categories: accessProvisioning.labels },
      plotOptions: { bar:{ columnWidth:'45%' } },
      dataLabels: { enabled:false },
      tooltip:{ y:{ formatter:(v)=> v + ' users' } },
      legend:{ show:false }
    }).render();
  })();

  // ===== Render SIM table =====
  (function renderSIMTable(){
    const tbody = document.getElementById('sim-table-body');
    if (!tbody) return;
    tbody.innerHTML = simRows.map(r => `
      <tr>
        <td>${r.emp}</td>
        <td>${r.sim}</td>
        <td>${r.pkg}</td>
        <td><span class="badge badge-${badge(r.status)}">${r.status}</span></td>
      </tr>
    `).join('');
  })();

  // ===== Assign SIM (demo) =====
  document.getElementById('btn-assign-sim').addEventListener('click', () => {
    // Demo: push a new row (you can swap with a modal/form later)
    const newRow = { emp:'New Joiner', sim:'97159•••333', pkg:'10GB', status:'Active' };
    simRows.unshift(newRow);
    const tbody = document.getElementById('sim-table-body');
    tbody.insertAdjacentHTML('afterbegin', `
      <tr>
        <td>${newRow.emp}</td>
        <td>${newRow.sim}</td>
        <td>${newRow.pkg}</td>
        <td><span class="badge badge-${badge(newRow.status)}">${newRow.status}</span></td>
      </tr>
    `);
    alert('SIM assigned to New Joiner (demo)');
  });
</script>

<!-- =============================================================== -->





<!-- ================================================== -->
<div class="row">
  <!-- Deployment Pipeline -->
  <div class="col-lg-7 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Deployment Pipeline</div>
        <div class="small text-muted">Assigned → Driver Arranged → Deployed</div>
      </div>
      <div class="card-body"><div id="chart_deployment_pipeline"></div></div>
    </div>
  </div>

  <!-- Driver Dispatch (Today) -->
  <div class="col-lg-5 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">Driver Dispatch (Today)</div>
        <button id="optimize-route" class="btn btn-sm btn-outline-secondary">Optimize Route</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-sm mb-0">
            <thead><tr><th>Driver</th><th>Drop-off</th><th>Time</th><th>Status</th></tr></thead>
            <tbody id="driver-dispatch-body">
              <!-- filled by JS -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Live updates visible to Deployment</div>
    </div>
  </div>
</div>

<script>
  // ===== Dummy data =====
  // Pipeline counts per region (DXB/AUH/SHJ/RAK) across stages
  const pipelineData = {
    categories: ['Assigned', 'Driver Arranged', 'Deployed'],
    series: [
      { name: 'DXB', data: [18, 12, 10] },
      { name: 'AUH', data: [12, 9, 8] },
      { name: 'SHJ', data: [10, 7, 6] },
      { name: 'RAK', data: [ 8, 5, 3] }
    ]
  };

  // Driver dispatch list
  const driverDispatch = [
    { driver: 'Ali Z.',    drop: 'AUH – Client #CST0002', time: '14:30', status: 'En Route' },
    { driver: 'Lara V.',   drop: 'DXB – Client #CST0005', time: '15:10', status: 'Assigned' },
    { driver: 'Hassan R.', drop: 'RAK – Client #CST0008', time: '16:00', status: 'Completed' },
    { driver: 'Noor A.',   drop: 'SHJ – Client #CST0011', time: '16:20', status: 'Delayed' },
    { driver: 'Yusuf M.',  drop: 'DXB – Client #CST0009', time: '15:45', status: 'En Route' },
    { driver: 'Samir K.',  drop: 'AUH – Client #CST0013', time: '17:05', status: 'Assigned' }
  ];

  // ===== Render Pipeline Chart =====
  (function renderPipeline() {
    const el = document.querySelector('#chart_deployment_pipeline');
    if (!el) return;
    new ApexCharts(el, {
      chart: { type: 'bar', height: 320, stacked: true, toolbar: { show: false } },
      series: pipelineData.series,
      xaxis: { categories: pipelineData.categories },
      legend: { position: 'bottom' },
      plotOptions: { bar: { columnWidth: '45%' } },
      dataLabels: { enabled: false },
      tooltip: {
        y: { formatter: (val) => `${val} candidates` }
      }
    }).render();
  })();

  // ===== Render Driver Dispatch Table =====
  (function renderDispatchTable() {
    const tbody = document.getElementById('driver-dispatch-body');
    if (!tbody) return;

    const badgeFor = (status) => {
      switch (status) {
        case 'Assigned':   return 'primary';
        case 'En Route':   return 'info';
        case 'Completed':  return 'success';
        case 'Delayed':    return 'danger';
        default:           return 'secondary';
      }
    };

    tbody.innerHTML = driverDispatch.map(d => `
      <tr>
        <td>${d.driver}</td>
        <td>${d.drop}</td>
        <td>${d.time}</td>
        <td><span class="badge badge-${badgeFor(d.status)}">${d.status}</span></td>
      </tr>
    `).join('');
  })();

  // ===== "Optimize Route" (demo) =====
  document.getElementById('optimize-route').addEventListener('click', () => {
    // simple demo: show drivers sorted by earliest time
    const sorted = [...driverDispatch].sort((a,b) => a.time.localeCompare(b.time));
    const list = sorted.map(s => `${s.time} — ${s.driver} → ${s.drop}`).join('\n');
    alert('Suggested order:\n' + list);
  });
</script>

<!-- ========================================================= -->

<div class="row">
  <div class="col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header d-flex justify-content-between align-items-center">
        <div class="page-title">T&C Acknowledgments & Refund Window</div>
        <div><span class="badge badge-warning">Refunds in 10 working days</span></div>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table custom-table">
            <thead class="thead-light">
              <tr><th>Client</th><th>Emirates ID</th><th>Clause</th><th>Ack</th><th>Signed On</th><th>Refund Eligible Until</th><th class="text-right">Action</th></tr>
            </thead>
            <tbody>
              <tr>
                <td>Parker</td><td>784-1976-•••••••-1</td><td>No Further Demands</td>
                <td><span class="badge badge-success">Yes</span></td>
                <td>18/09/2025</td><td>02/10/2025</td>
                <td class="text-right"><button class="btn btn-sm btn-outline-info">View Contract</button></td>
              </tr>
              <!-- more -->
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer small text-muted">Legal flags shown to Admin & Finance</div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header"><div class="page-title">Recent Activity (Audit Log)</div></div>
      <div class="card-body">
        <ul class="list-unstyled mb-0">
          <li class="mb-2"><i class="far fa-clock mr-2"></i> 16:05 — Finance verified payment AED 2,000 for File RS-1023</li>
          <li class="mb-2"><i class="far fa-clock mr-2"></i> 15:40 — Admin switched Parker to “Outside Deployment”</li>
          <li class="mb-2"><i class="far fa-clock mr-2"></i> 15:12 — Marketing posted IG Reel “Warehouse Helpers”</li>
          <!-- more -->
        </ul>
      </div>
    </div>
  </div>
</div>