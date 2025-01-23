<style>

    .menu-vertical .menu-sub .menu-link{
        padding-left: 3rem !important;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('coach.dashboard.index') }}" class="app-brand-link d-flex align-items-center gap-2">
            <img src="{{ asset('logo/logo.png') }}" style="width: 50px" alt="">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ __('home.Sherif Saoudi') }}</span>
        </a>


        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <img src="{{ asset('asset/img/dashboard/dummy logo.png') }}" alt="">
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1 pt-5">
        <!-- Dashboard -->
        <li class="menu-item {{ isActiveRoute(['coach.dashboard.index']) }}">
            <a href="{{ route('coach.dashboard.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-house"></i>
                <div data-i18n="Analytics">{{ __('home.Dashboard') }}</div>
            </a>
        </li>
        <!-- Users -->
        <li
            class="menu-item {{ isActiveRoute(['admins.index', 'admins.create', 'admins.edit', 'users.index', 'users.create', 'users.edit', 'clubs.index', 'clubs.create', 'clubs.edit', 'vendors.index', 'vendors.create', 'vendors.edit']) }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                <i class="fa-solid fa-users"></i>
                <div data-i18n="Layouts">{{ __('home.Users') }}</div>
            </a>

            <ul class="menu-sub">

                {{-- Trainees --}}
                <li class="menu-item {{ isActiveRoute(['coach.trainees.index']) }}">
                    <a href="{{ route('coach.trainees.index') }}" class="menu-link d-flex align-items-center gap-2">
                        <i class="fa fa-users"></i>
                        <div data-i18n="Analytics">{{ __('home.trainees') }}</div>
                    </a>
                </li>
                {{-- Trainee's Profile Details --}}
                <li class="menu-item {{ isActiveRoute(['coach.trainees-profile.index']) }}">
                    <a href="{{ route('coach.trainees-profile.index') }}" class="menu-link">
                        <div data-i18n="Connections">{{ __('home.trainees-profile') }}</div>
                    </a>
                </li>
            </ul>
        </li>



        {{-- Categories --}}
        <li class="menu-item {{ isActiveRoute(['coach.categories.index']) }}">
            <a href="{{ route('coach.categories.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-basketball-ball"></i>
                <div data-i18n="Analytics">{{ __('home.main-categories') }}</div>
            </a>
        </li>

        {{-- Categories --}}
        <li class="menu-item {{ isActiveRoute(['coach.trainings.index']) }}">
            <a href="{{ route('coach.trainings.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-basketball-ball"></i>
                <div data-i18n="Analytics">{{ __('home.categories-trainings') }}</div>
            </a>
        </li>

        {{-- Support --}}
        <li class="menu-item {{ isActiveRoute(['coach.packages.index']) }}">
            <a href="{{ route('coach.packages.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.packages') }}</div>
            </a>
        </li>

        {{-- Food --}}
        <li class="menu-item {{ isActiveRoute(['coach.food.index']) }}">
            <a href="{{ route('coach.food.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.food') }}</div>
            </a>
        </li>

        {{-- Food --}}
        <li class="menu-item {{ isActiveRoute(['coach.meals.index']) }}">
            <a href="{{ route('coach.meals.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.meals') }}</div>
            </a>
        </li>

        {{-- Vitamins --}}
        <li class="menu-item {{ isActiveRoute(['coach.vitamins.index']) }}">
            <a href="{{ route('coach.vitamins.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.vitamins') }}</div>
            </a>
        </li>



        {{-- Support --}}
        <li class="menu-item {{ isActiveRoute(['coach.supports.index']) }}">
            <a href="{{ route('coach.supports.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Analytics">{{ __('home.system_support') }}</div>
            </a>
        </li>
        <li class="menu-item {{ isActiveRoute(['coach.settings.index']) }}">
            <a href="{{ route('coach.settings.index') }}" class="menu-link">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Authentications">الإعدادات</div>
            </a>
        </li>






    </ul>
</aside>
