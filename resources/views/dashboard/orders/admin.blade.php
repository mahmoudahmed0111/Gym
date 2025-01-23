@extends('layouts.dashboard.app')
@section('header__title', __('home.orders'))
@section('header__icon', 'fa-solid fa-box')
@section('main')
    <div class="content-wrapper">
        <div class="p-3 container-p-y">
            <div class="card">
                <div class="d-flex align-item-center p-4 justify-content-between w-100">
                    <h5 class="card-header p-0">{{ __('home.orders') }}</h5>
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
                    </div>
                </div>
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>{{ __('home.order_id') }}</th>
                                <th>{{ __('home.date') }}</th>
                                <th>{{ __('home.Product') }}</th>
                                <th>{{ __('home.Product') }}</th>
                                <th>{{ __('home.Price') }}</th>
                                <th>{{ __('home.Qty') }}</th>
                                <th>{{ __('home.total_amount') }}</th>
                                <th>{{ __('home.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center order-name text-nowrap">
                                            <div class="avatar-wrapper">
                                                <div class="avatar avatar-sm me-3"><img
                                                        src="{{ image_url($order->product->img) }}" alt="Avatar"
                                                        class="rounded-circle"></div>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="m-0"><a href="#"
                                                        class="text-heading">{{ $order->product->name }}</a></h6>
                                                <small>{{ $order->product->description }}</small>
                                                @if ($order->attribute_values)
                                                    @php
                                                        $attribute_values = \App\Models\ProductAttributeValue::whereIn(
                                                            'id',
                                                            json_decode($order->attribute_values),
                                                        )->get();
                                                    @endphp
                                                    <small>
                                                        @foreach ($attribute_values as $value)
                                                            @if ($value->color)
                                                                <span class="badge badge-secondary"
                                                                    style="background-color: {{ $value->color }};">
                                                                </span>
                                                            @else
                                                                <span class="badge badge-secondary text-dark">
                                                                    {{ $value->value }}
                                                                </span>
                                                            @endif
                                                        @endforeach
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $order->price }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>{{ $order->quantity * $order->price }}</td>
                                    <td class="">
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-{{ $order->status == 'delivered' ? 'primary' : 'warning' }} dropdown-toggle"
                                                type="button" id="orderStatusDropdown" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                {{ __('home.status') }}: {{ __('home.' . $order->status) }}
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="orderStatusDropdown">
                                                <li>
                                                    <form action="{{ route('orders.items.status', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Pending">
                                                        <button class="dropdown-item"
                                                            type="submit">{{ __('home.Pending') }}</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('orders.items.status', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="Processing">
                                                        <button class="dropdown-item"
                                                            type="submit">{{ __('home.Processing') }}</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('orders.items.status', $order->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="delivered">
                                                        <button class="dropdown-item"
                                                            type="submit">{{ __('home.delivered') }}</button>
                                                    </form>
                                                </li>
                                            </ul>
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

            // Handle page length change
            $('select[name="myTable_length"]').on('change', function() {
                var length = $(this).val();
                table.page.len(length).draw();
            });
        });
    </script>
@endsection
