@extends('layouts.website.app')

@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="section py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container-xxl py-5" id="contact">
                <div class="container py-5 px-lg-5">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="text-primary-gradient fw-medium">Subscription</h5>
                        <h1 class="mb-5">Get In Touch!</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="wow fadeInUp" data-wow-delay="0.3s">
                                <p class="text-center mb-4">
                                    The contact form is currently inactive. Get a functional and
                                    working contact form with Ajax & PHP in a few minutes. Just
                                    copy and paste the files, add a little code and you're done.
                                    {{-- <a href="https://htmlcodex.com/contact-form">Download Now</a>. --}}
                                </p>
                                <section class="service padding-top padding-bottom">
                                    <img src="{{asset('/asset/Group (5).png')}}" class="bg__join__img" alt="" />
                                    <div class="container about__me">
                                        <h2 class="text-green text-center">
                                            {{ __('home.package_club') }}
                                        </h2>
                                        <p class="text-center mb-5">
                                            {{ __('home.package_club') }}
                                        </p>
                                        <img src="{{asset('/asset/Group 876.png')}}" class="img" alt="" />
                                        <div class="d-flex align-items-center flex-wrap justify-content-center gap-5 flex-wrap">
                                            @foreach($packages_club as $package)
                                            <div class="col-lg-3 col-md-5 col-12">
                                                <div class="" style="    padding: 20px; border: 1px solid #c0c0c0;" data-aos="flip-up" data-aos-duration="1000">
                                                    <div class="d-flex align-content-center justify-content-end">
                                                        <img width="120" src="{{asset("asset/logo.png")}}" alt="" />
                                                    </div>
                                                    <h2 class="text-">{{ $package->name }}</h2>
                                                    <ul>
                                                        @foreach($package->features as $feature)
                                                        <li class="text-dark fs-6">✔ {{ $feature->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @if ($package->time!=-1)
                                                    <span class="mt-4 d-block price">{{ $package->price }} {{ __('SR') }}/{{ $package->time }}{{ __('months') }}</span>
                                                    @else
                                                    <span class="mt-4 d-block price">{{ $package->price }} {{ __('SR') }}/{{ __('opened') }}</span>
                                                    @endif
                                                    <a href="{{route("subscription.club",$package->id)}}">
                                                        <button style="color: white" class="btn btn-success mt-2">{{ __('Request') }}</button>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                                <section class="service padding-top padding-bottom">
                                    <img src="{{asset('/asset/Group (5).png')}}" class="bg__join__img" alt="" />
                                    <div class="container about__me">
                                        <h2 class="text-green text-center">
                                            {{ __('home.package_vendor') }}
                                        </h2>
                                        <p class="text-center mb-5">
                                            {{ __('home.package_vendor') }}
                                        </p>
                                        <img src="{{asset('/asset/Group 876.png')}}" class="img" alt="" />
                                        <div class="d-flex align-items-center flex-wrap justify-content-center gap-5 flex-wrap">
                                            @foreach($packages_vendor as $package)
                                            <div class="col-lg-3 col-md-5 col-12">
                                                <div class="" style="    padding: 20px; border: 1px solid #c0c0c0;" data-aos="flip-up" data-aos-duration="1000">
                                                    <div class="d-flex align-content-center justify-content-end">
                                                        <img width="120" src="{{asset("asset/logo.png")}}" alt="" />
                                                    </div>
                                                    <h2 class="text-">{{ $package->name }}</h2>
                                                    <ul>
                                                        @foreach($package->features as $feature)
                                                        <li class="text-dark fs-6">✔ {{ $feature->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                    @if ($package->time!=-1)
                                                    <span class="mt-4 d-block price">{{ $package->price }} {{ __('SR') }}/{{ $package->time }} {{ __('months') }}</span>
                                                    @else
                                                    <span class="mt-4 d-block price">{{ $package->price }} {{ __('SR') }}/{{ __('opened') }}</span>
                                                    @endif
                                                    <a href="{{route("subscription.vendor",$package->id)}}">
                                                        <button style="color: white" class="btn btn-success mt-2">{{ __('Request') }}</button>
                                                    </a>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
@endsection
{{-- @section('title__page')
    <h1 class="text-white mb-4 animated slideInDown">{{ __('home.Host_tournament') }}</h1>
    <p class="text-white pb-3 animated slideInDown">
        {{ __('home.now_you_can_host_a_tournament_with_us') }}
    </p>
@endsection --}}
