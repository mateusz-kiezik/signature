<a href="{{ route('users.show', $id) }}" data-bs-toggle="tooltip" title="Details"
   class="btn btn-link btn-sm">
    <img src="{{ asset('icons/account-details.svg') }}" class="details-icon">
</a>
<a href="{{ route('users.edit', $id) }}" data-bs-toggle="tooltip" title="Edit" class="btn btn-link btn-sm">
    <img src="{{ asset('icons/account-edit.svg') }}" class="edit-icon">
</a>
@if($status)
    <button data-bs-toggle="tooltip" title="Disable" class="btn btn-link btn-sm" onclick="disableUser({{ $id }})">
        <img src="{{ asset('icons/account-lock.svg') }}" class="disable-icon">
    </button>
@else
    <button data-bs-toggle="tooltip" title="Enable" class="btn btn-link btn-sm" onclick="enableUser({{ $id }})">
        <img src="{{ asset('icons/account-lock-open.svg') }}" class="enable-icon">
    </button>
@endif
<button data-bs-toggle="tooltip" title="Delete" class="btn btn-link btn-sm" onclick="deleteUser({{ $id }})">
    <img src="{{ asset('icons/trash-can.svg') }}" class="delete-icon">
</button>
