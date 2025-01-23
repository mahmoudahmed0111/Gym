<!DOCTYPE html>
<html lang="zxx">

<head>
    @include('layouts.website.head')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Section Begin -->
    @include('layouts.website.header')

    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->



    <!-- Header End -->

    @yield('content')


    <!-- Footer Section Begin -->
    @include('layouts.website.footer')
    <!-- Footer Section End -->

    <!-- Search model Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search model end -->

    <!-- Js Plugins -->
    @include('layouts.website.scripts')

</body>

</html>
