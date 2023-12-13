<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi - Homi Desain</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background: #007bff;
            background: linear-gradient(to right, #0741ed, #f08519);
        }

        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }

        .btn-google {
            color: white !important;
            background-color: #ea4335;
        }

        .btn-facebook {
            color: white !important;
            background-color: #3b5998;
        }

        .center {
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
    </style>
</head>

<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->

<body>
    <div class="container my-4">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 ">
                    <img class="text-center center mt-4" src="{{ asset('assets') }}/images/homidesain-closing.png"
                        width="230" height="125" alt="">
                    <div class="card-body p-sm-5 justify-content-center">
                        <h4 class="card-title text-center mb-4 fw-light fs-4">Sign up</h4>
                        <form action="{{ route('register.store') }}" method="POST" class="form">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" id="name" placeholder="">
                                <label for="name">Nama</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" name="email" class="form-control" id="email" placeholder="">
                                <label for="email">E-mail</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="phone_number" class="form-control" id="phone_number"
                                    placeholder="">
                                <label for="phone_number">Nomor Telepon</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth"
                                    placeholder="">
                                <label for="date_of_birth">Tanggal Lahir</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="username" class="form-control" id="username" placeholder="">
                                <label for="username">Username</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" id="password"
                                    placeholder="">
                                <label for="password">Password</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="referral_code" class="form-control" id="referral_code"
                                    placeholder="">
                                <label for="referral_code">Kode Referral</label>
                            </div>

                            <div class="form-check mb-3">
                                {{-- <input class="form-check-input" type="checkbox" value=""
                                    id="rememberPasswordCheck"> --}}
                                <label class="form-check-label" for="rememberPasswordCheck">
                                    {{-- Remember password --}}
                                </label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-login text-uppercase fw-bold"
                                    style="background-color: #0741ed; color:#fff" type="submit">Register</button>
                            </div>

                            <hr class="mb-4">
                        </form>
                        <div class="my-2 text-center">
                            <label class="text-center" for="">
                                Already Have an Account ? <a href="{{ route('login') }}">Log in</a>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Add this in the head section of your HTML file -->
<script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/iconify/3.1.1/iconify.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

</html>