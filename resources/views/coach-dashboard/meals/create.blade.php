@extends('layouts.coach-dashboard.app')
@section('header__title', __('home.meals'))
@section('header__icon', 'bx bx-list-ul')

@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Add') }} {{ __('home.meal') }}</h5>
                            <a href="{{ route('coach.meals.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2"> <i
                                        class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('coach.meals.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('name'),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'label' => 'Name',
                                        'placeholder' => 'Package Name',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('desc'),
                                        'name' => 'desc',
                                        'type' => 'text',
                                        'label' => 'desc',
                                        'placeholder' => 'desc',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('amount'),
                                        'name' => 'amount',
                                        'type' => 'text',
                                        'label' => 'amountt',
                                        'placeholder' => 'gram 1-1000',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('fat'),
                                        'name' => 'fat',
                                        'type' => 'text',
                                        'label' => 'fat',
                                        'placeholder' => 'gram 1-1000',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('protein'),
                                        'name' => 'protein',
                                        'type' => 'text',
                                        'label' => 'protein',
                                        'placeholder' => 'gram 1-1000',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('carbohydrate'),
                                        'name' => 'carbohydrate',
                                        'type' => 'text',
                                        'label' => 'carbohydrate',
                                        'placeholder' => 'gram 1-1000',
                                    ])
                                </div>

                                {{-- <div class="col-md-12 mt-3">
                                    <h5> {{ __('home.to') }}:</h5>
                                    <select name="trainee_ids[]" class="form-control" multiple>
                                        @foreach($trainees as $trainee)
                                            <option value="{{ $trainee->id }}">{{ $trainee->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-12">
                                    <label for="trainee_ids">{{ __('home.trainees') }}</label>
                                    <select id="trainee_ids" name="trainee_ids[]" class="form-control" multiple required>
                                        @foreach($trainees as $trainee)
                                            <option value="{{ $trainee->id }}" {{ in_array($trainee->id, old('trainee_ids', [])) ? 'selected' : '' }}>
                                                {{ $trainee->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('trainee_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
