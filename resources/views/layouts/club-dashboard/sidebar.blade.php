<style>

    .menu-vertical .menu-sub .menu-link{
        padding-left: 3rem !important;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('club.dashboard.index') }}" class="app-brand-link d-flex align-items-center gap-2">
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
        <li class="menu-item {{ isActiveRoute(['club.dashboard.index']) }}">
            <a href="{{ route('club.dashboard.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-house"></i>
                <div data-i18n="Analytics">{{ __('home.Dashboard') }}</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ isActiveRoute(['admins.index','admins.create','admins.edit', 'users.index','users.create','users.edit','clubs.index','clubs.create','clubs.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-users"></i>
                <div data-i18n="Layouts">{{ __('home.Users') }}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ isActiveRoute(['admins.index','admins.create','admins.edit']) }}">
                    <a href="{{ route('admins.index') }}" class="menu-link ">
                        <div data-i18n="Without menu">{{ __('home.Admins') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['clubs.index','clubs.create','clubs.edit']) }}">
                    <a href="{{ route('clubs.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ __('home.clubs') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['user.index','user.create','user.edit']) }}">
                    <a href="{{ route('users.index') }}" class="menu-link">
                        <div data-i18n="Without navbar">{{ __('home.Users') }}</div>
                    </a>
                </li>
            </ul>
        </li> --}}

        <li class="menu-item {{ isActiveRoute(['club.type_category.index','club.type_category.create','club.type_category.edit']) }}">
            <a href="{{ route('club.type_category.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-list-ul"></i>
                <div data-i18n="Analytics">{{ __('home.type_categories') }}</div>
            </a>
        </li>
        <!-- packages  الباقات -->
        <li class="menu-item {{ isActiveRoute(['club.packages.index','club.packages.create','club.packages.edit']) }}">
            <a href="{{ route('club.packages.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.packages') }}</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-earth-americas"></i>
                <div data-i18n="Account Settings">{{ __('home.External site') }}</div>
            </a>
            <ul class="menu-sub">

                <li class="menu-item {{ isActiveRoute(['club.links.index','club.links.create','club.links.edit']) }}">
                    <a href="{{ route('club.links.index') }}" class="menu-link d-flex align-items-center gap-2">
                        <div data-i18n="Analytics">{{ __('home.links') }}</div>
                    </a>
                </li>


            </ul>
        </li>


        {{-- <li class="menu-item {{ isActiveRoute(['club.bookings.index','club.bookings.create','club.bookings.edit']) }}">
            <a href="{{ route('club.bookings.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-calendar-check"></i>
                <div data-i18n="Analytics">{{ __('home.bookings') }}</div>
            </a>
        </li> --}}

        {{-- <li class="menu-item {{ isActiveRoute(['club.bookings.refunds']) }}">
            <a href="{{ route('club.bookings.refunds') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-calendar-check"></i>
                <div data-i18n="Analytics">{{ __('home.refunds') }}</div>
            </a>
        </li> --}}

        {{-- <li class="menu-item {{ isActiveRoute(['club.promo_codes.index','club.promo_codes.create','club.promo_codes.edit']) }}">
            <a href="{{ route('club.promo_codes.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-calendar-check"></i>
                <div data-i18n="Analytics">{{ __('home.promo_codes') }}</div>
            </a>
        </li> --}}

        {{-- <li class="menu-item {{ isActiveRoute(['club.wallets.index']) }}">
            <a href="{{ route('club.wallets.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-wallet"></i>
                <div data-i18n="Analytics">{{ __('home.wallets') }}</div>
            </a>
        </li> --}}
        {{-- <li class="menu-item {{ isActiveRoute(['club.payment_logs.index']) }}">
            <a href="{{ route('club.payment_logs.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-brands fa-paypal"></i>
                <div data-i18n="Analytics">{{ __('home.Payments') }}</div>
            </a>
        </li> --}}

        {{-- <li class="menu-item {{ isActiveRoute(['club.payment.pay']) }}">
            <a href="{{ route('club.payment.pay') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-money-bill-wave"></i>
                <div data-i18n="Analytics">{{ __('home.AdminToClubPayment') }}</div>
            </a>
        </li> --}}
        <!-- Layouts -->
        {{-- <li class="menu-item {{ isActiveRoute(['club.reports.booking','club.reports.places']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-paste"></i>
                <div data-i18n="Layouts">{{__("home.reports")}}</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ isActiveRoute(['club.reports.booking']) }}">
                    <a href="{{route("club.reports.booking")}}" class="menu-link">
                        <div data-i18n="Without menu">{{__("home.bookings")}}</div>
                    </a>
                </li>
                <li class="menu-item {{ isActiveRoute(['club.reports.places']) }}">
                    <a href="{{route("club.reports.places")}}" class="menu-link">
                        <div data-i18n="Without menu">{{__("home.places")}}</div>
                    </a>
                </li>


            </ul>
        </li> --}}
        <li class="menu-item {{ isActiveRoute(['club.supports.index']) }}">
            <a href="{{ route('club.supports.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Analytics">{{ __('home.system_support') }}</div>
            </a>
        </li>
        <li class="menu-item {{ isActiveRoute(['club.settings.index']) }}">
            <a href="{{ route('club.settings.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Analytics">{{ __('home.Settings') }}</div>
            </a>
        </li>

    </ul>
</aside>
