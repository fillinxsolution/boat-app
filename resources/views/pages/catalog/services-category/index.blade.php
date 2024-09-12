<x-app-layout title="Service Category">

    <x-breadcrumb title="Service Category">
        @can('serviceCategory-create')
        <a href="{{ route('catalog.category.create') }}"
           class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
            <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                <i class="ph-plus"></i>
            </span>
            Create New
        </a>
        @endcan
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">List</h5>
                    </div>
                    <x-datatable :url="route('catalog.category.list')" :index="['DT_RowIndex', 'name', 'status', 'action']">
                        <th>No</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </x-datatable>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

    <div id="result"></div>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(document).on('click', '.edit-btn', function() {
                    let id = $(this).data('id');
                    let url = "{{ route('catalog.category.index') }}";
                    // Perform Ajax request
                    $.ajax({
                        type: 'GET',
                        url: `${url}/${id}/edit`,
                        success: function(data, status) {
                            $('#result').html(data);
                            $('#modal_update').modal('show');
                            // Handle the response
                        },
                        error: function(error) {
                            console.log(error);
                            // Handle errors
                        }
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
