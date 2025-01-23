@extends('layouts.website.app')

@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="section bg__welcome__contact" style="position: relative">
            <div class="container">
                <div class="banner__wrapper pt-5">
                    <div class="row gx-4">
                        <h2>{{ __("home.contact_us") }}</h2> <!-- Translation key for "Contact Us" -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="banner banner--style1 home py-0">
        <div class="section py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container">
                <div class="banner__wrapper start__contact">
                    <div class="d-flex align-items-center gap-2 flex gx-4">
                        <div class="col-lg-5 col-md-7">
                            <ul class="left__contact">
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_mail.png') }}" alt="" />
                                        <h5>{{ __("home.email") }}</h5> <!-- Translation key for "Email" -->
                                    </div>
                                    <span>TEKPART@info.co.us</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_call.png') }}" alt="" />
                                        <h5>{{ __("home.phone") }}</h5> <!-- Translation key for "Phone" -->
                                    </div>
                                    <span>+1 601-201-5580</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_location.png') }}" alt="" />
                                        <h5>{{ __("home.address") }}</h5> <!-- Translation key for "Address" -->
                                    </div>
                                    <span>1642 Washington Ave, Jackson, MS</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-7 col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ __("home.email_placeholder") }}" name="" id=""
                                        class="mb-3" /> <!-- Translation key for "Email Placeholder" -->
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ __("home.name_placeholder") }}" name="" id=""
                                        class="mb-3" /> <!-- Translation key for "Name Placeholder" -->
                                </div>
                                <div class="col-md-12">
                                    <input type="text" placeholder="{{ __("home.phone_placeholder") }}" name="" id=""
                                        class="mb-3" /> <!-- Translation key for "Phone Placeholder" -->
                                </div>
                                <div class="col-md-12">
                                    <textarea type="text" placeholder="{{ __("home.message_placeholder") }}" name=""
                                        style="height: 100px" id=""></textarea> <!-- Translation key for "Message Placeholder" -->
                                </div>
                                <div class="d-flex col-12 justify-content-end">
                                    <button class="header__btn__contact">
                                        <a href="" class="text-white">{{ __("home.send") }}</a> <!-- Translation key for "Send" -->
                                    </button>
                                </div>
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
