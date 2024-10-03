<x-app-layout title="Update Plans">

    <x-breadcrumb title="Update Plan" :back-button="route('plans.index')" />


    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Update') }} Plan</h5>
                    </div>
                    <div class="card-body">
                        <x-form :route="route('plans.update', $plan->id)">
                            {{ method_field('PATCH') }}
                            <input type="hidden" name="old_img" value="{{ $plan->image ?? '' }}">
                            @include('pages.plan.form')
                        </x-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->


</x-app-layout>
