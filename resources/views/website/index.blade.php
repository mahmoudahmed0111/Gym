@extends('layouts.website.app')
@section('content')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hs-slider owl-carousel">
            @if (isset($landingslider) && $landingslider->count() > 0)
                @foreach ($landingslider as $admin)
                    <div class="hs-item set-bg"
                        data-setbg="{{ $admin ? image_url($admin->img) : asset('assett/img/hero/hero-2.jpg') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 offset-lg-6">
                                    <div class="hi-text">
                                        <span>{{ $admin->name }}</span>
                                        <h1>{{ $admin->description }}</h1>
                                        <a href="#" class="primary-btn">Get info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </section>
    <!-- Hero Section End -->

    <!-- ChoseUs Section Begin -->
    <section class="choseus-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Why chose us?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-034-stationary-bike"></span>
                        <h4>Modern equipment</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            dolore facilisis.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-033-juice"></span>
                        <h4>Healthy nutrition plan</h4>
                        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                            facilisis.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-002-dumbell"></span>
                        <h4>Proffesponal training plan</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            dolore facilisis.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="cs-item">
                        <span class="flaticon-014-heart-beat"></span>
                        <h4>Unique to your needs</h4>
                        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel
                            facilisis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

    <!-- Classes Section Begin -->
    <section class="classes-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Classes</span>
                        <h2>WHAT WE CAN OFFER</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @if (isset($classes) && $classes->count() > 0)
                    @foreach ($classes as $admin)
                        <div class="col-lg-4 col-md-6">
                            <div class="class-item">
                                <div class="ci-pic">
                                    <img src="{{ $admin ? image_url($admin->img) : asset('assett/img/hero/hero-2.jpg') }}"
                                        alt="">
                                </div>
                                <div class="ci-text">
                                    <span> {{ $admin->name }} </span>
                                    <h5> {{ $admin->description }} </h5>
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- ChoseUs Section End -->

    <!-- Banner Section Begin -->
    <section class="banner-section set-bg" data-setbg="{{ asset('assett/img/banner-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="bs-text">
                        <h2>registration now to get more deals</h2>
                        <div class="bt-tips">Where health, beauty and fitness meet.</div>
                        <a href="#" class="primary-btn  btn-normal">Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Our Plan</span>
                        <h2>Choose your pricing plan</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @if (isset($package) && $package->count() > 0)
                    @foreach ($package as $admin)
                        <div class="col-lg-4 col-md-8">
                            <div class="ps-item">
                                <h3>{{ $admin->name }}</h3>
                                <div class="pi-price">
                                    <h2>{{ $admin->price }}</h2>
                                    <span>SINGLE CLASS</span>
                                </div>
                                <ul>
                                    @foreach ($admin->features as $feature)
                                        <li>{{ $feature->name }}</li>
                                    @endforeach
                                </ul>
                                <a href="#" class="primary-btn pricing-btn">Enroll now</a>
                                <a href="#" class="thumb-icon"><i class="fa fa-picture-o"></i></a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </section>
    <!-- Pricing Section End -->

    <!-- Gallery Section Begin -->
    <div class="gallery-section">
        <div class="gallery ">
            <div class="grid-sizer"></div>
            @if (isset($gallery) && $gallery->count() > 0)
                @foreach ($gallery as $admin)
                    <div class="gs-item  set-bg"
                        data-setbg="{{ $admin ? image_url($admin->img) : asset('assett/img/hero/hero-2.jpg') }}">
                        <a href="{{ $admin ? image_url($admin->img) : asset('assett/img/hero/hero-2.jpg') }}"
                            class="thumb-icon image-popup"><i class="fa fa-picture-o"></i></a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- Gallery Section End -->

    <!-- Team Section Begin -->
    <section class="team-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-title">
                        <div class="section-title">
                            <span>Our Team</span>
                            <h2>TRAIN WITH EXPERTS</h2>
                        </div>
                        <a href="#" class="primary-btn btn-normal appoinment-btn">appointment</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="ts-slider owl-carousel">
                    @if (isset($team) && $team->count() > 0)
                        @foreach ($team as $admin)
                            <div class="col-lg-4">
                                <div class="ts-item set-bg"
                                    data-setbg="{{ $admin ? image_url($admin->img) : asset('assett/img/hero/hero-2.jpg') }}">
                                    <div class="ts_text">
                                        <h4> {{ $admin->name }} </h4>
                                        <span> {{ $admin->description }} </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->
@endsection
