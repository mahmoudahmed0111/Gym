@extends('layouts.website.app')
@section('content')
    <section class="banner banner--style1 home py-0">
        <div class="banner__bg-type">
            <span class="bg-color d-lg-none"></span>
        </div>
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.subscription_vendor') }}</h5>
                            {{-- <a href="{{ route('vendors.index') }}" style="width: fit-content">
                                    <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i
                                            class="fa-solid fa-backward"></i>
                                        {{ __('home.Back') }}
                                    </button>
                                </a> --}}
                        </div>

                        <div class="card-body">
                            <form action="{{ route('subscription.vendor.store', $package->id) }}" method="POST"
                                class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('name'),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'label' => 'Name',
                                        'placeholder' => 'belal zeina',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('email'),
                                        'name' => 'email',
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'a@a.com',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('mobile'),
                                        'name' => 'mobile',
                                        'type' => 'tel',
                                        'label' => 'Mobile',
                                        'placeholder' => '01096685149',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('password'),
                                        'name' => 'password',
                                        'type' => 'password',
                                        'label' => 'Password',
                                        'placeholder' => 'a@a.com',
                                    ])
                                </div>

                                @include('components.input', [
                                    'value' => old('img'),
                                    'name' => 'img',
                                    'type' => 'file',
                                    'label' => 'Image',
                                    'placeholder' => '',
                                ])


                                <div class="col-md-12 col-12 mb-1">
                                    <div class="d-flex col-md-12 flex-column mb-7 fv-row fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span class="required" style="font-weight:bold">
                                                {{ __('models.location') . ' (' . __('models.search_in_map') . ')' }}
                                            </span>

                                        </label>
                                        <input type="text" name="icon" class="form-control form-control-solid"
                                            id="searchInput" value="{{ old('location') }}">

                                    </div>
                                    @error('location')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <br>
                                </div>

                                <div class="col-md-12 col-12 mb-3">
                                    <div class="d-flex col-12 flex-column mb-7 fv-row fv-plugins-icon-container"
                                        style="height:100vh">
                                        <input type="hidden" name="location" class="form-control" id="location"
                                            value="{{ old('location') }}">
                                        <input type="hidden" name="lat" class="form-control" id="lat"
                                            value="{{ old('lat') }}">
                                        <input type="hidden" name="lng" class="form-control" id="lng"
                                            value="{{ old('lng') }}">
                                        <div id="map" style="height: 100%;width: 100%;">
                                        </div>

                                    </div>
                                    <br>
                                    <br>
                                    <div class="d-flex align-items justify-content-end">
                                        @include('components.button', [
                                            'type' => 'submit',
                                            'name' => 'Add',
                                        ])
                                    </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
            </div>

    </section>
@endsection

@section('scripts')
    @include('dashboard.vendors.mab')
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Select2 JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-multiple-select').select2({
                placeholder: "Select options",
                allowClear: true
            }).on('select2:select select2:unselect', function(e) {
                toggleDurationInputs();
            });

            // Initialize the display based on the current selection
            toggleDurationInputs();

            function toggleDurationInputs() {
                var selectedCategories = $('#example-multiple-select').val() || [];
                $('.duration-input').each(function() {
                    var categoryId = $(this).attr('id').replace('duration-wrapper-', '');
                    if (selectedCategories.includes(categoryId)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }
        });
    </script>
@endsection
