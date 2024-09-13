<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

                <div>
                    <button type="button"
                            class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button"
                            class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">
                        Main
                    </div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                @can('dashboard-view')
                <x-nav-item route="dashboard" icon="house" title="Dashboards"/>
                @endcan

                @can('users-list')
                <x-nav-item route="staff.index" active="staff.*" icon="users-three" title="Staff"/>
               @endcan

                {{--                @canany(['adminRoles-list', 'shopRoles-list'])--}}
                <x-nav-item active="roles.*" icon="user-focus" title="Roles" :submenu="true">
                    <x-nav-item route="roles.staff.index" active="roles.staff.*" title="Staff"/>

                </x-nav-item>
                {{--                @endcanany--}}
                <x-nav-item active="permissions.*" icon="lock" title="Permissions" :submenu="true">

                    <x-nav-item route="permissions.staff.index" active="permissions.staff.*" title="Staff"/>

                </x-nav-item>

                @canany(['suppliers-list' || 'captains-list'])
                    <x-nav-item active="users.*" icon="users-three" title="Users" :submenu="true">
                        @can('suppliers-list')
                            <x-nav-item route="users.suppliers.index" active="users.suppliers.*"
                                        title="Suppliers"/>
                        @endcan
                        @can('captains-list')
                            <x-nav-item route="users.captains.index" active="users.captains.*"
                                        title="Captains"/>
                        @endcan
                    </x-nav-item>
                @endcanany


                @canany(['serviceCategory-list'])
                <x-nav-item active="catalog.*" icon="notebook" title="Catalog" :submenu="true">
                    @can('serviceCategory-list')
                        <x-nav-item route="catalog.category.index" active="catalog.category.*"
                                    title="Category"/>
                    @endcan
                </x-nav-item>
                @endcanany

{{--                <x-nav-item active="pages.*" icon="notebook" title="Pages" :submenu="true">--}}
{{--                    <x-nav-item route="pages.aboutUs.index" active="pages.aboutUs.*"--}}
{{--                                title="About Us"/>--}}
{{--                </x-nav-item>--}}

                    <x-nav-item active="settings.*" icon="gear-six" title="Settings" :submenu="true">
                    <x-nav-item route="settings.admin" title="Admin"/>
                </x-nav-item>


            </ul>

        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
