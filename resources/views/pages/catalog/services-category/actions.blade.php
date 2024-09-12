<x-actions
    :editRoute="route('catalog.category.edit', $row->id)" canEdit="serviceCategory-edit"
    :deleteRoute="route('catalog.category.destroy', $row->id)" canDelete="serviceCategory-delete"
>
</x-actions>
