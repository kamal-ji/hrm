<div class="dropdown">
    <button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('attendance-geofence.edit', $geofence->id) }}">Edit</a></li>
        <li><a class="dropdown-item" href="{{ route('attendance-geofence.destroy', $geofence->id) }}">Delete</a></li>
    </ul>
</div>