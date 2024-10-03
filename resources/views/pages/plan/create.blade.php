<x-app-layout title="Create Plans">

    <x-breadcrumb title="Create Plan" :back-button="route('plans.index')" />


    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Create Plan') }}</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('plans.store')">
                            @include('pages.plan.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->
</x-app-layout>
