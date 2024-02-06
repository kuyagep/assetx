<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('brand_logo/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('brand_logo/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('brand_logo/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('brand_logo/site.webmanifest') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">


    <style>
        body {
            font-family: Roboto, sans-serif !important;
            color: #333;
        }

        nav {
            background-color: #0D528A !important;
        }

        .footer-clean {
            padding: 50px 0;
            background-color: rgb(0, 0, 0);
            color: #ffffff;
            margin-top: -15px;
        }

        .footer-clean h3 {
            margin-top: 0;
            margin-bottom: 12px;
            font-weight: bold;
            font-size: 16px;
        }

        .footer-clean ul {
            padding: 0;
            list-style: none;
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 0;
        }

        .footer-clean ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.8;
        }

        .footer-clean ul a:hover {
            opacity: 1;
        }

        .footer-clean .item.social {
            text-align: right;
        }

        @media (max-width:767px) {
            .footer-clean .item {
                text-align: center;
                padding-bottom: 20px;
            }
        }

        @media (max-width: 768px) {
            .footer-clean .item.social {
                text-align: center;
            }
        }

        .footer-clean .item.social>a {
            font-size: 24px;
            width: 40px;
            height: 40px;
            line-height: 40px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            border: 1px solid #ccc;
            margin-left: 10px;
            margin-top: 22px;
            color: inherit;
            opacity: 0.75;
        }

        .footer-clean .item.social>a:hover {
            opacity: 0.9;
        }

        @media (max-width:991px) {
            .footer-clean .item.social>a {
                margin-top: 40px;
            }
        }

        @media (max-width:767px) {
            .footer-clean .item.social>a {
                margin-top: 10px;
            }
        }

        .footer-clean .copyright {
            margin-top: 14px;
            margin-bottom: 0;
            font-size: 13px;
            opacity: 0.6;
        }
    </style>

    @include('partials.analytics')
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-PQVBC2BK');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body class="hold-transition layout-top-nav ">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PQVBC2BK" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper ">

        <!-- Navbar -->
        @include('partials.frontend.application.navbar')
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper ">
            <!-- Main content -->
            <div class="content mb-5">
                {{-- <div class="content mt-5" style="height:100vh;"> --}}
                <div class="row  ">
                    <div class="col-lg-12">
                        <div class="container ">
                            <div class="card card-primary mt-5">
                                <div class="card-header">
                                    <h4 class="card-title text-white">Application</h4>
                                    <div class="card-tools">
                                        <button type="submit" class="btn btn-default btn-flat btn-sm">
                                            Cancel Application</button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h6 class="heading-small text-muted mb-4">Work Assignment</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="division">Division
                                                        Office</label>
                                                    <select name="division" id="division"
                                                        class="rounded-0 custom-select" disabled>
                                                        <option value="">- Choose Divisin -</option>
                                                        <option value="1" selected>Division of Davao del Sur
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="district">District/Office
                                                    </label>
                                                    <select name="district" id="district"
                                                        class="rounded-0 custom-select">
                                                        <option value="">- Select -</option>
                                                        <option value="0">Division Personnel
                                                        </option>
                                                        <option value="1">Hagonoy I
                                                        </option>
                                                    </select>
                                                    @error('district')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="office_school">School/Office</label>
                                                    <select name="office_school" id="office_school"
                                                        class="custom-select rounded-0">
                                                        <option value="">Select...</option>
                                                        <option value="1">Supply
                                                        </option>
                                                    </select>
                                                    @error('email')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <h6 class="heading-small text-muted mb-4">User Information</h6>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Employee
                                                        No.</label>
                                                    <input type="text" id="employee_number" name="employee_number"
                                                        class="form-control rounded-0"
                                                        placeholder="Enter employee number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-first-name">First
                                                        name</label>
                                                    <input type="text" id="first_name" name="first_name"
                                                        class="form-control rounded-0" placeholder="First name"
                                                        value="{{ old('first_name') }}">
                                                    @error('first_name')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="middle_name">Middle
                                                        name</label>
                                                    <input type="text" id="middle_name" name="middle_name"
                                                        class="form-control rounded-0" placeholder="Middle name"
                                                        value="{{ old('middle_name') }}">
                                                    @error('middle_name')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="last_name">Last
                                                        name</label>
                                                    <input type="text" id="last_name" name="last_name"
                                                        class="form-control rounded-0" placeholder="Last name"
                                                        value="{{ old('last_name') }}">
                                                    @error('last_name')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-1">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="mi">M.I</label>
                                                    <input type="text" id="mi" name="mi"
                                                        class="form-control rounded-0" placeholder="Middle initial"
                                                        value=" {{ old('mi') }}">
                                                    @error('mi')
                                                        <small class="text-danger">
                                                            {{ $message }}
                                                        </small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12">
                                                <label>Deped Email Address</label>
                                                <input type="email"
                                                    class="form-control rounded-0 @error('email')  is-invalid   @enderror "
                                                    name="email" placeholder="Enter Email Address" required>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-lg-6 col-sm-12"><label>New Password</label>
                                                <input type="password"
                                                    class="form-control rounded-0 @error('password')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                                    name="password" placeholder="Enter password" required="">
                                                @error('password')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-lg-6 col-sm-12"><label>Confirm Password</label>
                                                <input type="password_confirmation"
                                                    class="form-control rounded-0 @error('password_confirmation')                                             
                                                    is-invalid                                              
                                                 @enderror "
                                                    name="password_confirmation"
                                                    placeholder="Confirm New Password"required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row float-right mt-3">
                                        <button type="submit" class="btn btn-primary btn-flat btn-lg">
                                            <i class="fa-regular fa-circle-right"></i>
                                            Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- /.content -->
            <div class="footer-clean">
                <footer>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-sm-4 col-md-3 item">
                                <img class="" src="{{ asset('brand_logo/gov-ph-seal-footer-white.png') }}"
                                    height="150px" alt="cards">
                                <br>Republic of the Philippines<br>All content is in the public domain unless
                                otherwise
                                stated.
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>About</h3>
                                <ul>
                                    <li><a href="https://www.sec.gov.ph">DEPED Website</a></li>
                                    <li><a href="https://www.gov.ph/">GOVPH</a></li>
                                    <li><a href="https://www.gov.ph/data">Open Data Portal</a></li>
                                    <li><a href="https://www.officialgazette.gov.ph/">Official Gazette</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-md-3 item">
                                <h3>Links</h3>
                                <ul>
                                    <li><a href="#">HEREOS</a></li>
                                    <li><a href="#">eDAMS</a></li>
                                    <li><a href="#">FLAMES</a></li>
                                    <li><a href="#">FAMOUS</a></li>
                                    <li><a href="#">VERT</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-3 item social">
                                <!-- <a href="#"><i class="icon ion-social-facebook"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-instagram"></i></a> -->
                                <p class="copyright">Department of Education <br>
                                    Region XI Davao del Sur <br>{{ date('Y') }}</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>

        </div>
        <!-- /.content-wrapper -->



    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('assets/') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/') }}/dist/js/adminlte.min.js"></script>

    <script src="{{ asset('assets/custom/js/realtime.js') }}"></script>
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#data-privacy-notice').modal('show');
            const $modalBody = $('#modal-body');
            const $scrollButton = $('#scrollButton');

            $modalBody.scroll(function() {
                // Check if the user has scrolled to a certain point (e.g., 200 pixels)
                if ($modalBody.scrollTop() >= 200) {
                    $scrollButton.prop('disabled', false);
                } else {
                    $scrollButton.prop('disabled', true);
                }
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            const $modalBody = $('#modal-body');
            const $scrollButton = $('#scrollButton');

            $modalBody.scroll(function() {
                // Check if the user has scrolled to a certain point (e.g., 200 pixels)
                if ($modalBody.scrollTop() >= 200) {
                    $scrollButton.prop('disabled', false);
                } else {
                    $scrollButton.prop('disabled', true);
                }
            });
        });
    </script> --}}
</body>

</html>
