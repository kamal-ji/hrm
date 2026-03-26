<a href="javascript:void(0);" data-bs-toggle="dropdown">
    <i class="isax isax-more"></i>
</a>
<ul class="dropdown-menu">
    <li>
        <a href="{{ route('attendance-template.edit', $template->id) }}" class="dropdown-item d-flex align-items-center"><i class="isax isax-edit me-2"></i>Edit</a>
    </li>
    <li>
        <a href="{{ route('attendance-template.destroy', $template->id) }}" class="dropdown-item d-flex align-items-center"><i class="isax isax-trash me-2"></i>Delete</a>
    </li>
</ul>