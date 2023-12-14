<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="fonts/icomoon/style.css" />

    <link rel="stylesheet" href="css/owl.carousel.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" />

    <title>Login </title>
</head>

<body>
    <div class="content">
        <div class="container">
            <div class=" text-3xl font-bold justify-content-center">
                <h1>PostHarvest Real Time Inventory Management System (PHRTIMS)</h1>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <img src="images/undraw_remotely_2j6y.svg" alt="Image" class="img-fluid" />
                </div>
                <div class="col-md-6 contents">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h3>Sign In</h3>
                                <p class="mb-4">
                                    {{-- Lorem ipsum dolor sit amet elit. Sapiente sit aut eos
                                    consectetur adipisicing. --}}
                                </p>
                            </div>
                            <form action="{{ route('login') }}" method="POST">
                                @csrf

                                <div class="form-group first">
                                    <label for="username">Email or Username</label>
                                    <input type="email" class="form-control" id="email" name="email" />
                                </div>
                                <br>
                                <div class="mb-4 form-group last">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>

                                <div class="mb-5 d-flex align-items-center">
                                    <label class="mb-0 control control--checkbox"><span class="caption">Remember
                                            me</span>
                                        <input type="checkbox" checked="checked" />
                                        <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="{{ route('password.request') }}"
                                            class="forgot-pass">Forgot
                                            Password</a></span>
                                </div>

                                <input type="submit" class="btn btn-block btn-primary hover:cursor-pointer" />

                                {{-- <span class="my-4 text-left d-block text-muted">&mdash; or login with &mdash;</span>

                                <div class="social-login">
                                    <a href="#" class="facebook">
                                        <span class="mr-3 icon-facebook"></span>
                                    </a>
                                    <a href="#" class="twitter">
                                        <span class="mr-3 icon-twitter"></span>
                                    </a>
                                    <a href="#" class="google">
                                        <span class="mr-3 icon-google"></span>
                                    </a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>
