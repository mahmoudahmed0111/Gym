<div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="fa fa-close"></i>
        </div>
        <div class="canvas-search search-switch">
            <i class="fa fa-search"></i>
        </div>
        <nav class="canvas-menu mobile-menu">
            <ul>
                <li><a href="./index.html">Home</a></li>
                <li><a href="./about-us.html">About Us</a></li>
                <li><a href="./classes.html">Classes</a></li>
                <li><a href="./services.html">Services</a></li>
                <li><a href="./team.html">Our Team</a></li>
                <li><a href="#">Pages</a>
                    <ul class="dropdown">
                        <li><a href="./about-us.html">About us</a></li>
                        <li><a href="./class-timetable.html">Classes timetable</a></li>
                        <li><a href="./bmi-calculator.html">Bmi calculate</a></li>
                        <li><a href="./team.html">Our team</a></li>
                        <li><a href="./gallery.html">Gallery</a></li>
                        <li><a href="./blog.html">Our blog</a></li>
                        <li><a href="./404.html">404</a></li>
                    </ul>
                </li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="canvas-social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-youtube-play"></i></a>
            <a href="#"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
</div>

<header class="header-section">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-3 d-flex justify-content-center">
                <div class="logo">
                    <a href="./index.html">
                        <img width="80" src="{{ asset('logo/logo.png') }}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="nav-menu">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('website.aboutUs') }}">About Us</a></li>
                        <li><a href="{{ route('website.classes') }}">Classes</a></li>
                        <li><a href="{{ route('website.services') }}">Services</a></li>
                        <li><a href="{{ route('website.team') }}">Our Team</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{{ route('website.aboutUs') }}">About us</a></li>
                                <li><a href="{{ route('website.classes') }}">Classes timetable</a></li>
                                <li><a href="{{ route('website.calculater') }}">Bmi calculate</a></li>
                                <li><a href="{{ route('website.team') }}">Our team</a></li>
                                <li><a href="{{ route('website.gallery') }}">Gallery</a></li>
                                <li><a href="{{ route('website.blog') }}">Our blog</a></li>
                                <li><a href="{{ route('website.error404') }}">404</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('website.contact') }}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="top-option">
                    <div class="to-search search-switch">
                        <i class="fa fa-search"></i>
                    </div>
                    {{-- <div class="to-social">
                        @foreach ($links as $link)
                            <a href="{{ $link->link }}"><i class="{{ $link->icon }}"></i></a>
                        @endforeach
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="canvas-open">
            <i class="fa fa-bars"></i>
        </div>
    </div>


</header>
