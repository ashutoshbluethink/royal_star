@extends('layouts.app')

@section('title', 'Running Projects by Vendor')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="row">
       {{-- LEFT TABLE --}}
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-tasks"></i> Running Projects by Vendor</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th class="text-center">#</th>
                                <th>Vendor Name</th>
                                <th>Technology</th>
                                <th class="text-center">Running Projects</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($runningProjects as $index => $project)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $project->vendor_name ?? 'Unknown Vendor' }}</td>
                                    <td>{{ $project->technology_name ?? 'N/A' }}</td>
                                    <td class="text-center">{{ $project->total_running }}</td>
                                    <td class="text-center">
                                        <button type="button" 
                                                class="btn btn-sm btn-info viewVendor" 
                                                data-id="{{ $project->vendor_id }}"
                                                data-name="{{ $project->vendor_name ?? 'Unknown Vendor' }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No running projects found</td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end">Total Running Projects:</th>
                                <th class="text-center">{{ $totalRunning }}</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

            {{-- RIGHT TABLE: Grouped by Vendor Name --}}
            @php
                $groupedVendors = [];
                foreach ($runningProjects as $proj) {
                    $name = $proj->vendor_name ?? 'Unknown';
                    $found = false;
                    foreach ($groupedVendors as $gName => $count) {
                        similar_text(strtolower($gName), strtolower($name), $percent);
                        if ($percent >= 70) {
                            $groupedVendors[$gName] += $proj->total_running;
                            $found = true;
                            break;
                        }
                    }
                    if (! $found) {
                        $groupedVendors[$name] = $proj->total_running;
                    }
                }
            @endphp

            <div class="col-md-6">
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0"><i class="fas fa-users"></i> Running Projects (Grouped by Vendor Name)</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Vendor Name (Grouped)</th>
                                    <th class="text-center">Total Running Projects</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; $groupedTotal = 0; @endphp
                                @foreach($groupedVendors as $name => $count)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td>{{ $name }}</td>
                                        <td class="text-center">{{ $count }}</td>
                                    </tr>
                                    @php $groupedTotal += $count; @endphp
                                @endforeach
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="2" class="text-end">Total Running Projects (Grouped):</th>
                                    <th class="text-center">{{ $groupedTotal }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div> {{-- end row --}}
    </div>
</div>

<!-- Vendor Details Modal -->
<!-- Vendor Details Modal -->
<div class="modal fade" id="vendorModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Vendor Projects</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-sm">
          <thead>
            <tr>
              <th>ID</th>
              <th>Company</th>
              <th>Technology</th>
              <th>Created By</th>
              <th>Interview By</th>
              <th>Joining Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="vendorProjectsTableBody">
            <tr><td colspan="6" class="text-center">Click a vendor to view running projects</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".viewVendor").forEach(function (btn) {
        btn.addEventListener("click", function () {
            let vendorId = this.getAttribute("data-id");
            let vendorName = this.getAttribute("data-name");

            // Update modal title
            document.querySelector("#vendorModal .modal-title").innerText = "Vendor Projects - " + vendorName;

            let tbody = document.getElementById("vendorProjectsTableBody");
            tbody.innerHTML = "<tr><td colspan='6' class='text-center'>Loading...</td></tr>";

            // Show modal (Bootstrap 5 way)
            let vendorModal = new bootstrap.Modal(document.getElementById("vendorModal"));
            vendorModal.show();

            // Fetch vendor projects
            fetch(`/performance/vendors/${vendorId}`)
                .then(res => res.json())
                .then(data => {
                    if (!data || data.length === 0) {
                        tbody.innerHTML = "<tr><td colspan='6' class='text-center text-muted'>No running projects</td></tr>";
                        return;
                    }

                    let rows = "";
                    data.forEach(project => {
                        rows += `
                            <tr>
                                <td>${project.id}</td>
                                <td>${project.company?.company_name ?? '-'}</td>
                                <td>${project.technology?.technology_name ?? '-'}</td>
                                <td>${project.created_user_lead?.firstname ?? '-'}</td>
                                <td>${project.interviewer_lead?.firstname ?? '-'}</td>
                                <td>${project.joining_date ?? '-'}</td>
                                <td class="text-center">
                                    <a href="/leads/${project.id}" 
                                       target="_blank" 
                                       class="btn btn-sm btn-outline-primary">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                    });
                    tbody.innerHTML = rows;
                })
                .catch(() => {
                    tbody.innerHTML = "<tr><td colspan='6' class='text-center text-danger'>Error fetching data</td></tr>";
                });
        });
    });
});
</script>


@endsection
