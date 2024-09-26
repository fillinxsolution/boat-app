<x-actions
    :editRoute="route('pages.testimonials.edit', $row->id)"
    :deleteRoute="route('pages.testimonials.destroy', $row->id)"
>
</x-actions>
