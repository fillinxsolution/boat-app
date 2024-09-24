<div class="row g-2">

    <div class="col-md-8">

        <div class="row g-2">

            <x-input name="name" :value="$category->name ?? null" :required="true" />

            <x-input col="6" title="Category" name="parent_id" type="select" >
                @foreach ($parentCategories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ isset($category) && $cat->id == $category->parent_id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </x-input>

            <x-input col="6" name="status" type="select" :required="true">
                <option value="1" @selected(isset($category->status) && $category->status == 1)>Active</option>
                <option value="0" @selected(isset($category->status) && $category->status == 0)>InActive</option>
            </x-input>

            <x-input col="6" name="is_popular" type="select" :required="true">
                <option value="Yes" @selected(isset($category->is_popular) && $category->is_popular == 'Yes')>Yes</option>
                <option value="No" @selected(isset($category->is_popular) && $category->is_popular == 'No')>No</option>
            </x-input>



            <x-input type="textarea" name="short_description" :value="$category->short_description ?? null" />

        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <x-input name="image" type="dropify" :defaultFile="$category->image ?? null" dropifyHeight="202" />
        </div>
    </div>

</div>


