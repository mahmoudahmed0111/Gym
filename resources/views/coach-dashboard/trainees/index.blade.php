@extends('layouts.coach-dashboard.app')
@section('header__title', __('home.trainees'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="p-3 container-p-y">
            <div class="card">
                <div class="d-flex align-item-center p-4 justify-content-between w-100">
                    <h5 class="card-header p-0">{{ __('home.trainees') }}</h5>
                    <div class="d-flex align-item-center gap-3">
                        <button id="deleteSelected" class="btn btn-danger">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                        <a href="{{ route('coach.trainees.create') }}">
                            <button type="button" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="fa-solid fa-plus"></i>{{ __('home.Add') }}
                            </button>
                        </a>
                    </div>
                </div>
                <div class="d-flex align-item-center justify-content-between gap-3 mb-4 px-4">
                    <div class="d-flex groups__button align-item-center gap-3">
                        <input type="text" class="form-control" style="width:200px" id="search_input"
                            placeholder="{{ __('home.Search') }}" aria-describedby="defaultFormControlHelp" />
                        <select name="myTable_length" aria-controls="myTable" class="dt-input" id="dt-length-0"
                            fdprocessedid="0z9mam">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="">
                            <input class="form-control" type="date" id="filter_date" />
                        </div>

                        <div class="exports mx-0 px-0">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ __('home.Export') }}
                            </button>
                            <ul class="dropdown-menu">

                                <li><a class="dropdown-item" href="javascript:void(0);"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm8 7h-1V4l5 5h-4z"
                                                fill="#888888" />
                                        </svg>{{ __('home.Csv') }}</a>
                                </li>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="text-nowrap">

                                <th>
                                    <div class="d-flex align-items-center gap-2">#
                                        <input class="form-check-input row__check" type="checkbox" value=""
                                            id="check__box" />
                                        {{ __('home.Name') }}
                                    </div>
                                </th>
                                <th>{{ __('home.Email') }}</th>
                                <th>{{ __('home.Phone Number') }}</th>

                                <th>{{ __('home.category') }}</th>
                                <th>{{ __('home.package') }}</th>
                                <th>{{ __('home.Activation') }}</th>
                                <th>{{ __('home.Edit') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($data as $trainee)
                            @php
                                $i++;
                            @endphp
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center gap-2">
                                            {{ $i }}
                                            <input class="form-check-input row__check" type="checkbox" value="{{ $trainee->id }}" />
                                            <img src={{ image_url( $trainee->img) }} alt
                                                class="w-px-30 h-auto rounded-circle" />
                                            {{ $trainee->name }}
                                        </div>
                                    </th>
                                    <td> {{ $trainee->email }}</td>
                                    <td> {{ $trainee->mobile }}</td>

                                    <td>{{ $trainee->category->name ?? 'N/A' }}</td>
                                    <td>{{ $trainee->package ? $trainee->package->name : 'No Package Assigned' }}</td>
                                    <td class="">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-activation" type="checkbox"
                                                    id="flexSwitchCheckChecked{{ $trainee->id }}"
                                                    data-id="{{ $trainee->id }}" {{ $trainee->is_active ? 'checked' : '' }} />
                                            </div>
                                        </div>
                                    </td>

                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('coach.trainees.edit', $trainee->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> {{ __('home.Edit') }}</a>
                                                <a class="dropdown-item cursor-pointer" data-bs-toggle="modal"
                                                    data-bs-target="#modalToggle{{$trainee->id}}"><i class="bx bx-trash me-1"></i>
                                                    {{ __('home.Delete') }}</a>
                                                <a class="dropdown-item" href="{{ route('coach.trainees.show', $trainee->id) }}"><i
                                                        class="bx bx-show me-1"></i> {{ __('home.show') }}</a>
                                                <a class="dropdown-item" href="{{ route('coach.trainees.progress', $trainee->id) }}"><i
                                                        class="fas fa-dumbbell"></i> {{ __('home.progress') }}</a>
                                            </div>
                                        </div>
                                        @include('components.modalDelete', [
                                            'action' => 'coach.trainees.destroy',
                                            'name' => $trainee->name,
                                            'title' => __('home.Are You Delete'),
                                            'modalToggle' => 'modalToggle'.$trainee->id,
                                            'id' => $trainee->id,
                                        ])
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-dashboard')
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
                        url: "{{ route('coach.trainees.deleteSelected') }}",
                        type: "POST",
                        data: { ids: selectedIds },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            console.log(response);
                            location.reload();
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
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

            // Toggle activation
            $('.toggle-activation').change(function() {
                var traineeId = $(this).data('id');
                $.ajax({
                    url: "{{ route('coach.trainees.toggleActivation') }}",
                    type: "POST",
                    data: { id: traineeId },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            toastr.success(response.is_active ? 'Trainee activated' : 'Trainee deactivated');
                        } else {
                            toastr.error('Failed to update trainee status');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error('Failed to update trainee status');
                    }
                });
            });
        });
    </script>


@endsection
