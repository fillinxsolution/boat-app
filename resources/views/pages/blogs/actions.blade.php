<x-actions
    :editRoute="route('pages.blogs.edit', $row->id)"
    :deleteRoute="route('pages.blogs.destroy', $row->id)"
>
</x-actions>
