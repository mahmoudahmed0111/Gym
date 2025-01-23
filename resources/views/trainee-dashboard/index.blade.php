@extends('layouts.trainee-dashboard.app')
@section('header__title', __('home.Dashboard'))
@section('header__icon', 'fa-solid fa-house')

@section('main')
    <div class="content-wrapper">
        <!-- Content -->


        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-lg-12 mb-3 order-0">
                    <div class="card p-3 pb-4">
                        <div class="col-md-8">
                            <h3 class="card-header m-0 px-0 pb-4">{{ __('home.statistics') }}</h3>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap align-items-center gap-3 ">
                            <div class="box__dashboard p-3" style="background: #F3E8FF;">
                                <div class="icon-circle bg-info">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>
                                <div class="number"></div>
                                <span>{{ __('models.balance') }}</span>
                            </div>
                            <div class="box__dashboard p-3" style="background: #DCFCE7;">
                                <img src="{{ asset('asset/img/dashboard/Icon (3).png') }}" alt="">
                                <div class="number"></div>
                                <span>{{ __('home.products') }}</span>
                            </div>
                            <div class="box__dashboard p-3" style="background: #FFF4DE;">
                                <img src="{{ asset('asset/img/dashboard/Icon.svg') }}" alt="">
                                <div class="number"></div>
                                <span>{{ __('home.offers') }}</span>
                            </div>
                            <div class="box__dashboard p-3" style="background: #FFE2E5;">
                                <img src="{{ asset('asset/img/dashboard/Icon (1).svg') }}" alt="">
                                <div class="number"></div>
                                <span>{{ __('home.paid') }}</span>
                            </div>
                            <div class="box__dashboard p-3" style="background: #DCFCE7;">
                                <img src="{{ asset('asset/img/dashboard/Icon (3).png') }}" alt="">
                                <div class="number"></div>
                                <span>{{ __('home.categories') }}</span>
                            </div>
                            <div class="box__dashboard p-3 bg-label-info">
                                <div class="icon-circle bg-info">

                                    {{-- <img src="{{ asset('asset/img/dashboard/Icon (3).png') }}" alt=""> --}}
                                    <i class="fa fa-box"></i>
                                </div>
                                <div class="number"></div>
                                <span>{{ __('home.orders') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <!-- Total Revenue -->
                <div class="col-12 col-lg-7 mb-4">
                    <div class="card h-100">
                        <div class="row row-bordered g-0">
                            <div class="col-md-8">
                                <h5 class="card-header m-0 me-2 pb-3">{{ __('home.top_products') }}</h5>
                                <div id="totalRevenue" class="px-2"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="card-body">
                                    <div class="text-center">
                                    </div>
                                </div>
                                <div class="text-center fw-semibold pt-3 mb-2">{{ __('home.income') }}</div>

                                {{-- <div class=" px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                    <div class="d-flex m-3">
                                        <div class="me-2">
                                            <span class="badge bg-label-primary p-2"><i
                                                    class="bx bx-dollar text-primary"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>{{__("models.balance")}}</small>
                                            <h6 class="mb-0">{{$statistics['balance']}}</h6>
                                        </div>
                                    </div>
                                    <div class="d-flex m-3">
                                        <div class="me-2">
                                            <span class="badge bg-label-info p-2"><i
                                                    class="bx bx-wallet text-info"></i></span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <small>{{__("home.paid")}}</small>
                                            <h6 class="mb-0">{{$statistics['paid']}}</h6>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="report-list m-2">
                                    <div class="report-list-item rounded-2 mb-4">
                                        <div class="d-flex align-items-center">
                                            <div class="report-list-icon shadow-xs me-4">
                                                <span class="badge bg-label-info p-2"><i
                                                        class="bx bx-wallet text-info"></i></span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between align-items-center w-100 flex-wrap gap-2">
                                                <div class="d-flex flex-column">
                                                    <span>{{__("models.balance")}}</span>
                                                    <h5 class="mb-0"></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="report-list-item rounded-2 mb-4">
                                        <div class="d-flex align-items-center">
                                            <div class="report-list-icon shadow-xs me-4">
                                                <span class="badge bg-label-primary p-2"><i
                                                        class="bx bx-dollar text-primary"></i></span>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between align-items-center w-100 flex-wrap gap-2">
                                                <div class="d-flex flex-column">
                                                    <span>{{(("home.paid"))}}</span>
                                                    <h5 class="mb-0"></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 status__comp mb-4">
                    <div class="card">
                        <h5 class="card-header">حالات الدفع</h5>
                        <div class="table-responsive text-nowrap">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>{{ __('models.bill_no') }}</th>
                                        <th>{{ __('models.price') }}</th>
                                        <th>{{ __('models.category') }}</th>
                                        <th>{{ __('models.payment_tool') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 col-lg-5  mb-4">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('home.Income') }}</h5>
                            <small class="text-muted">Last 7 Days</small>
                        </div>
                        <div class="card-body px-0">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                    <div class="d-flex p-4 pt-3">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <img src="{{ asset('asset/img/icons/unicons/wallet.png') }}" alt="User" />
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">{{ __('home.total_balance') }}</small>
                                            <div class="d-flex align-items-center">
                                                <h6 class="mb-0 me-1"></h6>
                                                <small
                                                    class="fw-semibold">
                                                    <i
                                                        class="bx 'bx-chevron-up'"></i>

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="income_Chart"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-md-7 col-lg-7 col-xl-7  mb-4">
                    <div class="card ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0">{{ __('home.last orders') }}</h5>
                        </div>
                        <div class="card-datatable table-responsive">
                            <table class="datatables-order-details table border-top">
                                <thead>
                                    <tr>

                                        <th>{{ __('home.Product') }}</th>
                                        <th>{{ __('home.Price') }}</th>
                                        <th>{{ __('home.Qty') }}</th>
                                        <th>{{ __('home.Total') }}</th>
                                        <th>{{ __('home.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- / Content -->

        <!-- Footer -->
        <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                    , made with ❤️ by
                    <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                <div>
                    <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                    <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                    <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"
                        target="_blank" class="footer-link me-4">Documentation</a>

                    <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
                        class="footer-link me-4">Support</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection

@section('scripts-dashboard')

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {


            const incomeChartConfig = {
                series: [{
                    data: data
                }],
                chart: {
                    height: 215,
                    parentHeightOffset: 0,
                    parentWidthOffset: 0,
                    toolbar: {
                        show: false
                    },
                    type: 'area'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                legend: {
                    show: false
                },
                markers: {
                    size: 6,
                    colors: 'transparent',
                    strokeColors: 'transparent',
                    strokeWidth: 4,
                    discrete: [{
                        fillColor: '#fff',
                        seriesIndex: 0,
                        dataPointIndex: data.length - 1,
                        strokeColor: '#7367f0',
                        strokeWidth: 2,
                        size: 6,
                        radius: 8
                    }],
                    hover: {
                        size: 7
                    }
                },
                colors: ['#7367f0'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 0.6,
                        opacityFrom: 0.5,
                        opacityTo: 0.25,
                        stops: [0, 95, 100]
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 3,
                    padding: {
                        top: -20,
                        bottom: -8,
                        left: -10,
                        right: 8
                    }
                },
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: true,
                        style: {
                            fontSize: '13px',
                            colors: '#9e9e9e'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    },
                    min: Math.min(...data) - 10,
                    max: Math.max(...data) + 10,
                    tickAmount: 4
                }
            };

            if (typeof incomeChartEl !== 'undefined' && incomeChartEl !== null) {
                const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                incomeChart.render();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const incomeChartEl = document.querySelector('#totalRevenue');



            const incomeChartConfig = {
                series: [{
                    data: data
                }],
                chart: {
                    parentHeightOffset: 0,
                    parentWidthOffset: 0,
                    toolbar: {
                        show: false
                    },
                    type: 'bar'
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'smooth'
                },
                legend: {
                    show: false
                },
                markers: {
                    size: 6,

                    strokeWidth: 4,
                    discrete: [{
                        fillColor: '#fff',
                        seriesIndex: 0,
                        strokeColor: '#7367f0',
                        strokeWidth: 2,
                        radius: 8
                    }],
                    hover: {
                        size: 7
                    }
                },
                colors: ['#7367f0'],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 0.6,
                        opacityFrom: 0.5,
                        opacityTo: 0.25,
                        stops: [0, 95, 100]
                    }
                },
                grid: {
                    borderColor: '#e7e7e7',
                    strokeDashArray: 3,

                },
                xaxis: {
                    categories: labels,
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: true,
                        style: {
                            fontSize: '13px',
                            colors: '#9e9e9e'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: false
                    },
                    tickAmount: 4
                }
            };

            if (typeof incomeChartEl !== 'undefined' && incomeChartEl !== null) {
                const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
                incomeChart.render();
            }
        });
    </script>
@endsection
