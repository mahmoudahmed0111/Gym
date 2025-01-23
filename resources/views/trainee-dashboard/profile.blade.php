@extends('layouts.trainee-dashboard.app')

@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">

            <div class="row">
                <div class="col-md-12">

                    <div class="card mb-4">
                        <h5 class="card-header">Trainee Details</h5>
                        <!-- Account -->
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                <img src="{{ image_url( $data->img) }}" alt="clubs-avatar" class="d-block rounded"
                                    height="100" width="100" id="uploadedAvatar" />
                                <div class="button-wrapper w-100">
                                    <h3>{{ $data->name }}</h3>
                                    <div class="mb-3 w-100  col-md-6">
                                        <label for="status" class="form-label" style="color: black;">Status:</label>
                                        <span class="w-100 bg-label-{{ $data->is_active ? 'primary' : 'danger' }}  p-1 rounded">
                                            {{ $data->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <div class="card-body">
                            <form id="formAccountSettings" method="POST" onsubmit="return false">
                                <div class="row ">
                                    <div class="mb-3 col-md-6">
                                        <label for="name" class="form-label" style="color: red;">{{ __('home.Name') }}:</label>
                                        <h4>{{ $data->name }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label" style="color: red;">{{ __('home.Email') }}:</label>
                                        <h4>{{ $data->email }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="form-label" style="color: red;">{{ __('home.Phone Number') }}:</label>
                                        <h4>{{ $data->mobile }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="age" class="form-label" style="color: red;">{{ __('home.age') }}:</label>
                                        <h4>{{ optional($data->profile)->age }} </h4>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label" style="color: red;">{{ __('home.category') }}:</label>
                                        <h4>{{ $data->category->name }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label" style="color: red;">{{ __('home.package') }}:</label>
                                        <h4>{{ $data->package->name }}</h4>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="country" class="form-label" style="color: red;">{{ __('home.location') }}:</label>
                                        <h4>{{ $data->location }}</h4>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="weight" class="form-label" style="color: red;">{{ __('home.weight') }}:</label>
                                        <h4>{{ optional($data->profile)->weight }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="height" class="form-label" style="color: red;">{{ __('home.height') }}:</label>
                                        <h4>{{ optional($data->profile)->height }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="bmi" class="form-label" style="color: red;">{{ __('home.bmi') }}:</label>
                                        <h4>{{ optional($data->profile)->bmi }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="body_fat_percentage" class="form-label" style="color: red;">{{ __('home.body_fat_percentage') }}:</label>
                                        <h4>{{ optional($data->profile)->body_fat_percentage }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="body_water_percentage" class="form-label" style="color: red;">{{ __('home.body_water_percentage') }}:</label>
                                        <h4>{{ optional($data->profile)->body_water_percentage }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="muscle_mass" class="form-label" style="color: red;">{{ __('home.muscle_mass') }}:</label>
                                        <h4>{{ optional($data->profile)->muscle_mass }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="resting_heart_rate" class="form-label" style="color: red;">{{ __('home.resting_heart_rate') }}:</label>
                                        <h4>{{ optional($data->profile)->resting_heart_rate }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="blood_pressure" class="form-label" style="color: red;">{{ __('home.blood_pressure') }}:</label>
                                        <h4>{{ optional($data->profile)->blood_pressure }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="health_conditions" class="form-label" style="color: red;">{{ __('home.health_conditions') }}:</label>
                                        <h4>{{ optional($data->profile)->health_conditions }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="membership_start_date" class="form-label" style="color: red;">{{ __('home.membership_start_date') }}:</label>
                                        <h4>{{ optional($data->profile)->membership_start_date }}</h4>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="membership_end_date" class="form-label" style="color: red;">{{ __('home.membership_end_date') }}:</label>
                                        <h4>{{ optional($data->profile)->membership_end_date }}</h4>
                                    </div>


                                </div>
                            </form>
                        </div>
                        <!-- /Account -->
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-dashboard')
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
