@extends('layouts.vendor-dashboard.app')
@section('header__title', __('home.wallet'))
@section('header__icon', 'fa-brands fa-paypal')
@section('main')

<div class="content-wrapper">
    <div class="p-3 container-p-y">
        <div class="row">
            <div class="text-center col-lg-12 mb-3 order-0">
                <div class="card p-3 pb-4">
                    <h3 class="card-header m-0 px-0 pb-4">{{ __('home.Vendor Balance') }}</h3>
                    <div class=" text-center">
                        <div class="box__dashboard p-3 bg-label-success" >
                            <div class="icon-circle bg-primary ">
                                <i class="fa-solid fa-dollar-sign fa-lg"></i>
                            </div>
                            <div class="number ">{{ number_format($vendor->balance, 2) }} {{ $vendor->currency }}</div>
                            <span class="text-dark">{{ __('home.balance') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Payment Logs Table -->
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="d-flex align-items-center p-4 justify-content-between w-100">
                        <h5 class="card-header p-0">{{ __('home.payment_logs') }}</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-4 px-4">
                        <div class="d-flex groups__button align-items-center gap-3">
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
                                    <th>{{ __('models.name') }}</th>
                                    <th>{{ __('models.bill_no') }}</th>
                                    <th>{{ __('models.price') }}</th>
                                    <th>{{ __('models.category') }}</th>
                                    {{-- <th>{{ __('models.payment_tool') }}</th> --}}
                                    <th>{{ __('models.created_at') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentLogs as $log)
                                    <tr>
                                        <th scope="row">
                                            <div class="d-flex align-items-center gap-2">
                                                {{ $log->owner->name ?? 'N/A' }}
                                            </div>
                                        </th>
                                        <td>{{ $log->bill_no }}</td>
                                        <td>{{ $log->amount }}</td>
                                        <td>{{ $log->type }}</td>
                                        {{-- <td>{{ $log->payment_tool }}</td> --}}
                                        <td>{{ $log->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <!-- Admin To vendor Payments Table -->
                <div class="card">
                    <div class="d-flex align-items-center p-4 justify-content-between w-100">
                        <h5 class="card-header p-0">{{ __('home.AdminToVendorPayment') }}</h5>
                    </div>
                    <div class="d-flex align-items-center justify-content-between gap-3 mb-4 px-4">
                        <div class="d-flex groups__button align-items-center gap-3">
                            <input type="text" class="form-control" style="width:200px" id="search_input1"
                                placeholder="{{ __('home.Search') }}" aria-describedby="defaultFormControlHelp" />
                            <select name="myTable_length" aria-controls="myTable1" class="dt-input" id="dt-length-0">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap px-4">
                        <table class="table" id="myTable1">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>{{ __('home.Admin Name') }}</th>
                                    <th>{{ __('home.vendor Name') }}</th>
                                    <th>{{ __('home.Amount') }}</th>
                                    {{-- <th>{{ __('home.Currency') }}</th> --}}
                                    <th>{{ __('home.Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>{{ $payment->admin->name }}</td>
                                        <td>{{ $payment->vendor->name }}</td>
                                        <td>{{ $payment->amount }}</td>
                                        {{-- <td>{{ $payment->currency }}</td> --}}
                                        <td>{{ $payment->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
<script>
    $(document).ready(function() {
        // DataTable initialization with export buttons
        let table = $('#myTable1').DataTable({
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
        $('#search_input1').on('keyup', function() {
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
