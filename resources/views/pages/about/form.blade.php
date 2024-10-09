<div class="row g-2">

    <div class="col-md-8">

        <div class="row g-2">

            <x-input col="12" name="title" :value="$about->title ?? null" :required="true" />

            <x-input col="12" name="short_description"  :value="$about->short_description ?? null" :required="true" />

            <x-input col="6" name="for_captain_video" title="Captain Video Url"  :value="$about->for_captain_video ?? null" :required="true" />
            <x-input col="6" name="for_supplier_video" title="Supplier Video Url" :value="$about->for_supplier_video ?? null" :required="true" />

        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <x-input name="background_image" type="dropify" :defaultFile="$about->background_image ?? null" dropifyHeight="205" />
        </div>
    </div>

    <x-input col="6" type="textarea" name="for_supplier" title="Supplier Captions" :value="$about->for_supplier ?? null" :required="true" />
    <x-input col="6" type="textarea" name="for_captains" title="Captain Captions" :value="$about->for_captains ?? null" :required="true"/>

    <x-input col="12" type="textarea" name="our_aim" title="Our Aim" :value="$about->our_aim ?? null"  :required="true"/>

</div>
