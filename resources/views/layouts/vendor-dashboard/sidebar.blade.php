<style>

    .menu-vertical .menu-sub .menu-link{
        padding-left: 3rem !important;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('vendor.dashboard.index') }}" class="app-brand-link d-flex align-items-center gap-2">
            <img src="{{ asset('asset/img/dashboard/dummy logo.png') }}" style="width: 50px" alt="">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ __('home.esports') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <img src="{{ asset('asset/img/dashboard/dummy logo.png') }}" alt="">
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 pt-5">
        <!-- Dashboard -->
        <li class="menu-item {{ isActiveRoute(['vendor.dashboard.index']) }}">
            <a href="{{ route('vendor.dashboard.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-house"></i>
                <div data-i18n="Analytics">{{ __('home.Dashboard') }}</div>
            </a>
        </li>
        {{-- Users --}}
        <li
            class="menu-item {{ isActiveRoute(['admins.index', 'users.index', 'vendors.index']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-users"></i>
                <div data-i18n="Layouts">{{ __('home.Users') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ isActiveRoute(['admins.index', 'admins.create', 'admins.edit']) }}">
                    <a href="{{ route('admins.index') }}" class="menu-link ">
                        <div data-i18n="Without menu">{{ __('home.Admins') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['vendors.index', 'vendors.create', 'vendors.edit']) }}">
                    <a href="{{ route('vendors.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ __('home.trainers') }}</div>
                    </a>
                </li>
                {{-- <li class="menu-item {{ isActiveRoute(['clubs.index', 'clubs.create', 'clubs.edit']) }}">
                    <a href="{{ route('clubs.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ __('home.users') }}</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ isActiveRoute(['user.index', 'user.create', 'user.edit']) }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ __('home.Users') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ isActiveRoute(['vendor.category_products.index' ,'vendor.category_products.create','vendor.category_products.edit','vendor.products.index' ,'vendor.products.create','vendor.products.edit','vendor.offers.index' ,'vendor.offers.create','vendor.offers.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class='bx bx-list-ul'></i>
                <div data-i18n="Layouts">{{ __('home.porduct and catedory') }}</div>
            </a>

            <ul class="menu-sub">
                {{-- <li class="menu-item {{ isActiveRoute(['vendor.category_products.index' ,'vendor.category_products.create','vendor.category_products.edit']) }}">
                    <a href="{{ route('vendor.category_products.index') }}" class="menu-link d-flex align-items-center gap-2">
                        <div data-i18n="Without navbar">{{ __('home.category_products') }}</div>
                    </a>
                </li> --}}
                <li class="menu-item {{ isActiveRoute(['vendor.products.index' ,'vendor.products.create','vendor.products.edit']) }}">
                    <a href="{{ route('vendor.products.index') }}" class="menu-link d-flex align-items-center gap-2">
                        <div data-i18n="Without navbar">{{ __('home.products') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['vendor.offers.index' ,'vendor.offers.create','vendor.offers.edit']) }}">
                    <a href="{{ route('vendor.offers.index') }}" class="menu-link d-flex align-items-center gap-2">
                        <div data-i18n="Without navbar">{{ __('home.offers') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="menu-item {{ isActiveRoute(['vendor.orders.index']) }}">
            <a href="{{ route('vendor.orders.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.orders') }}</div>
            </a>
        </li> --}}
        {{-- <li class="menu-item {{ isActiveRoute(['club.wallets.index']) }}">
            <a href="{{ route('club.wallets.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-wallet"></i>
                <div data-i18n="Analytics">{{ __('home.wallets') }}</div>
            </a>
        </li>
        <li class="menu-item {{ isActiveRoute(['vendor.payment_logs.index']) }}">
            <a href="{{ route('vendor.payment_logs.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-brands fa-paypal"></i>
                <div data-i18n="Analytics">{{ __('home.Payments') }}</div>
            </a>
        </li> --}}

        {{-- <li class="menu-item {{ isActiveRoute(['vendor.payment.pay']) }}">
            <a href="{{ route('vendor.payment.pay') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-money-bill-wave"></i>
                <div data-i18n="Analytics">{{ __('home.AdminToVendorPayment') }}</div>
            </a>
        </li> --}}


        {{-- <li class="menu-item {{ isActiveRoute(['vendor.reviews.index',"vendor.reviews.show"]) }}">
            <a href="{{ route('vendor.reviews.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-ranking-star"></i>
                <div data-i18n="Analytics">{{ __('home.Reviews') }}</div>
            </a>
        </li>
        <li class="menu-item {{ isActiveRoute(['vendor.reports.bestSales','vendor.reports.order']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-paste"></i>
                <div data-i18n="Layouts">{{__("home.reports")}}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ isActiveRoute(['vendor.reports.bestSales']) }}">
                    <a href="{{route("vendor.reports.bestSales")}}" class="menu-link">
                        <div data-i18n="Without menu">{{__("home.best_sales")}}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['vendor.reports.order']) }}">
                    <a href="{{route("vendor.reports.order")}}" class="menu-link">
                        <div data-i18n="Without menu">{{__("home.orders")}}</div>
                    </a>
                </li>

            </ul>
        </li> --}}
        <li class="menu-item {{ isActiveRoute(['vendor.supports.index']) }}">
            <a href="{{ route('vendor.supports.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Analytics">{{ __('home.system_support') }}</div>
            </a>
        </li>


    </ul>
</aside>
