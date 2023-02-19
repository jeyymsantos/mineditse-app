<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Sign up to Mine Ditse </title>

    <link rel="shortcut icon" href="{{ asset('img/Logo.png') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.css" rel="stylesheet" />


    <style>
        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #a1c4fd;

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1));

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, rgba(161, 196, 253, 1), rgba(194, 233, 251, 1))
        }

        .bg-indigo {
            background-color: #4835d4;
        }

        @media (min-width: 992px) {
            .card-registration-2 .bg-indigo {
                border-top-right-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }

        @media (max-width: 991px) {
            .card-registration-2 .bg-indigo {
                border-bottom-left-radius: 15px;
                border-bottom-right-radius: 15px;
            }
        }
    </style>

</head>

<body>

    <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('register') }}">
        @csrf
        <section class="h-100 h-custom gradient-custom-2">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="p-5">
                                            <h3 class="fw-normal mb-5" style="color: #4835d4;">Account Infomation
                                            </h3>

                                            <div class="row">
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input id="first_name" type="text"
                                                            class="form-control form-control-lg @error('first_name') is-invalid @enderror"
                                                            name="first_name" value="{{ old('first_name') }}" required
                                                            autocomplete="first_name" autofocus maxlength="50">
                                                        <label for="first_name"
                                                            class="form-label">{{ __('First Name') }}</label>

                                                        @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-6 mb-4 pb-2">
                                                    <div class="form-outline">
                                                        <input id="last_name" type="text"
                                                            class="form-control form-control-lg @error('last_name') is-invalid @enderror"
                                                            name="last_name" value="{{ old('last_name') }}" required
                                                            autocomplete="last_name" autofocus maxlength="50">
                                                        <label for="last_name"
                                                            class="form-label">{{ __('Last Name') }}</label>

                                                        @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input id="email" type="email"
                                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" autofocus maxlength="100">
                                                    <label for="email"
                                                        class="form-label">{{ __('Email') }}</label>

                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input id="password" type="password"
                                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                                        name="password" value="{{ old('password') }}" required
                                                        autocomplete="password" autofocus maxlength="100">
                                                    <label for="password"
                                                        class="form-label">{{ __('Password') }}</label>

                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline">
                                                    <input id="password_confirm" type="password"
                                                        class="form-control form-control-lg"
                                                        name="password_confirmation" required
                                                        autocomplete="new-password" maxlength="100">
                                                    <label for="password_confirm"
                                                        class="form-label">{{ __('Confirm Password') }}</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 bg-indigo text-white">
                                        <div class="p-5">
                                            <h3 class="fw-normal mb-5">Contact Information</h3>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline form-white">
                                                    <input id="street" type="text"
                                                        class="form-control form-control-lg @error('street') is-invalid @enderror"
                                                        name="street" value="{{ old('street') }}" required
                                                        autocomplete="street" autofocus maxlength="100">

                                                    <label for="street"
                                                        class="form-label">{{ __('Street') }}</label>

                                                    @error('street')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-5 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input id="barangay" type="text"
                                                            class="form-control form-control-lg @error('barangay') is-invalid @enderror"
                                                            name="barangay" value="{{ old('barangay') }}" required
                                                            autocomplete="barangay" autofocus maxlength="100">
                                                        <label for="barangay"
                                                            class="form-label">{{ __('Barangay') }}</label>

                                                        @error('barangay')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                </div>
                                                <div class="col-md-7 mb-4 pb-2">
                                                    <div class="form-outline form-white">
                                                        <input id="city" type="text"
                                                            class="form-control form-control-lg @error('city') is-invalid @enderror"
                                                            name="city" value="{{ old('city') }}" required
                                                            autocomplete="city" autofocus maxlength="100">
                                                        <label for="city"
                                                            class="form-label">{{ __('City') }}</label>
                                                        @error('city')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline form-white">
                                                    <input id="province" type="text"
                                                        class="form-control form-control-lg @error('province') is-invalid @enderror"
                                                        name="province" value="{{ old('province') }}" required
                                                        autocomplete="province" autofocus maxlength="100">
                                                    <label for="province"
                                                        class="form-label">{{ __('Province') }}</label>

                                                    @error('province')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="mb-4 pb-2">
                                                <div class="form-outline form-white">

                                                    <input id="phone" type="text"
                                                        class="form-control form-control-lg @error('phone') is-invalid @enderror"
                                                        name="phone" value="{{ old('phone') }}" required minlength="11" maxlength="11"
                                                        autocomplete="phone" autofocus title="09xxxxxxxxx">
                                                    <label for="phone"
                                                        class="form-label">{{ __('Phone Number') }}</label>

                                                    @error('phone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-light btn-lg"
                                                data-mdb-ripple-color="dark">Register</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.1.0/mdb.min.js"></script>

</body>

</html>
