@extends('layouts.customer')

@section('title')
    <title> Users Home Page </title>
@endsection

@section('content')
        <main id="main">

            <section id="about" class="container mt-5">
                <h1 class="mb-4"> All Products </h1>

                <div class="row">
                @foreach ($products as $product)
                <div class="col-12 col-md-6 col-lg-3 mt-2 mb-3">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('img/Logo.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3>{{ $product->prod_name }}</h3>                     
                            <p class="card-text">
                                {{ $product->prod_price }} | {{ $product->category_name }} 
                            </p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
                 

            </section>

        </main>
@endsection
