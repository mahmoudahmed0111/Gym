@extends('layouts.vendor-dashboard.app')

@section('main')
<div class="content-wrapper">
    <!-- Content -->
    <div class="p-3 container-p-y">
        <div class=" row">
                <div class="col-12 col-md-12">
                    <div class="card mb-6 ">
                        <div class="card-header  ">
                            <img src="{{image_url($product->img)}}"alt="Avatar" class="rounded-circle " @style("width:70px") >
                            <h5 class="card-title">{{ $product->name }}</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $product->description }}</p>
                            <h6>Price: ${{ $product->price }}</h6>

                        </div>
                    </div>

                    <div class="card mb-6 mt-2">
                        <div class="card-header">
                            <h5 class="card-title">{{ __('home.Reviews') }}</h5>
                        </div>
                        <div class="card-body">
                            @forelse ($product->reviews as $review)
                                <div class="review">
                                    <div class="d-flex justify-content-start align-items-center mb-3">
                                        <div class="avatar me-3">
                                            <img src="{{ image_url( $review->user->img) }}" alt="Avatar"
                                                class="rounded-circle">
                                        </div>
                                        <div>
                                            <h6 class="mb-0">{{ $review->user->name }}</h6>
                                            <span>{{ $review->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p>{{ $review->review }}</p>
                                        <div class="rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $review->rating)
                                                    <span class="text-warning">★</span>
                                                @else
                                                    <span class="text-muted">★</span>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @empty
                                <p>{{ __('home.No reviews yet') }}</p>
                            @endforelse
                        </div>
                    </div>
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
