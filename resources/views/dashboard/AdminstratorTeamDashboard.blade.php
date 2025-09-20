<!--
    |--------------------------------------------------------------------------
    | Royal Star • Admin / Super User Dashboard
    |--------------------------------------------------------------------------
-->

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

<div class="row">
  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Leads by Source</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="chart1"></div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Agent Performance</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="chart2"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-12 col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Upcoming Activities</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Create Task</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Filter</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Calendar View</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body dashboard-calendar">
        <div id="calendar" class="overflow-hidden"></div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-12 col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Total Members</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body d-flex align-items-center justify-content-center overflow-hidden">
        <div id="chart3"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 col-md-12 col-12 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Revenue Monthwise</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div id="chart4"></div>
      </div>
    </div>
  </div>

  <div class="col-lg-6 d-flex">
    <div class="card flex-fill">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-auto">
            <div class="page-title">Deals List</div>
          </div>
          <div class="col text-right">
            <div class="mt-sm-0 mt-2">
              <button class="btn btn-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Export</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Refresh</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Settings</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive">
              <table class="table custom-table">
                <thead class="thead-light">
                  <tr>
                    <th>Deal</th>
                    <th>Stage</th>
                    <th>Owner</th>
                    <th>Region</th>
                    <th>Amount</th>
                    <th>Close Date</th>
                    <th class="text-right">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-green">R</a> Renewal – Alpha</td>
                    <td>Negotiation</td>
                    <td>Priya N.</td>
                    <td>DXB</td>
                    <td>AED 80,000</td>
                    <td>20/10/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-purple">N</a> New – Beta</td>
                    <td>Proposal</td>
                    <td>Arjun S.</td>
                    <td>AUH</td>
                    <td>AED 45,000</td>
                    <td>02/11/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-dark">U</a> Upsell – Gamma</td>
                    <td>Qualified</td>
                    <td>Maryam K.</td>
                    <td>SHJ</td>
                    <td>AED 30,000</td>
                    <td>12/11/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-green">R</a> Renewal – Delta</td>
                    <td>Contract Sent</td>
                    <td>Omar H.</td>
                    <td>DXB</td>
                    <td>AED 60,000</td>
                    <td>20/10/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-purple">N</a> New – Epsilon</td>
                    <td>Discovery</td>
                    <td>Sameer T.</td>
                    <td>AUH</td>
                    <td>AED 25,000</td>
                    <td>28/10/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                      <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                        <i class="far fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="deal-detail.html" class="avatar bg-dark">U</a> Upsell – Zeta</td>
                    <td>Qualified</td>
                    <td>Lara V.</td>
                    <td>RAK</td>
                    <td>AED 18,500</td>
                    <td>20/10/2025</td>
                    <td class="text-right">
                      <a href="edit-deal.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
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

<!-- All Leads -->
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <div class="row align-items-center">
          <div class="col-sm-6">
            <div class="page-title">All Leads</div>
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
        <div class="table-responsive">
          <table class="table custom-table">
            <thead class="thead-light">
              <tr>
                <th>Name</th>
                <th>Lead ID</th>
                <th>Source</th>
                <th>Owner</th>
                <th>Mobile</th>
                <th>Created On</th>
                <th class="text-right">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <h2>
                    <a href="profile.html" class="avatar text-white"><img src="assets/img/profile/img-1.jpg" alt=""></a>
                    <a href="profile.html">Parker <span></span></a>
                  </h2>
                </td>
                <td>LD-0001</td>
                <td>Website</td>
                <td>Priya N.</td>
                <td>+971-55-123-4567</td>
                <td>20/09/2025</td>
                <td class="text-right">
                  <a href="edit-lead.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                  <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>

              <tr>
                <td>
                  <h2>
                    <a href="profile.html" class="avatar text-white"><img src="assets/img/profile/img-2.jpg" alt=""></a>
                    <a href="profile.html">Smith <span></span></a>
                  </h2>
                </td>
                <td>LD-0002</td>
                <td>Referral</td>
                <td>Arjun S.</td>
                <td>+971-55-987-6543</td>
                <td>20/09/2025</td>
                <td class="text-right">
                  <a href="edit-lead.html" class="btn btn-primary btn-sm mb-1"><i class="far fa-edit"></i></a>
                  <button type="button" data-toggle="modal" data-target="#delete_employee" class="btn btn-danger btn-sm mb-1">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

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
