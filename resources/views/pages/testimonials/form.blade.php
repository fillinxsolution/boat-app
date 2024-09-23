<div class="row g-2">

    <div class="col-md-8">

        <div class="row g-2">

            <x-input name="name" col="6" :value="$testimonial->name ?? null" :required="true" />

            <x-input name="designation" col="6" :value="$testimonial->designation ?? null" :required="true" />


            <x-input  title="Rating"  name="stars" col="12" type="number" :value="$testimonial->designation ?? null" :required="true" />


            <x-input col="6" name="status" type="select" :required="true">
                <option value="Active" @selected(isset($testimonial->status) && $blog->status == 'Active')>Active</option>
                <option value="DeActive" @selected(isset($testimonial->status) && $blog->status == 'DeActive')>InActive</option>
            </x-input>

            <x-input col="6" name="is_featured" type="select" :required="true">
                <option value="Yes" @selected(isset($testimonial->is_featured) && $blog->is_featured == 'Yes')>Yes</option>
                <option value="No" @selected(isset($testimonial->is_featured) && $blog->is_featured == 'No')>No</option>
            </x-input>

            <x-input col="12" type="textarea" title="Comment" name="comment" :value="$blog->body ?? null" />

        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <x-input name="image" type="dropify" :defaultFile="$blog->image ?? null" dropifyHeight="202" />
        </div>
    </div>

</div>
