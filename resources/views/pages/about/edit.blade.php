<x-app-layout title="Update About Us">

    <x-breadcrumb title="Update About Us" :back-button="route('pages.about-us.index')" />

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Update') }} About Us</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('pages.about-us.update', $about->id)">
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="old_img" value="{{ $about->image ?? '' }}">
                            @include('pages.about.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->


</x-app-layout>
