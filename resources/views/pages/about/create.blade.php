<x-app-layout title="Create About Us">

    <x-breadcrumb title="Create About Us" :back-button="route('pages.about-us.index')" />


    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Create About Us') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('pages.about-us.store')">
                            @include('pages.about.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
</x-app-layout>
