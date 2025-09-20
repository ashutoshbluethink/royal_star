<div class="row mt-4">
    <div class="col-12">
        <h5 class="text-primary font-weight-bold">Closed Leads by Quarter ({{ $currentYear }})</h5>
        <div class="row">
            @foreach($closedLeadsQuarterCounts as $quarter => $count)
                @php $qNum = (int) filter_var($quarter, FILTER_SANITIZE_NUMBER_INT); @endphp
                <div class="col-md-3 mb-3">
                    <div 
                        class="card shadow-sm p-3 text-center quarter-card" 
                        style="cursor:pointer;" 
                        data-quarter="{{ $qNum }}"
                        data-year="{{ $currentYear }}"
                    >
                        <h6 class="font-weight-bold">{{ strtoupper($quarter) }}</h6>
                        <span class="badge badge-success" style="font-size: 1.2em;">{{ $count }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Modal --}}
<div class="modal fade" id="closedLeadsModal" tabindex="-1" role="dialog" aria-labelledby="closedLeadsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document"> <!-- ⬅️ changed from modal-lg to modal-xl -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Closed Leads - Q<span id="modalQuarter"></span></h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comp. Name</th>
                            <th>Vendor Name</th>
                            <th>Technology</th>
                            <th>Joining Date</th>
                            <th>Close Date</th>
                            <th>Created By</th>
                            <th>Duration</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="leadsTableBody">
                        <tr><td colspan="9" class="text-center">Click a quarter to view leads</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".quarter-card").forEach(function (card) {
        card.addEventListener("click", function () {
            let quarter = this.getAttribute("data-quarter");
            let year = this.getAttribute("data-year");

            document.getElementById("modalQuarter").innerText = quarter;
            let tbody = document.getElementById("leadsTableBody");
            tbody.innerHTML = "<tr><td colspan='9' class='text-center'>Loading...</td></tr>";

            fetch(`/performance/closed-leads/${year}/${quarter}`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        tbody.innerHTML = "<tr><td colspan='9' class='text-center'>No leads found</td></tr>";
                        return;
                    }
                    let rows = "";
                    data.forEach(lead => {
                        // ---- Parse Joining Date (DD-MM-YYYY string) ----
                        let joiningDate = null;
                        if (lead.joining_date) {
                            let parts = lead.joining_date.split("-");
                            if (parts.length === 3) {
                                // Expecting DD-MM-YYYY
                                joiningDate = new Date(parts[2], parts[1] - 1, parts[0]);
                            }
                        }

                        // ---- Parse Close Date (YYYY-MM-DD from DB) ----
                        let closeDate = lead.close_date ? new Date(lead.close_date) : null;

                        // ---- Calculate Duration ----
                        let durationText = "-";
                        if (joiningDate && closeDate && !isNaN(joiningDate) && !isNaN(closeDate)) {
                            let diffMs = closeDate - joiningDate;
                            if (diffMs >= 0) {
                                let diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
                                let years = Math.floor(diffDays / 365);
                                let months = Math.floor((diffDays % 365) / 30);
                                let days = (diffDays % 365) % 30;

                                durationText = 
                                    (years > 0 ? years + "y " : "") + 
                                    (months > 0 ? months + "m " : "") + 
                                    days + "d";
                            }
                        }

                        rows += `
                            <tr>
                                <td>${lead.id}</td>
                                <td>${lead.company?.company_name ?? '-'}</td>
                                <td>${lead.vendor?.name ?? '-'}</td>
                                <td>${lead.technology?.technology_name ?? '-'}</td>
                                <td>${lead.joining_date ?? '-'}</td>
                                <td>${lead.close_date ?? '-'}</td>
                                <td>${lead.created_user_lead?.firstname ?? '-'}</td>
                                <td>${durationText}</td>
                                <td class="text-center">
                                    <a href="/leads/${lead.id}" 
                                    class="btn btn-sm btn-outline-primary" 
                                    title="View Lead" 
                                    target="_blank" 
                                    rel="noopener noreferrer">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>

                            </tr>
                        `;
                    });
                    tbody.innerHTML = rows;
                })
                .catch(() => {
                    tbody.innerHTML = "<tr><td colspan='9' class='text-center text-danger'>Error fetching data</td></tr>";
                });

            $('#closedLeadsModal').modal('show');
        });
    });
});
</script>
