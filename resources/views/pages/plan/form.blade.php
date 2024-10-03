<div class="row g-2">

    <div class="col-md-8">

        <div class="row g-2">

            <div class="col-md-12">
                <div class="form-check form-check-inline form-switch">
                    <input type="checkbox" class="form-check-input" id="sc_li_c" name="is_popular" value="1" @checked($plan->is_popular ?? null)>
                    <label class="form-check-label" for="sc_li_c">Popular</label>
                </div>
            </div>

            <x-input col="12" name="title" :value="$plan->title ?? null" :required="true" />

            <x-input col="6" name="monthly_charges" type="number" :value="$plan->monthly_charges ?? null" :required="true" />

            <x-input col="6" name="annual_charges" type="number" :value="$plan->annual_charges ?? null" :required="true" />

            <x-input col="6" name="status" type="select" :required="true">
                <option value="1" @selected(isset($plan->status) && $plan->status == 1)>Active</option>
                <option value="0" @selected(isset($plan->status) && $plan->status == 0)>InActive</option>

            </x-input>


        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <x-input name="image" type="dropify" :defaultFile="$plan->image ?? null" dropifyHeight="205" />
        </div>
    </div>

    <x-input col="6" type="textarea" name="description" :value="$plan->description ?? null" />
    <x-input col="6" type="textarea" name="bullets" title="Plan Bullets: Place SemiColumn (;) after the sentence." :value="$plan->bullets ?? null"/>

</div>
