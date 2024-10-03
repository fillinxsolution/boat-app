<x-app-layout title="Plans">

    <x-breadcrumb title="Plans Management">
{{--        @can('plans-create')--}}
        <a href="{{ route('plans.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </a>
{{--        @endcan--}}
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Plans List</h5>
                    </div>
                    <x-datatable :url="route('plans.list')" :index="[
                        'DT_RowIndex',
                        'image',
                        'title',
                        'monthly_charges',
                        'annual_charges',
                        'default',
                        'status',
                        'is_popular',
                        'action',
                    ]">
                        <th>No</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Monthly Charges</th>
                        <th>Annual Charges</th>
                        <th>Default</th>
                        <th>Status</th>
                        <th>Popular</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
