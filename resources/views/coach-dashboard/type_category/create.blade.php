<!-- resources/views/club-dashboard/type_category/create.blade.php -->

@extends('layouts.coach-dashboard.app')
@section('header__title', __('home.type_category'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.type_category') }}</h5>
                            <a href="{{ route('club.type_category.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('club.type_category.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('name'),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'label' => 'name',
                                        'placeholder' => 'Offer name',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('number'),
                                        'name' => 'number',
                                        'type' => 'number',
                                        'label' => 'number',
                                        'placeholder' => 'number',
                                        // 'options' => ['percentage' => 'Percentage', 'fixed' => 'Fixed Amount'],
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('price'),
                                        'name' => 'price',
                                        'type' => 'number',
                                        'label' => 'price',
                                        'placeholder' => 'price',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('category_id'),
                                        'name' => 'category_id',
                                        'type' => 'select',
                                        'label' => 'category',
                                        'placeholder' => 'xategory',
                                        'options' => $categories->pluck('name', 'id')->toArray(),
                                    ])
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

@section('scripts-dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
@endsection
