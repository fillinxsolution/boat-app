<x-app-layout title="Shop">

    <x-breadcrumb :title="'Supplier Details (' . $captain->name . ')'" :backButton="route('users.captains.index')">
    </x-breadcrumb>


    <!-- Content area -->
    <div class="content">
        <div class="row g-2">

            <div class="col-md-3">

                <!-- Navigation -->
                <div class="card">

                    <div class="text-center">
                        <img class="img-fluid rounded-circle mt-3 mb-2"
                            src="{{ $captain->image ?? URL::to('/assets/images/profile/default.png') }}"
                            width="120" height="120" alt="">
                        <h6 class="mb-0">{{ $captain->name }}</h6>
                        <span class="text-muted">{{ $captain->email }}</span>
                        <div class="nav-item-divider"></div>
                    </div>



                    <ul class="nav nav-sidebar" role="tablist">
                        <li class="nav-item-divider"></li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('users.suppliers.show', $captain->id) }}"
                                class="nav-link {{ Route::is('users.suppliers.show') ? 'active' : '' }}">
                                <i class="ph-info me-2"></i>
                                Info
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a href="{{ route('users.suppliers.services', $captain->id) }}"
                                class="nav-link {{ Route::is('users.suppliers.services') ? 'active' : '' }}">
                                <i class="ph-currency-circle-dollar me-2"></i>
                                Services
                            </a>
                        </li>




{{--                        <li class="nav-item" role="presentation">--}}
{{--                            <a href="{{ route('shops.orders', $shop->id) }}"--}}
{{--                                class="nav-link {{ Route::is('shops.orders') ? 'active' : '' }}">--}}
{{--                                <i class="ph-shopping-cart me-2"></i>--}}
{{--                                Orders--}}
{{--                            </a>--}}
{{--                        </li>--}}
                    </ul>
                </div>
                <!-- /navigation -->

            </div>

            <div class="col-md-9">
                <!-- Right content -->
                @if (Route::is('users.suppliers.services', $captain->id))
                    @include('pages.users.suppliers.details.services')
{{--                @elseif (Route::is('shops.orders', $supplier->id))--}}
{{--                    @include('pages.shop.details.orders')--}}
                @else
                    @include('pages.users.suppliers.details.info')
                @endif
                <!-- /right content -->
            </div>



        </div>
    </div>
    <!-- /content area -->

</x-app-layout>
