<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="/adminlte/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{config('constants.ADMIN_TITLE')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{--<img src="/adminlte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">--}}
                <img class="img-circle elevation-2 "
                     src="{{ storage_url(data_get(auth()->user(), 'userProfile.img_link', ''))}}"
                     onerror="this.onerror=null;this.src='{{default_avatar()}}';"
                     alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.profile') }}" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{--<div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>--}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--<li class="nav-item menu-open">--}}
                @if(false)
                <li class="nav-item">
                        <a href="#" class="nav-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}" class="nav-link @if(Route::currentRouteName() == 'admin.dashboard') active @endif">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v1</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.db-version', ['version' => 'v2']) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.db-version', ['version' => 'v3']) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Dashboard v3</p>
                                </a>
                            </li>
                        </ul>
                </li>
                @endif
                {{--<li class="nav-header">EXAMPLES</li>--}}

                @can('customer-list')
                @include('inc.admin.menu-item', ['routeName' => 'admin.customer', 'title' => 'Quản lý khách hàng', 'icon' => 'fas fa-users'])
                @endcan


                {{--<li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon far fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li>--}}
                <!-- report menu -->
                <li class="nav-item ">
                    @canany(['winner-list','gift-report','statement-report-list','report-list'])
                    @include('inc.admin.menu-item-parent', [
                        'childRouteNames' => ['winners.index', 'admin.gifts.report', 'reports.index', 'statement-reports.index'],
                        'title' => 'Báo cáo',
                         'icon' => 'fas fa-image'
                    ])
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('winner-list')
                        @include('inc.admin.menu-item', ['routeName' => 'winners.index', 'title' => 'Báo cáo trúng thưởng', 'icon' => 'far fa-circle'])
                        @endcan

                        @can('gift-report')
                        @include('inc.admin.menu-item', ['routeName' => 'admin.gifts.report', 'title' => 'Báo cáo tồn kho', 'icon' => 'far fa-circle'])
                        @endcan

                        @can('report-list')
                        @include('inc.admin.menu-item', ['routeName' => 'reports.index', 'title' => 'Báo cáo Lượt quay', 'icon' => 'far fa-circle'])
                        @endcan


                        {{--@can('statement-report-list')
                        @include('inc.admin.menu-item', ['routeName' => 'statement-reports.index', 'title' => 'Nhiệm vụ và lượt quay', 'icon' => 'far fa-circle'])
                        @endcan--}}

                    </ul>
                </li>

                @can('prob-config-list')
                @include('inc.admin.menu-item', ['routeName' => 'admin.prob-configs.index', 'title' => 'Quản trị trúng thưởng', 'icon' => 'fas fa-tools'])
                @endcan

                <li class="nav-item ">
                    @canany(['gift-add','gifts-config-list'])
                        @include('inc.admin.menu-item-parent', [
                            'childRouteNames' => ['admin.gifts.addView', 'admin.gifts.config-list'],
                            'title' => 'Quản lý quà tặng',
                             'icon' => 'fas fa-gift'
                        ])
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('gifts-config-list')
                            @include('inc.admin.menu-item', ['routeName' => 'admin.gifts.config-list', 'title' => 'Cấu hình quà tặng', 'icon' => 'far fa-circle'])
                        @endcan
                        @can('gift-add')
                            @include('inc.admin.menu-item', ['routeName' => 'admin.gifts.addView', 'title' => 'Bổ sung quà tặng', 'icon' => 'far fa-circle'])
                        @endcan
                    </ul>
                </li>

                @can('challenges-list')
                    @include('inc.admin.menu-item', ['routeName' => 'challenges.index', 'title' => 'Quản lý thử thách', 'icon' => 'fas fa-tools'])
                @endcan

                <!-- import -->
                {{--<li class="nav-item ">
                    @canany(['imports-cus-type','imports-trans-report'])
                    @include('inc.admin.menu-item-parent', [
                        'childRouteNames' => ['admin.imports.cus-type-view', 'admin.imports.trans-report-view'],
                        'title' => 'Imported File GUI',
                         'icon' => 'fas fa-file-import'
                    ])
                    @endcanany
                    <ul class="nav nav-treeview">
                        @can('imports-cus-type')
                            @include('inc.admin.menu-item', ['routeName' => 'admin.imports.cus-type-view', 'title' => 'Import Cus Type', 'icon' => 'far fa-circle'])
                        @endcan

                        @can('imports-trans-report')
                            @include('inc.admin.menu-item', ['routeName' => 'admin.imports.trans-report-view', 'title' => 'Import Trans Report', 'icon' => 'far fa-circle'])
                        @endcan
                    </ul>
                </li>--}}
                {{--@can('import-log-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.import-logs.index', 'title' => 'Imported File Logs', 'icon' => 'fas fa-file'])
                @endcan

                @can('monthly-reset-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.monthly-reset.index', 'title' => 'Monthly Resets Logs', 'icon' => 'far fa-calendar'])
                @endcan--}}

                <li class="nav-header">TÍNH NĂNG MỞ RỘNG</li>
                @can('delivery-message-list')
                    @include('inc.admin.menu-item', ['routeName' => 'delivery-messages.index', 'title' => 'Nội dung phản hồi', 'icon' => 'fas fa-envelope'])
                @endcan

                @can('season-list')
                    @include('inc.admin.menu-item', ['routeName' => 'seasons.index', 'title' => 'Tháng (quy ước)', 'icon' => 'fas fa-tree'])
                @endcan

                @can('activity-log-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.activity-logs.index', 'title' => 'Activity Logs', 'icon' => 'fas fa-history'])
                @endcan

                {{--@can('passed-challenge-log-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.passed-challenge-logs.index', 'title' => 'Thử thách vượt qua', 'icon' => 'fas fa-history'])
                @endcan

                @can('social-share')
                    @include('inc.admin.menu-item', ['routeName' => 'social-shares.index', 'title' => 'Lịch sửa chia sẻ', 'icon' => 'fas fa-share'])
                @endcan--}}

                @can('play-log-list')
                    @include('inc.admin.menu-item', ['routeName' => 'playlogs.index', 'title' => 'Lịch sử chơi game', 'icon' => 'fas fa-id-badge'])
                @endcan

                @can('service-log-list')
                    @include('inc.admin.menu-item', ['routeName' => 'service-logs.index', 'title' => 'Service Logs', 'icon' => 'fas fa-link'])
                @endcan

                @can('summary-report-list')
                    @include('inc.admin.menu-item', ['routeName' => 'summary-reports.index-optimize', 'title' => 'Summary Report', 'icon' => 'fa fa-chart-bar'])
                @endcan

                @can('summary-report-list')
                    @include('inc.admin.menu-item', ['routeName' => 'top-reports.index', 'title' => 'Top Report', 'icon' => 'fa fa-table'])
                @endcan

                @can('saving-book-list')
                    @include('inc.admin.menu-item', ['routeName' => 'saving-books.index', 'title' => 'Saving Books', 'icon' => 'fa fa-book'])
                @endcan

                @can('queue-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.queue.index', 'title' => 'Queue Monitor', 'icon' => 'fas fa-tasks'])
                @endcan

                @canany(['user-list','role-list','system-config-list'])
                <li class="nav-header">TÍNH NĂNG CƠ BẢN</li>
                @endcan

                @can('user-list')
                @include('inc.admin.menu-item', ['routeName' => 'users.index', 'title' => 'Quản lý người dùng', 'icon' => 'fas fa-user'])
                @endcan

                @can('role-list')
                @include('inc.admin.menu-item', ['routeName' => 'roles.index', 'title' => 'Quản lý phân quyền', 'icon' => 'fas fa-pencil-ruler'])
                @endcan

                @can('system-config-list')
                @include('inc.admin.menu-item', ['routeName' => 'admin.system-configs.index', 'title' => 'Cấu hình hệ thống', 'icon' => 'fas fa-cogs'])
                @endcan

                @can('system-config-list')
                    @include('inc.admin.menu-item', ['routeName' => 'admin.command.index', 'title' => 'Lệnh hệ thống', 'icon' => 'fas fa-running'])
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
