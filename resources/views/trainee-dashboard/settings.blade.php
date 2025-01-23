@extends('layouts.trainee-dashboard.app')
@section('header__title', __('home.admins'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4 ">

                        <div class="card-body">
                            <form action="{{ route('trainee.settings.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('name',$data->name),
                                        'name' => 'name',
                                        'type' => 'text',
                                        'label' => 'Name',
                                        'placeholder' => 'mahmoud ahmed',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('email',$data->email),
                                        'name' => 'email',
                                        'type' => 'email',
                                        'label' => 'Email',
                                        'placeholder' => 'a@a.com',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('mobile',$data->mobile),
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
                                    @include('components.input', [
                                        'value' => old('start_time',$data->start_time),
                                        'name' => 'start_time',
                                        'type' => 'time',
                                        'label' => 'start_time',
                                        'placeholder' => '',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('end_time',$data->end_time),
                                        'name' => 'end_time',
                                        'type' => 'time',
                                        'label' => 'end_time',
                                        'placeholder' => '',
                                    ])
                                </div>

                                @include('components.input', [
                                    'value' => old('img'),
                                    'name' => 'img',
                                    'type' => 'file',
                                    'label' => 'Image',
                                    'placeholder' => '',
                                ])

                                <div class="form-group mb-3">
                                    <label for="example-multiple-select">Select Categories</label>
                                    <select id="example-multiple-select" name="category_id[]" multiple="multiple" class="form-control">
                                        @foreach ($categories as $category)
                                            <option {{ isset($data) && $data->categories()->where('category_id', $category->id)->first() ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                @foreach ($categories as $category)
                                    <div class="form-group mb-3 duration-input" id="duration-wrapper-{{ $category->id }}" style="display: none;">
                                        <label for="duration_{{ $category->id }}">Duration for {{ $category->name }}</label>
                                        <input type="text" id="duration_{{ $category->id }}" name="category_durations[{{ $category->id }}]" class="form-control" value="{{ isset($data) ? $data->categories()->where('category_id', $category->id)->first()?->pivot?->duration/60 : '' }}">
                                    </div>
                                @endforeach

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

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Select2 JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-multiple-select').select2({
            placeholder: "Select options",
            allowClear: true
        }).on('select2:select select2:unselect', function(e) {
            toggleDurationInputs();
        });

        // Initialize the display based on the current selection
        toggleDurationInputs();

        function toggleDurationInputs() {
            var selectedCategories = $('#example-multiple-select').val() || [];
            $('.duration-input').each(function() {
                var categoryId = $(this).attr('id').replace('duration-wrapper-', '');
                if (selectedCategories.includes(categoryId)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
</script>
@endsection
