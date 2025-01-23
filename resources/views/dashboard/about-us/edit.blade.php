@extends('layouts.dashboard.app')

@section('header__title', __('home.about-us'))
@section('header__icon', 'bx bx-food-menu')

@section('main')
    <div class="content-wrapper">
        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="d-flex p-3 px-4 align-items-center justify-content-between w-100">
                            <h5 class="card-header p-0">{{ __('home.Edit') }} </h5>
                            <a href="{{ route('about-us.index') }}" style="width: fit-content">
                                <button type="button" class="btn btn-dark d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-backward"></i>
                                    {{ __('home.Back') }}
                                </button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('about-us.update', $aboutus->id) }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-md-12 required">
                                    @include('components.input', [
                                        'value' => $aboutus->description,
                                        'name' => 'description',
                                        'type' => 'text',
                                        'label' => __('home.description'),
                                        'placeholder' => __('home.description'),
                                    ])
                                </div>
                                <div class="col-md-6 required">
                                    @include('components.input', [
                                        'value' => $aboutus->video ?? old('video'),
                                        'name' => 'video',
                                        'type' => 'file',
                                        'label' => __('home.video'),
                                        'placeholder' => 'Video',
                                    ])
                                </div>
                                <hr>
                                <div class="card-header m-0">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">{{ __('models.Feature') }}</h3>
                                    </div>
                                </div>
                                <div id="features">
                                    <div data-repeater-list="features">
                                        @foreach ($aboutus->features as $feature)
                                        <div data-repeater-item>
                                            <br>
                                            <div class="d-flex gap-2">
                                                <div class="col mb-5">
                                                    <label class="form-label">{{ __('models.feature name') }}</label>
                                                    <input type="text" class="form-control @error('features.*.name') is-invalid @enderror" name="features[][name]" placeholder="{{ __('models.feature name') }}" value="{{ $feature->name }}" />
                                                    @error('features.*.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col mb-5">
                                                    <label class="form-label">{{ __('models.feature rate') }}</label>
                                                    <input type="text" class="form-control @error('features.*.rate') is-invalid @enderror" name="features[][rate]" placeholder="{{ __('models.feature rate') }}" value="{{ $feature->rate }}" />
                                                    @error('features.*.rate')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-lg-1 mb-5">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-9">
                                                        <i class="fa fa-trash fs-3"></i>{{ __('models.Delete') }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group justify-content-center">
                                        <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                            <i class="fa fa-plus"></i>{{ __('models.Add More Items') }}
                                        </a>
                                    </div>
                                </div>
                                <div class="d-flex pt-5 justify-content-end align-items-center">
                                    <button class="btn btn-primary">
                                        {{ __('home.Update') }}
                                    </button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#features').repeater({
                initEmpty: false,
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm("Are you sure you want to delete this element?")) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection
{{-- @section('scripts-dashboard')
<link href="{{ asset('asset/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
<script>
    $(document).ready(function() {
        // DataTable initialization with export buttons
        let table = $('#myTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "order": [], // Disable initial ordering
            "lengthMenu": [10, 25, 50, 100]
        });

        // Custom filter function for date
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var filterDate = $('#filter_date').val();
                var dateColumn = data[3]; // Assuming the date column is the 4th column (index 3)

                if (filterDate === '') {
                    return true; // No filter applied
                }

                // Convert dates to comparable formats
                var filterDateObj = new Date(filterDate);
                var dateColumnObj = new Date(dateColumn);

                if (dateColumnObj.getTime() === filterDateObj.getTime()) {
                    return true;
                }

                return false;
            }
        );

        // Event listener for the date input
        $('#filter_date').on('change', function() {
            table.draw();
        });

        // When the header checkbox is clicked
        $('#check__box').click(function() {
            var isChecked = $(this).prop('checked');
            $('#myTable tbody tr').each(function() {
                $(this).find('.form-check-input.row__check').prop('checked', isChecked);
            });
        });

        // Search functionality
        $('#search_input').on('keyup', function() {
            table.search(this.value).draw();
        });

        // Delete selected rows
        $('#deleteSelected').click(function() {
            var selectedIds = [];
            $(".row__check:checked").each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                $.ajax({
                    url: "{{ route('about-us.deleteSelected') }}",
                    type: "POST",
                    data: { ids: selectedIds },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        toastr.success("{{ __('models.deleted_successfully')}}");
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error(xhr.responseText);
                    }
                });
            } else {
                alert("Please select at least one item to delete.");
            }
        });

        // Handle page length change
        $('select[name="myTable_length"]').on('change', function() {
            var length = $(this).val();
            table.page.len(length).draw();
        });


    });
</script> --}}
