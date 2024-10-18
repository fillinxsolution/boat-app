<x-form :route="route('settings.store')">
    <input type="hidden" name="type" value="admin">
    <div class="row g-2">
        <x-input col="6" title="App Name" name="values[admin_app_name]" :value="adminSettings('admin_app_name')" />

        <x-input col="6" title="Email" name="values[admin_app_email]" :value="adminSettings('admin_app_email')" />

        <x-input col="12" title="Home Page Video" type="file" name="values[home_video_link]"
                 :value="adminSettings('home_video_link')" />

        <x-input col="4" title="Logo Black" name="values[admin_app_logo_black]" type="dropify" :defaultFile="asset('images/settings/'.adminSettings('admin_app_logo_black')) ?? null"
            dropifyHeight="205" />
        <x-input col="4" title="Logo White" name="values[admin_app_logo_white]" type="dropify" :defaultFile="asset('images/settings/'.adminSettings('admin_app_logo_white')) ?? null"
            dropifyHeight="205" />

        <x-input col="4" title="Favicon" name="values[admin_app_favicon]" type="dropify" :defaultFile="asset('images/settings/'.adminSettings('admin_app_favicon')) ?? null"
            dropifyHeight="205" />

        <x-input col="12" title="Contact" name="values[admin_app_contact]" :value="adminSettings('admin_app_contact')" />

        <x-input col="12" title="Address" type="textarea" name="values[admin_app_address]" :value="adminSettings('admin_app_address')" />

        <x-input col="12" title="Footer Text" type="textarea" name="values[admin_footer_text]"
            :value="adminSettings('admin_footer_text')" />



    </div>
</x-form>
