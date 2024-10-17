<x-app-layout title="Captains">

    <x-breadcrumb title="Captains">
{{--        @can('serviceCategory-create')--}}
{{--        <a href="{{ route('users.suppliers.create') }}"--}}
{{--           class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">--}}
{{--            <span class="btn-labeled-icon bg-primary text-white rounded-pill">--}}
{{--                <i class="ph-plus"></i>--}}
{{--            </span>--}}
{{--            Create New--}}
{{--        </a>--}}
{{--        @endcan--}}
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List</h5>
                    </div>
                    <x-datatable :url="route('users.captains.list')" :index="['DT_RowIndex', 'name', 'status', 'action']">
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

    <div id="result"></div>
    
</x-app-layout>
