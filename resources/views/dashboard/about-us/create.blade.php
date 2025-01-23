@extends('layouts.dashboard.app')
@section('header__title', __('home.about-us'))
@section('header__icon', 'bx bx-food-menu')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.about-us') }}</h5>
                            <a href="{{ route('about-us.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('about-us.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 required">
                                    @include('components.input', [
                                        'value' => old('description'),
                                        'name' => 'description',
                                        'type' => 'text',
                                        'label' => 'Description',
                                        'placeholder' => 'Description',
                                    ])
                                </div>
                                @include('components.input', [
                                    'value' => old('video'),
                                    'name' => 'video',
                                    'type' => 'file',
                                    'label' => 'Video',
                                    'placeholder' => 'Video',
                                ])
                                <hr>
                                <div class="card-header m-0">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">{{ __('models.Feature') }}</h3>
                                    </div>
                                </div>

                                <div id="features">
                                    <div data-repeater-list="features">
                                        <div data-repeater-item>
                                            <br>
                                            <div class="d-flex gap-2">
                                                <div class="col mb-5">
                                                    <label class="form-label">{{ __('models.feature name') }}</label>
                                                    <input type="text" class="form-control @error('features.*.name') is-invalid @enderror" name="features[][name]" placeholder="{{ __('models.feature name') }}" value="{{ old('features.*.name') }}" />
                                                    @error('features.*.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col mb-5">
                                                    <label class="form-label">{{ __('models.feature rate') }}</label>
                                                    <input type="text" class="form-control @error('features.*.rate') is-invalid @enderror" name="features[][rate]" placeholder="{{ __('models.feature rate') }}" value="{{ old('features.*.rate') }}" />
                                                    @error('features.*.rate')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-1 mb-5">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                        <i class="fa fa-trash fs-3"></i>{{ __('models.Delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group justify-content-center">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="fa fa-plus"></i>{{ __('models.Add More Items') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex pt-5 justify-content-end align-items-center">
                                    <button class="btn btn-primary">
                                        {{ __('models.Add') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#features').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm("Are you sure you want to delete this element?")) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection
