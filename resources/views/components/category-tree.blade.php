@foreach ($categories as $key=>$category)
    <tr data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}" class="clickable">
        <td style="padding-left: {{ $level * 20 }}px;">{{ $key+1 }}</td>
        <td>{{ $category->name }}</td>
        <td>
            <x-actions
                :editRoute="route('catalog.category.edit', $category->id)"
                :deleteRoute="route('catalog.category.destroy', $category->id)"
            >
            </x-actions>

        </td>
    </tr>

    @if ($category->children->isNotEmpty())
        <tr>
            <td colspan="3">
                <div id="collapse{{ $category->id }}" class="collapse">
                    <table class="table table-striped ps-4 border ms-auto" style="width: 95%">
                        <tbody>
                        <x-category-tree :categories="$category->children" :level="$level + 1" />
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
    @endif
@endforeach
