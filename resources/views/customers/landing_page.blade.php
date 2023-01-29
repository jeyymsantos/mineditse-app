@extends('layouts.customer')

@section('title')
    <title> Users Home Page </title>
@endsection

@section('content')
    <div class="container">

        @if (session()->has('error_title'))
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ session()->get('error_title') }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ session()->get('error_msg') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I understand</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (session()->has('successfull'))
            <div class="row my-2 text-success">
                <h3> {{ session()->get('successfull') }} </h3>
            </div>
        @endif


        <h1 class="mb-4"> All Products </h1>

        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-2 col-md-3 col-sm-1 mt-1 mb-3">
                    <div class="card" style="width: 10rem;">
                        <img src="{{ asset($product->prod_img_path) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="text-dark">{{ $product->prod_name }}</h3>
                            <p class="card-text">
                                {{ $product->prod_price }} | {{ $product->category_name }}
                            </p>

                            <p class="card-text {{ $product->prod_status }}">
                                {{ $product->prod_status }}
                            </p>
                            <a href="/customer/orders/add/{{ $product->prod_id }}" class="btn btn-primary">Add to
                                Cart</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row">
            {{ $products->links() }}
        </div>

        </section>
    </div>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
