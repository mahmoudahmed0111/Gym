@extends('layouts.vendor-dashboard.app')
@section('header__title', __('home.order_details'))
@section('header__icon', 'fa-solid fa-box')
@section('main')
    <div class="content-wrapper">
        <div class="p-3 container-p-y">


            <div class="row">
                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">

                    <div class="d-flex flex-column justify-content-center">
                        <div class="mb-1">
                            <span class="h5">{{ __('home.order') }} #{{ $order->id }} </span><span
                                class="badge bg-label-success me-1 ms-2">{{ __('home.Paid') }}</span>
                            {{-- <span class="badge bg-label-info">Ready to Pickup</span> --}}

                        </div>
                        <p class="mb-0">{{ $order->created_at->format('M d,') }} <span
                                id="orderYear">{{ $order->created_at->format('Y') }}</span>,
                            {{ $order->created_at->format('g:i A') }} (ET)</p>
                    </div>
                    <div class="d-flex align-content-center flex-wrap gap-2">
                        <div class="d-flex align-content-center flex-wrap gap-2">
                            <div class="dropdown">
                                <button class="btn btn-{{$order->status=='delivered'?'primary':'warning'}} dropdown-toggle" type="button" id="orderStatusDropdown"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('home.status') }}: {{ __('home.'.$order->status) }}
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="orderStatusDropdown">
                                    <li>
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Pending">
                                            <button class="dropdown-item" type="submit">{{ __('home.Pending') }}</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="Processing">
                                            <button class="dropdown-item"
                                                type="submit">{{ __('home.Processing') }}</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="delivered">
                                            <button class="dropdown-item"
                                                type="submit">{{ __('home.delivered') }}</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-8">
                    <div class="card mb-6">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0">{{ __('home.Order details') }}</h5>
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
                                    @foreach ($order->items as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex justify-content-start align-items-center text-nowrap">
                                                    <div class="avatar-wrapper">
                                                        <div class="avatar avatar-sm me-3">
                                                            <img src="{{ asset('storage/' . $item->product->img) }}"
                                                                alt="product-{{ $item->product->name }}" class="rounded-2">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="text-heading mb-0">{{ $item->product->name }}</h6>
                                                        <small>{{ $item->product->description }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>${{ $item->price }}</span></td>
                                            <td><span class="text-body">{{ $item->quantity }}</span></td>
                                            <td><span class="text-body">${{ $item->price * $item->quantity }}</span></td>
                                            <td><span class="badge px-2 bg-label-{{$item->status=='delivered'?'success':'warning'}}"> {{ __("home.".$item->status) }} </span></td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end align-items-center m-6 mb-2">
                                <div class="order-calculations p-2">
                                    <div class="d-flex justify-content-start mb-2 ">
                                        <span class="w-px-100 text-heading">{{ __('home.Subtotal:') }}</span>
                                        <h6 class="mb-0">${{ $order->total_amount }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="w-px-100 text-heading">{{ __('home.Discount:') }}</span>
                                        <h6 class="mb-0">${{ $order->discount ?? 0 }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-start mb-2">
                                        <span class="w-px-100 text-heading">{{ __('home.Tax:') }}</span>
                                        <h6 class="mb-0">${{ $order->tax ?? 0 }}</h6>
                                    </div>
                                    <div class="d-flex justify-content-start">
                                        <h6 class="w-px-100 mb-0">{{ __('home.Total:') }}</h6>
                                        <h6 class="mb-0">${{ $order->total_amount - $order->discount + $order->tax }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-6">
                        <div class="card-header">
                            <h5 class="card-title m-0">{{ __('home.Customer details') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start align-items-center mb-6">
                                <div class="avatar me-3">
                                    <img src="{{ image_url($order->user->img) }}" alt="Avatar" class="rounded-circle">
                                </div>
                                <div class="d-flex flex-column">
                                    <h6 class="mb-0">{{ $order->user->name }}</h6>
                                    <span>{{ __('home.Customer ID:') }} #{{ $order->user->id }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start align-items-center mb-6 mt-2">
                                <span
                                    class="avatar rounded-circle bg-label-success me-3 d-flex align-items-center justify-content-center"><i
                                        class="bx bx-cart bx-lg"></i></span>
                                <h6 class="text-nowrap mb-0">{{ $order->user->orders_count }} {{ __('home.Orders') }}</h6>
                            </div>
                            <div class="d-flex justify-content-between  mt-2">
                                <h6 class="mb-1">{{ __('home.Contact info') }}</h6>
                            </div>
                            <p class=" mb-1">{{ __('home.Email:') }} {{ $order->user->email }}</p>
                            <p class=" mb-0">{{ __('home.Mobile:') }} {{ $order->user->mobile }}</p>
                        </div>
                    </div>

                    <div class="card mb-6 mt-2">
                        <div class="card-header d-flex justify-content-between">
                            <h5 class="card-title m-0">{{ __('home.Shipping address') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">{{ $order->address->address_line1 }}</p>
                            <p class="mb-0">{{ $order->address->address_line2 }}</p>
                            <p class="mb-0">{{ $order->address->country }}</p>
                            <p class="mb-0">{{ $order->address->city }}</p>
                            <p class="mb-0">{{ $order->address->state }}</p>
                            <p class="mb-0">{{ $order->address->postal_code }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
