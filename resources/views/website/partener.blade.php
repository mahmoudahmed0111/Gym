@extends('layouts.website.app')

@section('content')
    {{-- <section class="banner banner--style1 home py-0">
        <div class="section bg__welcome__partener" style="position: relative">
            <div class="container">
                <div class="banner__wrapper pt-5">
                    <div class="row gx-4">
                        <h2>{{ __('home.Become_partner') }}</h2>
                        <p class="text-white p__partener">
                            {{ __('home.do_you_have_a_field_you_would_like_to_add_to_our_app_let_us_do_it') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="banner banner--style1 home py-0">
        <div class="section py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container-xxl py-5" id="contact">
                <div class="container py-5 px-lg-5">
                    <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                        <h5 class="text-primary-gradient fw-medium">Contact Us</h5>
                        <h1 class="mb-5">Get In Touch!</h1>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="wow fadeInUp" data-wow-delay="0.3s">
                                <p class="text-center mb-4">
                                    The contact form is currently inactive. Get a functional and
                                    working contact form with Ajax & PHP in a few minutes. Just
                                    copy and paste the files, add a little code and you're done.
                                    <a href="https://htmlcodex.com/contact-form">Download Now</a>.
                                </p>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="name"
                                                    placeholder="Your Name" />
                                                <label for="name">Your Name</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="email" class="form-control" id="email"
                                                    placeholder="Your Email" />
                                                <label for="email">Your Email</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="subject"
                                                    placeholder="Subject" />
                                                <label for="subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 150px"></textarea>
                                                <label for="message">Message</label>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary-gradient rounded-pill py-3 px-5" type="submit">
                                                Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="container">
                <div class="banner__wrapper start__contact">
                    <div class="d-flex align-items-center gap-2 flex gx-4">
                        <div class="col-lg-5 col-md-7">
                            <ul class="left__contact">
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/image/icon_mail.png" alt="" />
                                        <h5>{{ __('home.email') }}</h5>
                                    </div>
                                    <span>TEKPART@info.co.us</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/image/icon_call.png" alt="" />
                                        <h5>{{ __('home.phone') }}</h5>
                                    </div>
                                    <span>+1 601-201-5580</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/image/icon_location.png" alt="" />
                                        <h5>{{ __('home.address') }}</h5>
                                    </div>
                                    <span>1642 Washington Ave, Jackson, MS</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-7 col-md-5">
                            <form class="row" action="{{ route('partener.store') }}" method="POST">
                                @csrf

                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="{{ __('home.your_name') }}" name="name"
                                        id="" class="" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="{{ __('home.brand_name') }}" name="brand__name"
                                        id="" class="" />
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="{{ __('home.email') }}" name="email" id="email"
                                        class="" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="sport" class="form-select" aria-label="Default select example">
                                        <option selected>{{ __('home.sport') }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @error('sport')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="country" class="form-select" aria-label="Default select example">
                                        <option selected>{{ __('home.country') }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <select name="city" class="form-select" aria-label="Default select example">
                                        <option selected>{{ __('home.city') }}</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <input name="phone" type="text" placeholder="{{ __('home.phone') }}"
                                        name="" id="" class="" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex col-12 justify-content-end">
                                    <button class="header__btn__contact">
                                        <span class="text-white">{{ __('home.send') }}</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('scripts')
@endsection
@section('title__page')
    <h1 class="text-white mb-4 animated slideInDown">{{ __('home.Become_partner') }}</h1>
    <p class="text-white pb-3 animated slideInDown">
        {{ __('home.do_you_have_a_field_you_would_like_to_add_to_our_app_let_us_do_it') }}</p>
@endsection
