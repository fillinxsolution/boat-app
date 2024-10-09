<x-app-layout title="About Us">

    <x-breadcrumb title="About Us Management">
{{--        @can('plans-create')--}}
        @if(empty($about))
        <a href="{{ route('pages.about-us.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </a>
        @endif
{{--        @endcan--}}
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">About Us</h5>
                    </div>
                    <x-datatable :url="route('pages.about-us.list')" :index="[
                        'DT_RowIndex',
                        'background_image',
                        'title',
                        'action',
                     ]">
                        <th>No</th>
                        <th>Background Image</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
