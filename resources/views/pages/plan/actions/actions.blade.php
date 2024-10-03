
{{--@canany(['plans-edit','plans-delete'])--}}
<x-actions
    :editRoute="route('plans.edit', $row->id)"
    :deleteRoute="route('plans.destroy', $row->id)"
/>
{{--@endcanany--}}
