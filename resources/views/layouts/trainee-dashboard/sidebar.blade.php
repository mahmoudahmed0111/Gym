<style>

    .menu-vertical .menu-sub .menu-link{
        padding-left: 3rem !important;
    }
</style>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('trainee.dashboard.index') }}" class="app-brand-link d-flex align-items-center gap-2">
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
        <li class="menu-item {{ isActiveRoute(['trainee.dashboard.index']) }}">
            <a href="{{ route('trainee.dashboard.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-house"></i>
                <div data-i18n="Analytics">{{ __('home.Dashboard') }}</div>
            </a>
        </li>

        {{-- Food --}}
        <li class="menu-item {{ isActiveRoute(['trainee.food.index']) }}">
            <a href="{{ route('trainee.food.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.food') }}</div>
            </a>
        </li>

        {{-- Meals --}}
        <li class="menu-item {{ isActiveRoute(['trainee.meals.index']) }}">
            <a href="{{ route('trainee.meals.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.meals') }}</div>
            </a>
        </li>

        {{-- Vitamins --}}
        <li class="menu-item {{ isActiveRoute(['trainee.vitamins.index']) }}">
            <a href="{{ route('trainee.vitamins.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.vitamins') }}</div>
            </a>
        </li>

        {{-- Trainings --}}
        <li class="menu-item {{ isActiveRoute(['trainee.trainings.index', 'trainee.trainings.show']) }}">
            <a href="{{ route('trainee.trainings.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.trainings') }}</div>
            </a>
        </li>

        {{-- Progress --}}
        <li class="menu-item {{ isActiveRoute(['trainee.progress.index', 'trainee.progress.show']) }}">
            <a href="{{ route('trainee.progress.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa fa-box"></i>
                <div data-i18n="Analytics">{{ __('home.progress') }}</div>
            </a>
        </li>

        {{-- Support --}}
        <li class="menu-item {{ isActiveRoute(['trainee.supports.index']) }}">
            <a href="{{ route('trainee.supports.index') }}" class="menu-link d-flex align-items-center gap-2">
                <i class="fa-solid fa-gear"></i>
                <div data-i18n="Analytics">{{ __('home.system_support') }}</div>
            </a>
        </li>












    </ul>
</aside>
