@extends('layouts.website.app')

@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="section py-5">
            <div class="banner__bg-type">
                <span class="bg-color d-lg-none"></span>
            </div>
            {{-- <div class="container">
                <div class="banner__wrapper start__contact">
                    <div class="d-flex align-items-center gap-2 flex gx-4">
                        <div class="col-lg-5 col-md-7">
                            <ul class="left__contact">
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_mail.png') }}" alt="" />
                                        <h5>{{ __('home.email') }}</h5> <!-- Translation key for "Email" -->
                                    </div>
                                    <span>TEKPART@info.co.us</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_call.png') }}" alt="" />
                                        <h5>{{ __('home.phone') }}</h5> <!-- Translation key for "Phone" -->
                                    </div>
                                    <span>+1 601-201-5580</span>
                                </li>
                                <li>
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ asset('assets/image/icon_location.png') }}" alt="" />
                                        <h5>{{ __('home.address') }}</h5> <!-- Translation key for "Address" -->
                                    </div>
                                    <span>1642 Washington Ave, Jackson, MS</span>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-7 col-md-5">
                            <!-- Example Form -->
                            <form class="row" action="{{ route('contacts.store') }}" method="POST">
                                @csrf
                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="{{ __('home.name_placeholder') }}" name="name"
                                        class="" />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" placeholder="{{ __('home.email_placeholder') }}" name="email"
                                        class="" />
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="col-md-12 mb-3">
                                    <input type="text" placeholder="{{ __('home.phone_placeholder') }}" name="phone"
                                        class="" />
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <textarea type="text" placeholder="{{ __('home.message_placeholder') }}" name="msg" style="height: 100px"></textarea>
                                    @error('msg')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex col-12 justify-content-end">
                                    <button class="header__btn__contact" type="submit">
                                        <span class="text-white">{{ __('home.send') }}</span>
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div> --}}
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
        </div>
    </section>
@endsection


@section('scripts')
    @if (Session::has('success_message'))
        <script>
            toastr.success('{{ Session::get('success_message') }}');
        </script>
    @endif

    @if (Session::has('error_message'))
        <script>
            toastr.error('{{ Session::get('error_message') }}');
        </script>
    @endif
@endsection
@section('title__page')
    <h1 class="text-white mb-4 animated slideInDown">{{ __('home.contact_us') }}</h1>
    <p class="text-white pb-3 animated slideInDown">
    </p>
@endsection
