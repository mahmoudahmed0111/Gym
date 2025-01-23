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
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.trainee') }}</h5>
                            <a href="{{ route('coach.trainees.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i
                                        class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('coach.trainees.store') }}" method="POST" class="row" enctype="multipart/form-data">
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

                                <div class="col-md-6">
                                    <label for="example-select">Select Category</label>
                                    <select id="example-select" name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $trainee->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="package_id">Select Package</label>
                                    <select id="package_id" name="package_id" class="form-control" required>

                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                                                {{ $package->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('package_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                @include('components.input', [
                                    'value' => old('img'),
                                    'name' => 'img',
                                    'type' => 'file',
                                    'label' => 'Image',
                                    'placeholder' => '',
                                ])
                                {{-- <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('country'),
                                        'name' => 'country',
                                        'type' => 'text',
                                        'label' => 'country',
                                        'placeholder' => 'Egypt',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('city'),
                                        'name' => 'city',
                                        'type' => 'text',
                                        'label' => 'city',
                                        'placeholder' => 'Cairo',
                                    ])
                                </div> --}}



                            <div class="col-md-12 col-12 mb-1">
                                <div class="d-flex col-md-12 flex-column mb-7 fv-row fv-plugins-icon-container">
                                        <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                            <span class="required" style="font-weight:bold">
                                                {{ __('models.location') . ' ('.__('models.search_in_map').')' }}
                                            </span>

                                        </label>
                                            <input type="text"  name="icon"  class="form-control form-control-solid" id="searchInput" value="{{ old('location') }}" >

                                </div>
                                @error("location")
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                                <br>
                            </div>

                            <div class="col-md-12 col-12 mb-3">
                                <div class="d-flex col-12 flex-column mb-7 fv-row fv-plugins-icon-container" style="height:100vh">
                                    <input type="hidden" name="location" class="form-control" id="location"  value="{{ old('location' ) }}">
                                    <input type="hidden" name="lat" class="form-control" id="lat"  value="{{ old('lat' ) }}">
                                    <input type="hidden" name="lng" class="form-control" id="lng"  value="{{ old('lng') }}">
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
