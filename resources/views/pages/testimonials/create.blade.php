<x-app-layout title="Create Testimonials">

    <x-breadcrumb title="Create Testimonials" :back-button="route('pages.testimonials.index')" />


    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Create Testimonials') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('pages.testimonials.store')">
                            @include('pages.testimonials.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
</x-app-layout>

