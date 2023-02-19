@extends('layouts.master')

@section('title')
    <title> Admin | Profile Page </title>
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
            <div class="container">
                <div class="row my-2 text-success container">
                    <h3> {{ session()->get('successfull') }} </h3>
                </div>
            </div>
        @endif

        <section>
            <div class="container py-5">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <img src="{{ asset('backend/img/undraw_profile.svg') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px;">
                                <h5 class="mt-3 mb-1">
                                    <b class="text-primary"> {{ $user->first_name . ' ' . $user->last_name }}</b> |
                                    <i>ADMIN</i>
                                </h5>
                                <p class="text-muted m-0 mb-2">Customer since
                                    {{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('F d, Y') }}
                                </p>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 h-100">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h5 class="mb-0 text-primary"><b>Profile Details</b></h5>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->first_name . ' ' . $user->last_name }}
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">{{ $user->phone_number }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Type</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">ADMIN</p>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card mb-4 h-100">
                                <div class="card-body">
                                    <form action="/admin/settings/update_password" method="POST">
                                        <div class="row">

                                            <span class="d-flex justify-content-between align-items-center ms-1 mb-3">
                                                <h5 class="mb-0 text-primary"><b>Change Password</b></h5>
                                            </span>

                                            @csrf
                                            <div class="mb-3">
                                                <label for="oldPasswordInput" class="form-label">Old Password</label>
                                                <input name="old_password" type="password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    id="oldPasswordInput" placeholder="Old Password">
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="newPasswordInput" class="form-label">New Password</label>
                                                <input name="new_password" type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    id="newPasswordInput" placeholder="New Password">
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirmNewPasswordInput" class="form-label">Confirm New
                                                    Password</label>
                                                <input name="new_password_confirmation" type="password" class="form-control"
                                                    id="confirmNewPasswordInput" placeholder="Confirm New Password">
                                            </div>

                                            <div class="mb-3 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Change Password</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>




        </section>
    </div>

    <script src="{{ asset('backend/vendor/jquery/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
@endsection
