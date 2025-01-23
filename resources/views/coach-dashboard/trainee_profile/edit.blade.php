@extends('layouts.coach-dashboard.app')
@section('header__title', __('home.trainees'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Edit') }} {{ __('home.trainee') }}</h5>
                            <a href="{{ route('coach.trainees-profile.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i
                                        class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('coach.trainees-profile.update',$data->id) }}" method="POST" class="row" enctype="multipart/form-data">
                                @method("put")
                                @csrf



                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('age', $data->age),
                                        'name' => 'age',
                                        'type' => 'num',
                                        'label' => 'age',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('weight', $data->weight),
                                        'name' => 'weight',
                                        'type' => 'num',
                                        'label' => 'weight',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('height', $data->height),
                                        'name' => 'height',
                                        'type' => 'num',
                                        'label' => 'height',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('bmi', $data->bmi),
                                        'name' => 'bmi',
                                        'type' => 'num',
                                        'label' => 'bmi',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('body_fat_percentage', $data->body_fat_percentage),
                                        'name' => 'body_fat_percentage',
                                        'type' => 'num',
                                        'label' => 'body_fat_percentage',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('body_water_percentage', $data->body_water_percentage),
                                        'name' => 'body_water_percentage',
                                        'type' => 'num',
                                        'label' => 'body_water_percentage',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('muscle_mass', $data->muscle_mass),
                                        'name' => 'muscle_mass',
                                        'type' => 'num',
                                        'label' => 'muscle_mass',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('resting_heart_rate', $data->resting_heart_rate),
                                        'name' => 'resting_heart_rate',
                                        'type' => 'num',
                                        'label' => 'resting_heart_rate',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('blood_pressure', $data->blood_pressure),
                                        'name' => 'blood_pressure',
                                        'type' => 'num',
                                        'label' => 'blood_pressure',
                                        'placeholder' => 'number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('gender', $data->gender),
                                        'name' => 'gender',
                                        'type' => 'text',
                                        'label' => 'gender',
                                        'placeholder' => '',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('status', $data->status),
                                        'name' => 'status',
                                        'type' => 'text',
                                        'label' => 'status',
                                        'placeholder' => '',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('health_conditions', $data->health_conditions),
                                        'name' => 'health_conditions',
                                        'type' => 'text',
                                        'label' => 'health_conditions',
                                        'placeholder' => '',
                                    ])
                                </div>





                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('membership_start_date', $data->membership_start_date),
                                        'name' => 'membership_start_date',
                                        'type' => 'date',
                                        'label' => 'membership_start_date',
                                        'placeholder' => 'date',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('membership_end_date', $data->membership_end_date),
                                        'name' => 'membership_end_date',
                                        'type' => 'date',
                                        'label' => 'membership_end_date',
                                        'placeholder' => 'number',
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

@section('scripts-dashboard')
@include('coach-dashboard.trainees.mab')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script>
        $('#search_input').on('keyup', function() {
            table.search(this.value).draw();
        });
        $(document).ready(function() {
            // When the header checkbox is clicked
            $('#check__box').click(function() {
                // Check if it's checked or not
                var isChecked = $(this).prop('checked');

                // Iterate through each row in the table
                $('#myTable tbody tr').each(function() {
                    // Set the checkbox in each row to the same state as the header checkbox
                    $(this).find('.form-check-input.row__check').prop('checked', isChecked);
                });
            });
        });
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>
@endsection
