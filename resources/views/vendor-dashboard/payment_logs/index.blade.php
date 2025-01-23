@extends('layouts.vendor-dashboard.app')
@section('header__title', __('home.payment_logs'))
@section('header__icon', 'fa-brands fa-paypal')
@section('main')
<div class="content-wrapper">
    <div class="p-3 container-p-y">
        <div class="card">
            <div class="d-flex align-item-center p-4 justify-content-between w-100">
                <h5 class="card-header p-0">{{ __('home.payment_logs') }}</h5>
                {{-- <div class="d-flex align-item-center gap-3">
                    <button id="deleteSelected" class="btn btn-danger">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                    <a href="{{ route('vendor.payment_logs.create') }}">
                        <button type="button" class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="fa-solid fa-plus"></i>{{ __('home.Add') }}
                        </button>
                    </a>
                </div> --}}
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
                            <th>
                                <div class="d-flex align-items-center gap-2">
                                    {{-- <input class="form-check-input row__check" type="checkbox" value="" id="check__box" /> --}}
                                    {{ __('models.name') }}
                                </div>
                            </th>
                            <th>{{ __('models.bill_no') }}</th>
                            <th>{{ __('models.price') }}</th>
                            <th>{{ __('models.category') }}</th>
                            <th>{{ __('models.payment_tool') }}</th>
                            <th>{{ __('models.created_at') }}</th>
                            {{-- <th>{{ __('models.action') }}</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paymentLogs as $log)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center gap-2">
                                        {{-- <input class="form-check-input row__check" type="checkbox" value="{{ $log->id }}" /> --}}
                                        {{ $log->owner->name ?? 'N/A' }}
                                    </div>
                                </th>
                                <td>{{ $log->bill_no }}</td>
                                <td>{{ $log->amount }}</td>
                                <td>{{ $log->type }}</td>
                                <td>{{ $log->payment_tool }}</td>
                                <td>{{ $log->created_at }}</td>

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
