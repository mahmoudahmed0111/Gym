@extends('layouts.trainee-dashboard.app')
@section('header__title', __('home.landing-slider'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.landing-slider') }}</h5>
                            <a href="{{ route('landing-slider.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i
                                        class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('trainee.progress.update',$progress->id) }}" method="POST" class="row" enctype="multipart/form-data">
                                @method("put")
                                @csrf

                                @include('components.input', [
                                    'value' => old('img'),
                                    'name' => 'img',
                                    'type' => 'file',
                                    'label' => 'Image',
                                    'placeholder' => '',
                                ])

                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('upload_date', $progress->upload_date),
                                        'name' => 'upload_date',
                                        'type' => 'date',
                                        'label' => 'upload_date',
                                        'placeholder' => 'upload_date',
                                    ])
                                </div>




                            <br> <br>
                                <div class="d-flex align-items justify-content-end">
                                    @include('components.button', [
                                        'type' => 'submit',
                                        'name' => 'edit',
                                    ])
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection


