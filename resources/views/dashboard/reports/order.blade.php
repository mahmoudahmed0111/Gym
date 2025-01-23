@extends('layouts.dashboard.app')

@section('header__title', __('home.orders'))
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
                <div class="d-flex align-item-center p-4 justify-content-between w-100">
                    <h5 class="card-header p-0">{{ __('home.orders') }}</h5>
                    <div class="d-flex align-item-center gap-3">
                    </div>
                </div>
                <div class="d-flex align-item-center justify-content-between gap-3 mb-4 px-4">
                    <div class="d-flex groups__button align-item-center gap-3">
                        <input type="text" class="form-control" style="width:200px" id="search_input"
                            placeholder="{{ __('home.Search') }}" aria-describedby="defaultFormControlHelp" />
                        <select name="myTable_length" aria-controls="myTable" class="dt-input" id="dt-length-0">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                        <div class="">
                            <input class="form-control" type="date" id="filter_date" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>{{ __('home.order_id') }}</th>
                                <th>{{ __('home.date') }}</th>
                                <th>{{ __('home.customers') }}</th>
                                <th>{{ __('home.total_amount') }}</th>
                                <th>{{ __('home.status') }}</th>
                                <th>{{ __('home.address') }}</th>
                                <th>{{ __('home.Edit') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at}}</td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center order-name text-nowrap">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-sm me-3"><img src="{{image_url($order->user->img)}}"
                                                        alt="Avatar" class="rounded-circle"></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="m-0"><a href="#"
                                                        class="text-heading">{{$order->user->name}}</a></h6>
                                                <small>{{$order->user->email}}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $order->total_amount }}</td>
                                    <td><span class="badge px-2 bg-label-{{$order->status=='delivered'?'success':'warning'}}" text-capitalized=""> {{ $order->status }} </span></td>
                                    <td>{{ $order->address->address_line1 }}</td>
                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                    data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('orders.show', $order->id) }}"><i
                                                    class="bx bx-show me-1"></i> {{ __('home.Show') }}</a>
                                            </div>
                                        </div>
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
                        removeClass: 'dt-button',
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
                    var dateColumn = data[1]; // Assuming the date column is the 2nd column (index 1)

                    if (filterDate === '') {
                        return true; // No filter applied
                    }

                    // Convert dates to comparable formats
                    var filterDateObj = new Date(filterDate);
                    var dateColumnObj = new Date(dateColumn);

                    // Ensure both dates are valid
                    if (!isNaN(filterDateObj.getTime()) && !isNaN(dateColumnObj.getTime())) {
                        return dateColumnObj.toDateString() === filterDateObj.toDateString();
                    }

                    return false;
                }
            );

            // Event listener for the date input
            $('#filter_date').on('change', function() {
                table.draw();
            });

            // Search functionality
            $('#search_input').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Handle page length change
            $('select[name="myTable_length"]').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });
        });
    </script>

@endsection
