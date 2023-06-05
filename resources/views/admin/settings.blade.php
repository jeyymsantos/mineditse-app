@extends('layouts.master')

@section('title')
    <title> Products </title>
@endsection

@section('custom_css')
    <link rel="stylesheet" href="{{ asset('css/products.css') }}">
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

        <form action="/admin/settings/save/" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <h1> Site Settings</h1>
                </div>
                <div class="col-6 d-flex justify-content-end">
                    <a class="mx-1"><button class="btn btn-primary" type="submit">Update</button></a>
                    <a href="/admin"><span class="btn btn-warning">Cancel</span></a>
                </div>
            </div>

            <div class="row">

                <div class="col-md-4">
                    {{-- Business Logo --}}
                    <div class="mb-3 row">
                        <div class="col-sm-12 mb-3">
                            <label for="formFile" class="form-label">Business Logo</label>
                            <div class="col-md-6 col-sm-12 mb-3">
                                <img id="site_logo_tag" class="img-responsive" src="{{ $info->logo }}" width="215px" />
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <input id="site_logo" class="form-control" name="logo" type="file" accept="image/*"
                                    id="formFile">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    {{-- Main Banner Photo --}}
                    <div class="mb-3 row">
                        <div class="col-sm-12 mb-3">
                            <label for="formFile" class="form-label">Main Banner</label>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <img id="site_main_banner_tag" class="img-responsive" src="{{ $info->main_banner_photo }}"
                                    width="215px" />
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <input id="site_main_banner" class="form-control" name="main_banner" type="file"
                                    accept="image/*" id="formFile">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    {{-- Secondary Banner Photo --}}
                    <div class="mb-3 row">
                        <div class="col-sm-12 mb-3">
                            <label for="formFile" class="form-label">Secondary Banner</label>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <img id="site_second_banner_tag" class="img-responsive"
                                    src="{{ $info->secondary_banner_photo }}" width="215px" />
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <input id="site_second_banner" class="form-control" name="secondary_banner" type="file"
                                    accept="image/*" id="formFile">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Business Name --}}
            <div class="mb-3">
                <label for="name" class="form-label">Business Name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Business Name"
                    value="{{ $info->name }}" required>
            </div>


            {{-- Short Quote --}}
            <div class="mb-3">
                <label for="short_quote" class="form-label">Short Quote</label>
                <input type="text" name="short_quote" class="form-control" id="short_quote" placeholder="Short Quote"
                    value="{{ $info->short_quote }}" required>
            </div>

            {{-- Long Quote --}}
            <div class="mb-3">
                <label for="long_quote" class="form-label">Long Quote</label>
                <input type="text" name="long_quote" class="form-control" id="long_quote" placeholder="Long Quote"
                    value="{{ $info->long_quote }}" required>
            </div>

            {{-- Short Description --}}
            <div class="mb-3">
                <label for="short_description" class="form-label">Short Description</label>
                <input type="text" name="short_description" class="form-control" id="short_description"
                    placeholder="Short Description" value="{{ $info->short_description }}" required>
            </div>

            {{-- Long Description --}}
            <div class="mb-3">
                <label for="long_description" class="form-label">Long Description</label>
                <input type="text" name="long_description" class="form-control" id="long_description"
                    placeholder="Long Description" value="{{ $info->long_description }}" required>
            </div>

            {{-- Address --}}
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address" placeholder="Address"
                    value="{{ $info->address }}" required>
            </div>

            {{-- Contact --}}
            <div class="mb-3">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact"
                    value="{{ $info->contact }}" required>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                    value="{{ $info->email }}" required>
            </div>

            {{-- Contact Hours --}}
            <div class="mb-3">
                <label for="contact_hours" class="form-label">Contact Hours</label>
                <input type="text" name="contact_hours" class="form-control" id="contact_hours"
                    placeholder="Contact Hours" value="{{ $info->contact_hours }}" required>
            </div>

            {{-- Service Quote --}}
            <div class="mb-3">
                <label for="service_quote" class="form-label">Service Quote</label>
                <input type="text" name="service_quote" class="form-control" id="service_quote"
                    placeholder="Service Quote" value="{{ $info->service_quote }}" required>
            </div>

            {{-- Service 1 Img --}}
            <div class="mb-3 row">
                <div class="col-sm-12 mb-3">
                    <label for="service_1_img" class="form-label">Service 1 Image</label>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <img id="site_service_1_tag" class="img-responsive" src="{{ $info->service_1_img }}"
                            width="215px" />
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <input id="site_service_1" class="form-control" name="service_1_img" type="file"
                            accept="image/*" id="service_1_img">
                    </div>
                </div>
            </div>


            {{-- Service 1 Name --}}
            <div class="mb-3">
                <label for="service_1_name" class="form-label">Service 1 Name</label>
                <input type="text" name="service_1_name" class="form-control" id="service_1_name"
                    placeholder="Service 1 Name" value="{{ $info->service_1_name }}" required>
            </div>

            {{-- Service 1 Quote --}}
            <div class="mb-3">
                <label for="service_1_quote" class="form-label">Service 1 Quote</label>
                <input type="text" name="service_1_quote" class="form-control" id="service_1_quote"
                    placeholder="Service 1 Quote" value="{{ $info->service_1_quote }}" required>
            </div>


            {{-- Service 1 Img --}}
            <div class="mb-3 row">
                <div class="col-sm-12 mb-3">
                    <label for="service_2_img" class="form-label">Service 2 Image</label>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <img id="site_service_2_tag" class="img-responsive" src="{{ $info->service_2_img }}"
                            width="215px" />
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <input id="site_service_2" class="form-control" name="service_2_img" type="file"
                            accept="image/*" id="service_2_img">
                    </div>
                </div>
            </div>

            {{-- Service 2 Name --}}
            <div class="mb-3">
                <label for="service_2_name" class="form-label">Service 2 Name</label>
                <input type="text" name="service_2_name" class="form-control" id="service_2_name"
                    placeholder="Service 2 Name" value="{{ $info->service_2_name }}" required>
            </div>

            {{-- Service 2 Quote --}}
            <div class="mb-3">
                <label for="service_2_quote" class="form-label">Service 2 Quote</label>
                <input type="text" name="service_2_quote" class="form-control" id="service_2_quote"
                    placeholder="Service 2 Quote" value="{{ $info->service_2_quote }}" required>
            </div>


            {{-- Service 3 Img --}}
            <div class="mb-3 row">
                <div class="col-sm-12 mb-3">
                    <label for="service_3_img" class="form-label">Service 3 Image</label>
                    <div class="col-md-4 col-sm-6 mb-3">
                        <img id="site_service_3_tag" class="img-responsive" src="{{ $info->service_3_img }}"
                            width="215px" />
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <input id="site_service_3" class="form-control" name="service_3_img" type="file"
                            accept="image/*" id="service_3_img">
                    </div>
                </div>
            </div>

            {{-- Service 3 Name --}}
            <div class="mb-3">
                <label for="service_3_name" class="form-label">Service 3 Name</label>
                <input type="text" name="service_3_name" class="form-control" id="service_3_name"
                    placeholder="Service 3 Name" value="{{ $info->service_3_name }}" required>
            </div>

            {{-- Service 3 Quote --}}
            <div class="mb-3">
                <label for="service_3_quote" class="form-label">Service 3 Quote</label>
                <input type="text" name="service_3_quote" class="form-control" id="service_3_quote"
                    placeholder="Service 3 Quote" value="{{ $info->service_3_quote }}" required>
            </div>

            {{-- Facebook Link --}}
            <div class="mb-3">
                <label for="fb_link" class="form-label">Facebook Link</label>
                <input type="text" name="fb_link" class="form-control" id="fb_link" placeholder="Facebook Link"
                    value="{{ $info->fb_link }}" required>
            </div>

            {{-- Facebook Live Title --}}
            <div class="mb-3">
                <label for="live_title" class="form-label">Facebook Live Title</label>
                <input type="text" name="live_title" class="form-control" id="live_title"
                    placeholder="Facebook Live Title" value="{{ $info->live_title }}" required>
            </div>

            {{-- Facebook Live Recent --}}
            <div class="mb-3">
                <label for="live_link" class="form-label">Facebook Live Link</label>
                <input type="text" name="live_link" class="form-control" id="live_link"
                    placeholder="Facebook Live Link" value="{{ $info->live_link }}" required>
            </div>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $("#site_logo").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_logo_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#site_main_banner").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_main_banner_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#site_second_banner").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_second_banner_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#site_service_1").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_service_1_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#site_service_2").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_service_2_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $("#site_service_3").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#site_service_3_tag').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endsection
