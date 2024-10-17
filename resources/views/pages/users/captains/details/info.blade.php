<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">General Info.</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7 col-12">
                        <div class="row mb-0">
                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">User Name:</div>
                            <div class="col-sm-8">{{ $supplier->name ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">User Email:</div>
                            <div class="col-sm-8">{{ $supplier->email ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Login Facebook:</div>
                            <div
                                class="col-sm-8">{{ isset($supplier->login_with_facebook) ? $supplier->login_with_facebook : 'N/A' }}</div>


                        </div>
                    </div>
                    <div class="col-xl-5 col-12">
                        <div class="row mb-0">
                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Is Admin:</div>
                            <div class="col-sm-8">{{ $supplier->phone ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Login Google:</div>
                            <div
                                class="col-sm-8">{{ isset($supplier->login_with_google) ? $supplier->login_with_google : 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Status:</div>
                            <div class="col-sm-8">{{ $supplier->is_active ?? 'N/A' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Supplier User Info.</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-7 col-12">
                        <div class="row">
                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Company Name:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->company_name ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Director Name:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->director_name ?? 'N/A' }}</div>


                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Sector:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->sector ?? 'N/A' }}</div>

                        </div>
                    </div>
                    <div class="col-xl-5 col-12">
                        <div class="row">
                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Address:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->address ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Vat Number:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->vat_number ?? 'N/A' }}</div>

                            <div class="col-sm-4 mb-3 text-nowrap fw-semibold text-heading">Status:</div>
                            <div class="col-sm-8">{{ $supplier->supplier->status ?? 'N/A' }}</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Supplier Documents.</h5>
            </div>
            <div class="card-body">
                <x-form :route="route('users.suppliers.change',$supplier->id)">
                    <div class="row">
                        <div class="col-md-6">
                            <x-input name="status" type="select" :required="true">
                                <option
                                    value="Pending" @selected(isset($supplier->supplier->status) && $supplier->supplier->status == 'Pending')>
                                    Pending
                                </option>
                                <option
                                    value="Approved" @selected(isset($supplier->supplier->status) && $supplier->supplier->status == 'Approved')>
                                    Approved
                                </option>
                                <option
                                    value="Rejected" @selected(isset($supplier->supplier->status) && $supplier->supplier->status == 'Rejected')>
                                    Rejected
                                </option>

                            </x-input>
                        </div>
                        <div class="col-md-6">
                            <x-input name="reason" :value="$supplier->supplier->reason ?? null" :required="true"/>
                        </div>
                    </div>
                </x-form>

                <div class="row">
                    <div class="col-md-4">
                        <h6 class="fw-semibold m-0">Liability Insurance</h6>
                        <div class="card">
                            <div class="card-img-actions mx-1 mt-1">
                                {{--                            <img class="card-img img-fluid" src=""--}}
                                {{--                                alt="">--}}
                                @if($supplier->liability_insurance)
                                    <iframe src="{{$supplier->liability_insurance}}" frameborder="0"></iframe>
                                @else
                                    <h6 class="fw-semibold m-0">No File Upload</h6>
                                @endif
                            </div>

                        </div>

                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-semibold m-0">Company Registry</h6>
                        <div class="card">
                            <div class="card-img-actions mx-1 mt-1">
                                {{--                            <img class="card-img img-fluid" src=""--}}
                                {{--                                alt="">--}}
                                @if($supplier->company_registry)
                                    <iframe src="{{$supplier->company_registry}}" frameborder="0"></iframe>
                                @else
                                    <h6 class="fw-semibold m-0">No File Upload</h6>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col-md-4">
                        <h6 class="fw-semibold m-0">Banner Image</h6>
                        <div class="card">
                            <div class="card-img-actions mx-1 mt-1">
                                @if($supplier->banner_image)
                                    <img class="card-img img-fluid" src="{{$supplier->banner_image}}"
                                         alt="">
                                @else
                                    <h6 class="fw-semibold m-0">No Image Upload</h6>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>
