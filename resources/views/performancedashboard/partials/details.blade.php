<div class="p-3">
    <h5 class="mb-3">{{ $vendor->name }}</h5>
    <p><strong>Technology:</strong> {{ $vendor->technology->technology_name ?? 'N/A' }}</p>

    <h6 class="mt-3">Running Projects:</h6>
    <ul class="list-group">
        @forelse($vendor->projects as $project)
            <li class="list-group-item">
                {{ $project->project_name }} 
                <span class="badge bg-success">Running</span>
            </li>
        @empty
            <li class="list-group-item text-muted">No running projects found</li>
        @endforelse
    </ul>
</div>
