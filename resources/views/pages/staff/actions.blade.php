{{--@canany(['users-edit','users-delete'])--}}
<x-actions
    :editRoute="route('staff.edit', $row->id)"
    :deleteRoute="route('staff.destroy', $row->id)"
/>
{{--@endcanany--}}

