@extends('layouts.website.app')
@section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('assett/img/breadcrumb-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>Services</h2>
                        <div class="bt-option">
                            <a href="{{ route('home') }}">Home</a>
                            <span>Services</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Services Section Begin -->
    <section class="services-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <span>What we do?</span>
                        <h2>PUSH YOUR LIMITS FORWARD</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- @foreach ($services as $service)

                @endforeach --}}
                <div class="col-lg-3 order-lg-1 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="{{ asset('assett/img/services/services-1.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-2 col-md-6 p-0">
                    <div class="ss-text">
                        <h4>Personal training</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore
                            facilisis.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-3 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="{{ asset('assett/img/services/services-2.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-4 col-md-6 p-0">
                    <div class="ss-text">
                        <h4>Group fitness classes</h4>
                        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-8 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="{{ asset('assett/img/services/services-4.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-7 col-md-6 p-0">
                    <div class="ss-text second-row">
                        <h4>Body building</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor ut dolore
                            facilisis.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-6 col-md-6 p-0">
                    <div class="ss-pic">
                        <img src="{{ asset('assett/img/services/services-3.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-3 order-lg-5 col-md-6 p-0">
                    <div class="ss-text second-row">
                        <h4>Strength training</h4>
                        <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus.</p>
                        <a href="#">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Banner Section Begin -->
    @php
        $firstAboutUs = $aboutus->first(); // Get the first item from the collection
    @endphp
    <section class="banner-section set-bg"
    data-setbg="{{ $firstAboutUs->video ? asset('assett/img/banner-bg.jpg') : video_url($firstAboutUs->video)}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="bs-text service-banner">
                    <h2>Exercise until the body obeys.</h2>
                    <div class="bt-tips">Where health, beauty, and fitness meet.</div>
                        <a href="{{ video_url($firstAboutUs->video) }}" class="play-btn video-popup">
                            <i class="fa fa-caret-right"></i>
                        </a>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Banner Section End -->

    <!-- Pricing Section Begin -->
    <section class="pricing-section service-pricing spad">
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
                @foreach ($package as $admin)
                <div class="col-lg-4 col-md-8">
                    <div class="ps-item">
                        <h3> {{ $admin->name }} </h3>
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
            </div>
        </div>
    </section>
    <!-- Pricing Section End -->

@endsection
