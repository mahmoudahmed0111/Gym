@extends('layouts.website.app')

@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assett/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>About us</h2>
                        <div class="bt-option">
                            <a href="{{ route('home') }}">Home</a>
                            <span>About</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

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

    <!-- About US Section Begin -->
    <section class="aboutus-section">
        <div class="container-fluid">
            <div class="row">
                @foreach ($aboutus as $aboutus)
                <div class="col-lg-6 p-0">
                    <div class="about-video set-bg" data-setbg="{{ $aboutus->video ? video_url($aboutus->video) : asset('assett/img/about-us.jpg') }}">
                        @if($aboutus->video)
                            <video controls class="video-player" style="width: 100%; height: 100%">
                                <source src="{{ video_url($aboutus->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            <a href="{{ asset('assett/img/about-us.jpg') }}" class="play-btn">
                                <i class="fa fa-caret-right"></i>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="about-text">
                        <div class="section-title">
                            <span>About Us</span>
                            <h2>What we have done</h2>
                        </div>
                        <div class="at-desc">

                            <p>{{ $aboutus->description }}</p>

                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- About US Section End -->

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
                    @foreach ($team as $trainer)
                    <div class="col-lg-4">
                        <div class="ts-item set-bg" data-setbg="{{ $trainer ? image_url($trainer->img) : asset('assett/img/hero/hero-2.jpg') }}">
                            <div class="ts_text">
                                <h4> {{ $trainer->name }} </h4>
                                <span> {{ $trainer->description }} </span>
                            </div>
                        </div>
                    </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>
    <!-- Team Section End -->

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

    <!-- Testimonial Section Begin -->
    <section class="testimonial-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>Testimonial</span>
                        <h2>Our cilent say</h2>
                    </div>
                </div>
            </div>
            <div class="ts_slider owl-carousel">
                @foreach ($testimonials as $testimonial)

                <div class="ts_item">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="ti_pic">
                                <img src="{{ $testimonial ? image_url($testimonial->img) : asset('assett/img/testimonial/testimonial-1.jpg')  }}" alt="">
                            </div>
                            <div class="ti_text">
                                <p> {{ $testimonial->description }} </p>
                                <h5> {{ $testimonial->name }} </h5>
                                <div class="tt-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </section>
    <!-- Testimonial Section End -->

@endsection

