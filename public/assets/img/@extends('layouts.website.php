@extends('layouts.website.app')

@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="section bg__welcome" style="position: relative">
            <div class="container">
                <div class="banner__wrapper pt-5">
                    <div class="row gx-4">
                        <div class="col-lg-7 d-flex align-items-center justify-content-center">
                            <div class="banner__content" data-aos="fade-left" data-aos-duration="1000">
                                <h1 class="banner__content-heading mb-3">
                                    <div class="text-white">{{ __('home.super_sports_community_app') }}</div>
                                </h1>
                                <p class="banner__content-moto pt-3 text-white">
                                    {{ __('home.organize_activities_and_meet_people') }} <br />
                                    {{ __('home.manage_responses_bookings_and_payments') }} <br />
                                    {{ __('home.be_active_and_get_rewards') }}
                                </p>
                                <div class="banner__btn-group btn-group">
                                    <img src="{{ asset('assets/image/Screenshot 2024-05-11 085822 2.svg') }}"
                                        alt="" />
                                    <img src="{{ asset('assets/image/Screenshot 2024-05-11 085822 1.svg') }}"
                                        alt="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="banner__thumb" data-aos="fade-right" data-aos-duration="1000">
                                <img src="{{ asset('assets/image/Group 1000000913.png') }}" alt="banner-thumb"
                                    class="dark" alt="" />
                                <!-- <img
                                                                    src="assets/image/iPhone 12 Pro (Wooden Hands).png"
                                                                    alt="banner-thumb"
                                                                    style="height: 110%"
                                                                    class="dark w-100"
                                                                  /> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="banner banner--style1 home py-0">
        <div class="section">
            <div class="section-header text-center mb-3 d-flex align-items-center flex-column justify-content-center">
                <h2 class="mt-minus-5 title__profile bottom mb-5">{{ __('home.esports') }}</h2>
            </div>

            <div class="container">
                <div class="row">
                    <div class="d-flex flex-wrap align-items-center justify-content-around">
                        <div class="text-center d-flex flex-column align-items-center justify-content-center mb-4">
                            <div class="number">+ 110</div>
                            <span class="name__partners">{{ __('home.tournaments') }}</span>
                        </div>
                        <div class="text-center d-flex flex-column align-items-center justify-content-center mb-4">
                            <div class="number">30</div>
                            <span class="name__partners">{{ __('home.bookings') }}</span>
                        </div>
                        <div class="text-center d-flex flex-column align-items-center justify-content-center mb-4">
                            <div class="number">26</div>
                            <span class="name__partners">{{ __('home.clubs') }}</span>
                        </div>
                        <div class="text-center d-flex flex-column align-items-center justify-content-center mb-4">
                            <div class="number">150k+</div>
                            <span class="name__partners">{{ __('home.sports') }}</span>
                        </div>
                        <div class="text-center d-flex flex-column align-items-center justify-content-center mb-4">
                            <div class="number">5k+</div>
                            <span class="name__partners">{{ __('home.downloads') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section bg__gray py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container">
                <div class="banner__wrapper">
                    <div class="d-flex gap-5 align-items-center flex gx-4">
                        <div class="col-lg-5 col-md-7">
                            <div class="banner__content" data-aos="fade-left" data-aos-duration="1000">
                                <div class="img__bg">
                                    <img class="member__communication" src="{{ asset('assets/image/iPhone 15 Pro.png') }}"
                                        alt="" style="bottom: 40px; position: relative" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-5">
                            <h3 class="mb-5">{{ __('home.online_booking_system_for_your_sport') }}</h3>
                            <ul class="list">
                                <li class="w-75">
                                    {{ __('home.sports_facility_management_whether_tennis_basketball_soccer') }}
                                </li>
                                <li class="w-75">
                                    {{ __('home.transparent_organization_all_training_sessions_tournaments_events_stored') }}
                                </li>
                                <li class="w-75">
                                    {{ __('home.always_up_to_date_club_members_see_all_updates_on_their_smartphones') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container">
                <div class="banner__wrapper">
                    <div class="d-flex align-items-center gap-2 flex gx-4">
                        <div class="col-lg-7 col-md-5">
                            <h3 class="mb-5">{{ __('home.collect_contact_data') }}</h3>
                            <ul class="list">
                                <li class="mb-4 w-50">
                                    {{ __('home.access_registration_via_quick_response_code_guests_and_viewers_can_also_check_in_and_out_on_site_without_downloading_the_playsports_app_via_quick_response_code') }}
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-5 col-md-7">
                            <div class="banner__content" data-aos="fade-left" data-aos-duration="1000">
                                <div class="img__bg">
                                    <img class="collection" src="{{ asset('assets/image/iPhone 13.png') }}" alt=""
                                        style="
                        position: relative;
                        z-index: 1;
                        max-height: 300px;
                        width: 80%;
                      " />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section bg__green py-0">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            <div class="container">
                <div class="banner__wrapper">
                    <div class="d-flex gap-5 flex gx-4 align-items-center">
                        <div class="col-lg-5 col-md-7">
                            <div class="banner__content" data-aos="fade-left" data-aos-duration="1000">
                                <div class="img__bg member__communication">
                                    <img class="member__communication" src="{{ asset('assets/image/iPhone 14.png') }}"
                                        alt="" style="bottom: 40px; position: relative" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-5">

                            <h3 class="mb-5">{{ __('home.member_communication') }}</h3>
                            <ul class="list">
                                <li class="w-75">
                                    {{ __('home.news_feed_is_your_private_channel_for_social_club_communication_you_can_directly_address_members') }}
                                </li>
                                <li class="w-75">
                                    {{ __('home.information_whats_new_in_the_association_all_members_are_permanently_informed') }}
                                </li>
                                <li class="w-75">
                                    {{ __('home.digital_club_life_who_is_on_the_field_now_who_is_commenting_instead_of_sweating_interact_with_each_other_in_social_media_style') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="section-header text-center mb-3 d-flex align-items-center flex-column justify-content-center">
                <h2 class="mt-minus-5 title__profile bottom mb-4">{{ __('home.free_community') }}</h2>
                <p class="w-50 mb-4">
                    {{ __('home.you_can_use_sportat_only_inside_your_club_or_you_can_become_part_of_the_free_multi_sports_community_as_a_sports_facility_you_can_use_sportat_actively_to_attract_members_and_generate_revenue_by_renting_out_fields') }}
                </p>
                {{-- <div class="button__sport">استخدم SPORTAT مجانًا</div> --}}
            </div>

            <div class="px-5 pt-5">
                <div class="bg__video">
                    <video src="{{ asset('assets/image/watermarked_preview.mp4') }}" autoplay loop></video>
                    <div class="opcity"></div>
                    {{-- <h3>من نحن؟</h3> --}}
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header text-center mb-3 d-flex align-items-center flex-column justify-content-center">
                <h2 class="mt-minus-5 title__profile bottom pt-5">{{ __('home.our_partners') }}</h2>
            </div>

            <div class="container">
                <img src="{{ asset('assets/Group 876.png') }}" class="img" alt="" />
                <div class="">
                    <div class="advertisement-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 16.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 18.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 15.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 17.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 16.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 18.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 15.png') }}" alt="Advertisement 1" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/image/image 17.png') }}" alt="Advertisement 1" />
                            </div>

                            <!-- Add more slides as needed -->
                        </div>
                    </div>

                    <div class="banner__bg"></div>
                </div>
            </div>
        </div>


    </section>
@endsection

@section('scripts')
@endsection
