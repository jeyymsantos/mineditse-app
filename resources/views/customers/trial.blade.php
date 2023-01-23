@extends('layouts.customer')

@section('title')
    <title> Users Home Page </title>
@endsection

@section('content')
        <main id="main">

            <section id="about" class="container mt-5">
                <h1> All Products </h1>

                <div class="row g-3">
                @for ($x = 0; $x < 10; $x++)
                <div class="col-12 col-md-6 col-lg-3 mt-2">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('img/Logo.png') }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                                content.</p>
                            <a href="#" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
                 

            </section>

        </main>
@endsection
