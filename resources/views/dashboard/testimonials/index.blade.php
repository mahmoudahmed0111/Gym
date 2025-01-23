@extends('layouts.dashboard.app')
@section('header__title', __('home.External site'))
@section('header__icon', 'fa-solid fa-earth-americas')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">
            <div class="card">
                <div class="d-flex align-item-center p-4 justify-content-between w-100">

                    <h5 class="card-header p-0">{{ __('home.testimonials') }}</h5>
                    <div class="d-flex align-item-center gap-3">
                        <button type="button" class="btn btn-danger">
                            <i class="fa-regular fa-trash-can"></i>
                            {{ __('home.Delete') }}
                        </button>
                        <a href="{{ route('testimonials.create') }}">
                            <button type="button" class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="fa-solid fa-plus"></i>{{ __('home.Add New') }}
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
                        <select class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                            <option selected>{{ __('home.Select') }}</option>
                            <option value="1">{{ __('home.One') }}</option>
                            <option value="2">{{ __('home.Two') }}</option>
                            <option value="3">{{ __('home.Three') }}</option>
                        </select>
                        <div class="">
                            <input class="form-control" type="date" value="2021-06-18" id="html5-date-input" />
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
                                            <path fill="#888888"
                                                d="M19 7h-1V2H6v5H5c-1.654 0-3 1.346-3 3v7c0 1.103.897 2 2 2h2v3h12v-3h2c1.103 0 2-.897 2-2v-7c0-1.654-1.346-3-3-3M8 4h8v3H8zm8 16H8v-4h8zm4-3h-2v-3H6v3H4v-7c0-.551.449-1 1-1h14c.552 0 1 .449 1 1z" />
                                            <path fill="#888888" d="M14 10h4v2h-4z" />
                                        </svg> {{ __('home.Print') }}</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zm8 7h-1V4l5 5h-4z"
                                                fill="#888888" />
                                        </svg>{{ __('home.Csv') }}</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023c.479 0 .774-.242.774-.651c0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018c.817.006 1.349-.444 1.349-1.396c.006-.83-.479-1.268-1.255-1.268z"
                                                fill="#888888" />
                                            <path
                                                d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319c.254.202.426.533.426.923c-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515c-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426c.415.308.675.799.675 1.504c0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z"
                                                fill="#888888" />
                                        </svg> {{ __('home.Pdf') }}</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0);"><svg
                                            xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M14 8H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V10c0-1.103-.897-2-2-2z"
                                                fill="#888888" />
                                            <path
                                                d="M20 2H10a2 2 0 0 0-2 2v2h8a2 2 0 0 1 2 2v8h2a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"
                                                fill="#888888" />
                                        </svg>{{ __('home.Copy') }}</a></li>

                            </ul>
                        </div>

                    </div>


                </div>
                <div class="table-responsive text-nowrap px-4">
                    <table class="table" id="myTable">
                        <thead>
                            <tr class="text-nowrap">
                                <th>
                                    <div class="d-flex align-items-center gap-2">
                                        <input class="form-check-input row__check" type="checkbox" value=""
                                            id="check__box" />
                                        {{ __('home.Username') }}
                                    </div>
                                </th>
                                <th>{{ __('home.testimonial') }}</th>
                                <th>{{ __('home.img') }}</th>
                                <th>{{ __('home.Edit') }}</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $testimonial)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center gap-2">
                                            <input class="form-check-input row__check" type="checkbox" value=""
                                                id="defaultCheck3" />

                                            {{ $testimonial->name }}
                                        </div>
                                    </th>
                                    <td> {{ $testimonial->description }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <img src={{ image_url( $testimonial->img) }} alt
                                                class="w-px-30 h-auto rounded-circle" />
                                            {{ $testimonial->img }}
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('testimonials.edit', $testimonial->id) }}"><i
                                                        class="bx bx-edit-alt me-1"></i> {{ __('home.Edit') }}</a>
                                                <a class="dropdown-item cursor-pointer" data-bs-toggle="modal"
                                                    data-bs-target="#modalToggle{{$testimonial->id}}"><i class="bx bx-trash me-1"></i>
                                                    {{ __('home.Delete') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('testimonials.show', $testimonial->id) }}"><i
                                                        class="bx bx-show me-1"></i> {{ __('home.Show') }}</a>
                                            </div>
                                        </div>
                                        @include('components.modalDelete', [
                                            'action' => 'testimonials.destroy',
                                            'name' => $testimonial->name,
                                            'title' => __('home.Are You Delete'),
                                            'modalToggle' => 'modalToggle'.$testimonial->id,
                                            'id' => $testimonial->id,
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
