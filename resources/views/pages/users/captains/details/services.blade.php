<div class="row">

    @if (!$services)
        <div class="col-md-12">
            <div class="alert alert-warning">
                <span class="fw-semibold">Warning!</span> {{ $supplier->name }}, Did not Act As A supplier.
                <i class="ph-warning-circle float-end ms-2"></i>
            </div>
        </div>
    @endif


    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Services List</h5>
            </div>
            <x-datatable :url="route('users.suppliers.services', $supplier->id)" :index="['DT_RowIndex', 'name', 'description', 'status']">
                <th>No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
            </x-datatable>
        </div>
    </div>

</div>
