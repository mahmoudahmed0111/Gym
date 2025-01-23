
@extends('layouts.club-dashboard.app')

@section('header__title', __('home.promo_codes'))
@section('header__icon', 'fa-solid fa-tags')
@section('main')
<div class="content-wrapper">
    <div class="p-3 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                        <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.promo_code') }}</h5>
                        <a href="{{ route('club.promo_codes.index') }}" style="width: fit-content">
                            <button type="button" class="btn btn-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-backward"></i>
                                {{ __('home.Back') }}
                            </button>
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('club.promo_codes.update',$data->id) }}" method="POST" class="row" enctype="multipart/form-data">
                            @method("put")
                            @csrf

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('code',$data->code),
                                    'name' => 'code',
                                    'type' => 'text',
                                    'label' => 'Code',
                                    'placeholder' => 'Enter promo code',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('type',$data->type),
                                    'name' => 'type',
                                    'type' => 'select',
                                    'label' => 'Type',
                                    'placeholder' => 'Select type',
                                    'options' => ['percentage' => 'Percentage', 'fixed' => 'Fixed Amount'],
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('value',$data->value),
                                    'name' => 'value',
                                    'type' => 'number',
                                    'label' => 'Value',
                                    'placeholder' => 'Enter value',
                                    'step' => '0.01',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('category_id', $data->category_id),
                                    'name' => 'category_id',
                                    'type' => 'select',
                                    'label' => 'Category',
                                    'placeholder' => 'Select category',
                                    'options' =>  ['' => 'None'] + $categories->pluck('name', 'id')->toArray(),
                                    'option' => ""
                                ])
                            </div>

                            {{-- <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('product_id'),
                                    'name' => 'product_id',
                                    'type' => 'select',
                                    'label' => 'Product',
                                    'placeholder' => 'Select product',
                                    'options' => $products->pluck('name', 'id')->toArray(),
                                    'option' => ""
                                ])
                            </div> --}}





                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('start_date', $data->start_date),
                                    'name' => 'start_date',
                                    'type' => 'date',
                                    'label' => 'Start Date',
                                    'placeholder' => 'Select start date',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('end_date', $data->end_date),
                                    'name' => 'end_date',
                                    'type' => 'date',
                                    'label' => 'End Date',
                                    'placeholder' => 'Select end date',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('start_time',  $data->start_time),
                                    'name' => 'start_time',
                                    'type' => 'time',
                                    'label' => 'Start Time',
                                    'placeholder' => 'Select start time',
                                    'option' => ""
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('end_time', $data->end_time),
                                    'name' => 'end_time',
                                    'type' => 'time',
                                    'label' => 'End Time',
                                    'placeholder' => 'Select end time',
                                    'option' => ""
                                ])
                            </div>

                            <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('img'),
                                    'name' => 'img',
                                    'type' => 'file',
                                    'label' => 'Image',
                                    'placeholder' => 'Upload an image',
                                    'option' => ""
                                ])
                            </div>
                            <div class="col-md-6">
                                @include('components.input', [
                                    'value' => old('type_category_id', $data->type_category_id),
                                    'name' => 'type_category_id',
                                    'type' => 'select',
                                    'label' => 'Type Category',
                                    'placeholder' => 'Select type category',
                                    'options' => ['' => 'None'] + $typeCategories->pluck('name', 'id')->toArray(),
                                    'option' => ""
                                ])
                            </div>
                            {{-- <div class="col-md-6 option required">
                                @include('components.input', [
                                    'value' => old('applicable_scope'),
                                    'name' => 'applicable_scope',
                                    'type' => 'select',
                                    'label' => 'Applicable Scope',
                                    'placeholder' => 'Select scope',
                                    'options' => ['booking' => 'Booking', 'product' => 'Product'],
                                    'option' => "required"
                                ])
                            </div> --}}

                            <div class="d-flex align-items justify-content-end">
                                @include('components.button', [
                                    'type' => 'submit',
                                    'name' => 'Add Promo Code',
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
