@extends('layouts.landing_page')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <h1 data-aos="fade-up">{{ $info->long_quote }}</h1>
                    <h2 data-aos="fade-up" data-aos-delay="400">
                        {{ $info->short_quote }}</h2>
                    <div data-aos="fade-up" data-aos-delay="600">
                        <div class="text-center text-lg-start">
                            <a href="/register"
                                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                                <span>Get Started</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
                    <img src="{{ $info->main_banner_photo }}" class="img-fluid" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

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

        <!-- ======= Values Section ======= -->
        <section id="values" class="values">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>Our Services</h2>
                    <p>{{ $info->service_quote }}</p>
                </header>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="box">
                            <img src="{{ $info->service_1_img }}" class="img-fluid" alt="">
                            <h3>{{ $info->service_1_name }}</h3>
                            <p>
                                {{ $info->service_1_quote }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
                        <div class="box">
                            <img src=" {{ $info->service_2_img }}" class="img-fluid" alt="">
                            <h3> {{ $info->service_2_name }}</h3>
                            <p> {{ $info->service_2_quote }}
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
                        <div class="box">
                            <img src=" {{ $info->service_3_img }}" class="img-fluid" alt="">
                            <h3> {{ $info->service_3_name }}</h3>
                            <p>
                                {{ $info->service_3_quote }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- End Values Section -->

        <!-- ======= Live Section ======= -->
        <section id="live" class="live">
            <div class="container" data-aos="fade-up">
                <header class="section-header">
                    <h2>Latest Live</h2>
                    <p>View our latest online selling live from Facebook!</p>
                </header>

                <div class="row">
                    <div class="col-lg-12" data-aos="fade-up" data-aos-delay="200">
                        <div class="box text-center">
                            <h3>{{ $info->live_title }}</h3>
                            <iframe src="{{ $info->live_link }}" width="267" height="476"
                                style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true"
                                allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"
                                allowFullScreen="true"></iframe>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- End Live Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container" data-aos="fade-up">

                <header class="section-header">
                    <h2>Contact</h2>
                    <p>Contact Us</p>
                </header>

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p> {{ $info->address }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p> {{ $info->contact }}<br><br></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p> {{ $info->email }}<br><br></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-box">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p> {{ $info->contact_hours }}</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <form action="/send-mail" method="post" class="php-email-form">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name"
                                        required>
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required>
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent. Thank you!</div>

                                    <button type="submit">Send Message</button>
                                </div>

                            </div>
                        </form>

                    </div>

                </div>

            </div>

        </section><!-- End Contact Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about">

            <div class="container" data-aos="fade-up">
                <div class="row gx-0">

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="content">
                            <h3>Who We Are</h3>
                            <h2> {{ $info->long_description }}
                            </h2>
                            <p>{{ $info->short_description }}

                            </p>
                            <div class="text-center text-lg-start">
                                <a href="/login"
                                    class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                                    <span>Start ordering now!</span>
                                    <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ $info->secondary_banner_photo }}" class="img-fluid" width="75%" alt="">
                    </div>

                </div>
            </div>

        </section><!-- End About Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-5 col-md-12 footer-info">
                        <a href="index.html" class="logo d-flex align-items-center">
                            <img src=" {{ $info->logo }}" alt="">
                            <span> {{ $info->name }}</span>
                        </a>
                        <p>
                            {{ $info->long_description }} <br><br>
                            {{ $info->short_description }}
                        </p>
                        <div class="social-links mt-3">
                            <a href=" {{ $info->fb_link }}" target="_blank" class="facebook"><i
                                    class="bi bi-facebook"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12 footer-contact text-center text-md-start">
                        <h4>Contact Us</h4>
                        <p>
                            {{ $info->address }} <br><br>
                            <strong>Phone:</strong> {{ $info->contact }}<br>
                            <strong>Email:</strong> {{ $info->email }}<br>
                        </p>

                    </div>

                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span> {{ $info->name }}</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
