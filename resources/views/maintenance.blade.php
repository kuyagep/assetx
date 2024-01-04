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
        })(window, document, 'script', 'dataLayer', 'GTM-5CZ6KPHZ');
    </script>
    <!-- End Google Tag Manager -->

    <style type="text/css">
        body {
            text-align: center;
            /* padding: 150px; */
        }

        h1 {
            font-size: 40px;
        }

        body {
            font: 20px Poppins, sans-serif;
            color: #333;
        }

        #article {
            display: block;
            text-align: left;
            width: 100%;
            margin: 0 auto;
        }

        a {
            color: #ff6600;
            text-decoration: none;
        }

        a:hover {
            color: #2253db;
            text-decoration: none;
        }
    </style>
</head>

<body class="hold-transition layout-top-nav ">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CZ6KPHZ" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="wrapper ">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-dark accent-navy bg-navy">
            <div class="container">
                <a href="javascript:void(0);" class="navbar-brand mt-2 text-white">
                    <img src="{{ asset('brand_logo/logo.png') }}" alt="Logo" class="brand-image  elevation-0"
                        style="opacity: .8; height: 70px;">
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse"
                    data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>



                <!-- Right navbar links -->
                <div class="text-center collapse navbar-collapse order-2" id="navbarCollapse">
                    <ul class=" order-md-2 navbar-nav navbar-no-expand ml-auto">

                        <li class="nav-item">
                            <span href="javascript:void(0)" aria-expanded="false" class="nav-link text-white">
                                <div class="current-date" id="current-date"> </div>
                            </span>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
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
            <div class="content ">
                <div class="container ">
                    <div class="row mt-5">
                        <div class="col-8 offset-2">
                            <div id="article">
                                <h1>We&rsquo;ll be back soon!</h1>
                                <div>
                                    <p>Sorry for the inconvenience but we&rsquo;re performing some maintenance at the
                                        moment. If you need to you can always <a href="http://202.137.126.58/">contact
                                            us</a>,
                                        otherwise we&rsquo;ll be back online shortly!</p>
                                    <p>&mdash; Developer Team</p>

                                    <a href="http://202.137.126.58/" class="btn bg-danger "
                                        style="color: white !important;">BACK TO
                                        MAIN
                                        PAGE</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
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
