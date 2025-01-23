@extends('layouts.dashboard.app')
@section('header__title', __('home.promo_codes'))
@section('header__icon', 'fa-solid fa-tag')
@section('main')
<div class="content-wrapper">
    <div class="p-3 container-p-y">
        <div class="card">
            <div class="d-flex align-item-center p-4 justify-content-between w-100">
                <h5 class="card-header p-0">{{ __('home.promo_codes') }}</h5>
                <div class="d-flex align-item-center gap-3">
                    <button id="deleteSelected" class="btn btn-danger">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                    <a href="{{ route('promo_codes.create') }}">
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
                        {{-- <input class="form-control" type="date" id="filter_date" /> --}}
                    </div>
                </div>
            </div>
            <div class="table-responsive text-nowrap px-4">
                <table class="table" id="myTable">
                    <thead>
                        <tr class="text-nowrap">
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    <input class="form-check-input row__check" type="checkbox" value="" id="check__box" />
                                    {{ __('home.Code') }}
                                </div>
                            </th>
                            <th>{{ __('home.Type') }}</th>
                            <th>{{ __('home.Value') }}</th>
                            <th>{{ __('home.Category') }}</th>
                            <th>{{ __('home.Place') }}</th>
                            <th>{{ __('home.Activation') }}</th>
                            <th>{{ __('home.end_date') }}</th>
                            <th>{{ __('home.Edit') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $offer)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center gap-2">
                                        <input class="form-check-input row__check" type="checkbox" value="{{ $offer->id }}" />
                                        {{ $offer->code }}
                                    </div>
                                </th>
                                <td>{{ $offer->type }}</td>
                                <td>{{ $offer->value }}</td>
                                <td>{{ $offer->category ? $offer->category->name : 'N/A' }}</td>
                                <td>{{ $offer->type_category_id ? $offer->typeCategory->name : 'N/A' }}</td>
                                <td class="">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-activation" type="checkbox"
                                                id="flexSwitchCheckChecked{{ $offer->id }}"
                                                data-id="{{ $offer->id }}" {{ $offer->is_active ? 'checked' : '' }} />
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $offer->end_date }}</td>
                                <td class="">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('promo_codes.edit', $offer->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i> {{ __('home.Edit') }}</a>
                                            <a class="dropdown-item cursor-pointer" data-bs-toggle="modal"
                                                data-bs-target="#modalToggle{{$offer->id}}"><i class="bx bx-trash me-1"></i>
                                                {{ __('home.Delete') }}</a>
                                        </div>
                                    </div>
                                    @include('components.modalDelete', [
                                        'action' => 'promo_codes.destroy',
                                        'name' => $offer->name,
                                        'title' => __('home.Are You Sure You Want to Delete?'),
                                        'modalToggle' => 'modalToggle'.$offer->id,
                                        'id' => $offer->id,
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
                var dateColumn = data[4]; // Assuming the date column is the 5th column (index 4)

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
                    url: "{{ route('promo_codes.deleteSelected') }}",
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
            var adminId = $(this).data('id');
            $.ajax({
                url: "{{ route('promo_codes.toggleActivation') }}",
                type: "POST",
                data: { id: adminId },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response);
                    if (response.success) {
                        toastr.success(response.is_active ? 'promo_codes activated' : 'promo_codes deactivated');
                    } else {
                        toastr.error('Failed to update promo_codes status');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error('Failed to update promo_codes status');
                }
            });
        });
    });
</script>
@endsection
