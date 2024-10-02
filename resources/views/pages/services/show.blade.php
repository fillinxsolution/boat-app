<x-app-layout title="Service">

    <x-breadcrumb :title="'Service Details (' . $service->name . ')'" :backButton="route('users.suppliers.index')">
    </x-breadcrumb>

    <!-- Content area -->
    <div class="content">
        <div class="row g-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Service Info.</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-7 col-12">
                                    <div class="row mb-0">
                                        <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Service Name:
                                        </div>
                                        <div class="col-sm-8">{{ $service->name ?? 'N/A' }}</div>

                                        <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Service
                                            Category:
                                        </div>
                                        <div class="col-sm-8">{{ $service?->category?->name ?? 'N/A' }}</div>

                                        <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Supplier Name:
                                        </div>
                                        <div class="col-sm-8">{{ isset($service?->supplier?->user) ? $service?->supplier?->user?->name : 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="col-xl-5 col-12">
                                    <div class="row mb-0">
                                        <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Status:</div>
                                        <div class="col-sm-8">{{ $service->status ?? 'N/A' }}</div>

                                        <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Description:
                                        </div>
                                        <div class="col-sm-8">{{  $service->description ?? 'N/A' }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
