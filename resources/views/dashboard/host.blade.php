@extends('layouts.website.app')

@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="section bg__welcome__host" style="position: relative">
            <div class="container">
                <div class="banner__wrapper pt-5">
                    <div class="row gx-4">
                        <h2>{{ __("home.Host_tournament") }}</h2>
                        <p class="text-white p__partener">
                            {{ __("home.now_you_can_host_a_tournament_with_us") }}
                        </p>
                        <!-- <div
                            class="banner__btn-group btn-group m-auto w-100 d-flex align-items-center justify-content-center py-5 pt-3"
                          >
                            <img
                              src="assets/image/Screenshot 2024-05-11 085822 2.svg"
                              style="width: 140px"
                              alt=""
                            />
                            <img
                              src="assets/image/Screenshot 2024-05-11 085822 1.svg"
                              style="width: 140px"
                              alt=""
                            />
                          </div> -->
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
                                        <img src="assets/image/icon_mail.png" alt="" />
                                        <h5>{{ __("home.email") }}</h5>
                                    </div>
                                    <span>TEKPART@info.co.us</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/image/icon_call.png" alt="" />
                                        <h5>{{ __("home.phone") }}</h5>
                                    </div>
                                    <span>+1 601-201-5580</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="assets/image/icon_location.png" alt="" />
                                        <h5>{{ __("home.address") }}</h5>
                                    </div>
                                    <span>1642 Washington Ave, Jackson, MS</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-7 col-md-5">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ __("home.your_email") }}" name="" id=""
                                        class="mb-3" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ __("home.your_name") }}" name="" id=""
                                        class="mb-3" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" placeholder="{{ __("home.phone") }}" name="" id=""
                                        class="mb-3" />
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select" aria-label="{{ __("home.country") }}">
                                        <option selected>{{ __("home.country") }}</option>
                                        <option value="1">{{ __("home.one") }}</option>
                                        <option value="2">{{ __("home.two") }}</option>
                                        <option value="3">{{ __("home.three") }}</option>
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <textarea type="text" placeholder="{{ __("home.message") }}" name="" style="height: 100px" id=""></textarea>
                                </div>
                                <div class="d-flex col-12 justify-content-end">
                                    <button class="header__btn__contact">
                                        <a href="" class="text-white">{{ __("home.send") }}</a>
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
