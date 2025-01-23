@extends('layouts.dashboard.app')

@section('header__title', __('home.bookings'))
@section('header__icon', 'fa-solid fa-users')

@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <style>
            .my-btns{
                /* display: flex; */
                /* gap: 10px; */
                margin:10px ;
            }
            @media print {
                body {
                    direction: rtl; /* Right-to-left direction */
                    font-family: 'Tajawal', sans-serif; /* Use an Arabic-supporting font */
                }
            }

        </style>
        <div class="p-3 container-p-y">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">{{ __('home.booking_details') }}</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>{{ __('home.Club Name') }}:</strong> {{ $booking->club->name }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('models.user') }}:</strong> {{ $booking->user->name ?? __('home.not_available') }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('models.category') }}:</strong> {{ $booking->category->name }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('models.place') }}:</strong> {{ $booking->type_category->name }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('models.price') }}:</strong> {{ $booking->price }}
                    </div>
                    <div class="mb-3">
                        <strong>{{ __('models.date') }}:</strong> {{ $booking->booking_date }}
                    </div>

                    <a href="{{ route("reports.booking") }}" class="btn btn-primary">
                        <i class="fa-solid fa-arrow-left"></i> {{ __('home.Back') }}
                    </a>
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
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            // DataTable initialization with export buttons
            let table = $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [

                    {
                        extend: 'excel',
                        className: 'btn btn-primary my-btns',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column
                        },

                    },

                    {
                        extend: 'print',
                        className: 'btn btn-info my-btns',
                        removeClass : 'dt-button',
                        exportOptions: {
                            columns: ':not(:last-child)' // Exclude last column
                        }
                    }
                ],
                "order": [], // Disable initial ordering
                "lengthMenu": [10, 25, 50, 100]
            });
            // Remove the 'dt-button' class from the export buttons
            table.buttons().container().find('.dt-button').removeClass('dt-button');

            // Custom filter function for date
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var filterDate = $('#filter_date').val();
                    var dateColumn = data[5]; // Assuming the date column is the 5th column (index 5)

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
                        url: "{{ route('club.bookings.deleteSelected') }}",
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
        });
    </script>
@endsection
