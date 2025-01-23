@extends('layouts.dashboard.app')

@section('header__title', __('home.users'))
@section('header__icon', 'fa-solid fa-users')

@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.users') }}</h5>
                            <a href="{{ route('coachs.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('coachs.update', $data->id) }}" method="POST" class="row" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('name', $data->name),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'label' => 'Name',
                                        'placeholder' => 'belal zeina',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('email', $data->email),
                                        'name' => 'email',
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'a@a.com',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('mobile', $data->mobile),
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
                                        'placeholder' => '******',
                                    ])
                                </div>

                                <div class="col-md-6">
                                    @include('components.select', [
                                        'options' => $countries,
                                        'name' => 'country_id',
                                        'label' => 'Country',
                                    ])
                                </div>

                                <div class="col-md-6">
                                    <select id="city" name="city_id" class="form-select form-select-lg">
                                        <option value="">Select City</option>
                                        <!-- Cities will be populated here via AJAX -->
                                    </select>
                                </div>

                                <div class="col-md-12 mt-4">
                                    @include('components.input', [
                                        'value' => old('img'),
                                        'name' => 'img',
                                        'type' => 'file',
                                        'label' => 'Image',
                                        'placeholder' => '',
                                    ])
                                </div>

                                <div class="col-md-12 mt-4 d-flex justify-content-end">
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

@section('scripts-dashboard')
    @include('dashboard.coachs.mab')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable');

            $('#search_input').on('keyup', function() {
                table.search(this.value).draw();
            });

            $('#check__box').click(function() {
                var isChecked = $(this).prop('checked');
                $('#myTable tbody tr').each(function() {
                    $(this).find('.form-check-input.row__check').prop('checked', isChecked);
                });
            });

            // AJAX to fetch cities based on country selection
            $('select[name="country_id"]').on('change', function() {
                var countryID = $(this).val();
                if (countryID) {
                    $.ajax({
                        url: '/get-cities/' + countryID,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        },
                        error: function() {
                            $('select[name="city_id"]').empty();
                            $('select[name="city_id"]').append('<option value="">No Cities Found</option>');
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty();
                    $('select[name="city_id"]').append('<option value="">Select City</option>');
                }
            });
        });
    </script>
@endsection
