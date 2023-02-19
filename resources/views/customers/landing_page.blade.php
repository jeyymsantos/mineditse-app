@extends('layouts.customer')

@section('title')
    <title> Users Home Page </title>
@endsection

@section('content')
    <div class="container-fluid">

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
            <div class="mb-3">
                <form method="GET" action="/customer">
                    <input type="text" class="form-control" id="search" maxlength="50" name="search"
                        placeholder="Seach for Product">
                </form>
            </div>
        </div>

        @if ($products->count() == 0)
            <div class="row m-5">
                <h1 style="text-align:center"> No Products Found </h1>
            </div>
        @endif


        <div class="row">
            @foreach ($products as $product)
                <div class="col-lg-2 col-md-3 col-sm-4 mt-1 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset($product->prod_img_path) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="text-dark">{{ $product->prod_name }}</h4>
                            <p class="card-text">
                                {{ $product->prod_price }} | {{ $product->category_name }}
                            </p>

                            <p class="card-text {{ $product->prod_status == 'Pending' ? 'text-warning' : 'text-success' }}">
                                {{ $product->prod_status }}
                            </p>

                        </div>

                        <div class="body text-end">
                            @if ($product->prod_status == 'Available')
                                <a href="/customer/orders/add/{{ $product->prod_id }}" class="btn btn-primary mb-3 me-3">Add
                                    to
                                    Cart</a>
                            @endif
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
