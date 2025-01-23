@extends('layouts.coach-dashboard.app')
@section('header__title', __('home.system_support'))
@section('header__icon', 'fa-solid fa-gear')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">

                        <div class="card-body">
                            <form action="{{ route('coach.supports.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 mb-2">
                                <textarea name="message" class="form-control  @error("message") is-invalid @enderror " id="" style="min-height: 100px" >
                                    {{old("message")}}
                                </textarea>
                                @error("message")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                </div>

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
    </div>
@endsection


