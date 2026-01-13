<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>PP MIS SARANG</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{ asset('/assets/img/logomis.png') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/img/logomis.png') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": [
                    "Flaticon",
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: ["/assets/css/fonts.min.css"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/atlantis.css">

    <style type="text/css">
        .login_page {
            background-image: url("/assets/img/bg-3.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            height: auto;
        }

        .box_login {
            position: fixed;
            top: 15%;
            left: 50%;
            width: 30em;
            height: 18em;
            margin-left: -15em;
        }

        @media only screen and (max-width: 726px) {
            .box_login {
                position: absolute;
                top: 15%;
                left: 50%;
                width: 24em;
                height: 10em;
                margin-left: -12em;
            }
        }
    </style>
</head>

<body class="login_page">
    <div class="wrapper">
        <div id="overlay"></div>
        <center>
            <div class="box_login" style="max-width: 350px;">
                @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    {{session('loginError')}}
                </div>

                @endif
                <form id="form-login" method="POST"  action="{{ route('login') }}">
                   @csrf

                    <div>
                        <center>
                            <img src="{{ asset('/assets/img/logomis.png') }}" style="height: 100px; width: 100px;">
                            <br>
                            <span style="font-size: 20px;">PP MIS SARANG</span>
                            <br>
                            <span>Silahkan login untuk mengakses aplikasi</span>
                            <br>
                        </center>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="icon-user"></i>
                            </span>
                            <input id="username" type="text" class="form-control" name="username" value="{{old('username')}}"
                                placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-icon">
                            <span class="input-icon-addon">
                                <i class="icon-key"></i>
                            </span>
                            <input id="password" type="password" class="form-control" name="password"
                                placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn form-control btn-success btn-round">Masuk</button>
                    </div>
                    <div>
                        <div>SIM PP MIS SARANG - © 2025</div>


                    </div>
            </div>
            </form>
        </center>
    </div>

</body>

</html>
