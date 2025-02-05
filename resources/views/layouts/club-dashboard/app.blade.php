<!DOCTYPE html>
<html lang="@lang('constants.language')" direction="@lang('constants.direction')" dir="@lang('constants.direction')" style="direction: @lang('constants.direction')">
@include('layouts.club-dashboard.head')

<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" data-theme="light" data-kt-name="metronic" class="header-tablet-and-mobile-fixed aside-enabled">
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.club-dashboard.sidebar')
            <!-- / Menu -->
            <div class="layout-page">
                @include('layouts.club-dashboard.header')

                @yield('main')
            </div>
            <!-- Layout container -->

            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    <!--end::Wrapper-->

    @include('layouts.club-dashboard.scripts')

</body>

</html>
