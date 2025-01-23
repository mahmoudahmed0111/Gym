@extends('layouts.dashboard.app')
@section('header__title', __('home.admins'))
@section('header__icon', 'fa-solid fa-users')
@section('main')
    <div class="content-wrapper">
        <!-- Content -->
        <div class="p-3 container-p-y">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <form action="{{ route('settings-website.store') }}" method="POST" class="row" enctype="multipart/form-data">
                                @csrf

                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('facebook_link', $data->facebook_link),
                                        'name' => 'facebook_link',
                                        'type' => 'text',
                                        'label' => 'Facebook Link',
                                        'placeholder' => 'https://facebook.com/yourpage',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('instagram_link', $data->instagram_link),
                                        'name' => 'instagram_link',
                                        'type' => 'text',
                                        'label' => 'Instagram Link',
                                        'placeholder' => 'https://instagram.com/yourprofile',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('whats_up', $data->whats_up),
                                        'name' => 'whats_up',
                                        'type' => 'text',
                                        'label' => 'WhatsApp',
                                        'placeholder' => 'Your WhatsApp number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('phone', $data->phone),
                                        'name' => 'phone',
                                        'type' => 'text',
                                        'label' => 'Phone',
                                        'placeholder' => 'Your phone number',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('x_link', $data->x_link),
                                        'name' => 'x_link',
                                        'type' => 'text',
                                        'label' => 'X Link',
                                        'placeholder' => 'Your X link',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('snapchat', $data->snapchat),
                                        'name' => 'snapchat',
                                        'type' => 'text',
                                        'label' => 'Snapchat',
                                        'placeholder' => 'Your Snapchat username',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('website', $data->website),
                                        'name' => 'website',
                                        'type' => 'text',
                                        'label' => 'Website',
                                        'placeholder' => 'https://yourwebsite.com',
                                    ])
                                </div>
                                <div class="col-md-6">
                                    @include('components.input', [
                                        'value' => old('tax', $data->tax),
                                        'name' => 'tax',
                                        'type' => 'text',
                                        'label' => 'Tax',
                                        'placeholder' => 'Your tax information',
                                    ])
                                </div>

                                <div class="d-flex align-items justify-content-end">
                                    @include('components.button', [
                                        'type' => 'submit',
                                        'name' => 'Add',
                                    ])
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts-dashboard')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- Select2 JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>
@endsection
