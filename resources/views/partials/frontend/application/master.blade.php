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
            font-family: Helvetica, sans-serif !important;
            color: #333;
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
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content " style="height:100vh;">
                <div class="row ">
                    <div class="col-lg-6 col-sm-12  bg-navy">
                        <div class="container">
                            <h1>My First Bootstrap Page</h1>
                            <p>This is some text.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12 bg-white">
                        <div class="container">
                            <h1>My First Bootstrap Page</h1>
                            <p>This is some text.</p>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <div class="footer-clean">
            <footer>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-sm-4 col-md-3 item">
                            <img class="" src="{{ asset('brand_logo/gov-ph-seal-footer.png') }}" height="150px"
                                alt="cards">
                            <br>Republic of the Philippines<br>All content is in the public domain unless otherwise
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
