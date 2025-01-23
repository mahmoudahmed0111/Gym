@extends('layouts.dashboard.app')

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
                        <a href="{{ route('promo_codes.index') }}" style="width: fit-content">
                            <button type="button" class="btn btn-dark d-flex align-items-center gap-2">
                                <i class="fa-solid fa-backward"></i>
                                {{ __('home.Back') }}
                            </button>
                        </a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('promo_codes.store') }}" method="POST" class="row" enctype="multipart/form-data">
                            @csrf

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('code'),
                                    'name' => 'code',
                                    'type' => 'text',
                                    'label' => 'Code',
                                    'placeholder' => 'Enter promo code',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('type'),
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
                                    'value' => old('value'),
                                    'name' => 'value',
                                    'type' => 'number',
                                    'label' => 'Value',
                                    'placeholder' => 'Enter value',
                                    'step' => '0.01',
                                    'option' => "required"
                                ])
                            </div>


                            <div class="col-md-6 category-field">
                                @include('components.input', [
                                    'value' => old('category_product_id'),
                                    'name' => 'category_product_id',
                                    'type' => 'select',
                                    'label' => 'Category',
                                    'placeholder' => 'Select category',
                                    'options' => ['' => 'Select category'] + $categories->pluck('name', 'id')->toArray(),
                                    'option' => ""
                                ])
                            </div>


                            <div class="col-md-6 product-field">
                                @include('components.input', [
                                    'value' => old('product_id'),
                                    'name' => 'product_id',
                                    'type' => 'select',
                                    'label' => 'Product',
                                    'placeholder' => 'Select product',
                                    'options' =>  ['' => 'Select product'] + $products->pluck('name', 'id')->toArray(),
                                    'option' => ""
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('start_date'),
                                    'name' => 'start_date',
                                    'type' => 'date',
                                    'label' => 'Start Date',
                                    'placeholder' => 'Select start date',
                                    'option' => "required"
                                ])
                            </div>

                            <div class="col-md-6 required">
                                @include('components.input', [
                                    'value' => old('end_date'),
                                    'name' => 'end_date',
                                    'type' => 'date',
                                    'label' => 'End Date',
                                    'placeholder' => 'Select end date',
                                    'option' => "required"
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
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script> --}}
{{-- <script>
    $(document).ready(function() {
        function toggleFields() {
            const scope = $('#applicable_scope').val();
            if (scope === 'booking') {
                $('.category-field').show();
                $('.product-field').hide().prop('disabled', true);
                $('#product_id').prop('disabled', true);
                $('#category_id, #type_category_id').prop('disabled', false);
            } else if (scope === 'product') {
                $('.product-field').show().prop('disabled', false);
                $('.category-field').hide();
                $('#category_id, #type_category_id').prop('disabled', true);
                $('#product_id').prop('disabled', false);
            }
        }

        toggleFields(); // Initial call

        $('#applicable_scope').change(function() {
            toggleFields();
        });
    });
</script> --}}
@endsection
