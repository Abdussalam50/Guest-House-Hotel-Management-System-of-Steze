<?php
include '../include/function/login.php';
$url = "../data/tmp/mikro-stay/file/";
// include '../include/all_include.php';
// include '../include/function/session.php';
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo $judul; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link href="<?php echo $url; ?>files/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url; ?>files/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url; ?>files/style.bundle.css" rel="stylesheet" type="text/css" />
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-37564768-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-37564768-1');
    </script>

    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking)
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>


<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <div class="d-flex flex-column flex-root" id="kt_app_root">

        <style>
            body {
                background-image: url('../data/image/logo/bg10.jpeg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('../data/image/logo/bg10.jpeg');
            }
        </style>

        <style>
            @media (min-width: 992px) {
                .custom-align-lg {
                    align-self: center !important;
                    align-items: center !important;
                }
            }
        </style>
        <div class="d-flex flex-column flex-lg-row flex-column-fluid custom-align-lg">





            <style>
                #mobile {
                    display: none;
                }

                #desktop {
                    display: inline-block;
                }

                #desktop2 {
                    display: inline-block;
                }


                @media (max-width: 767px) {
                    #mobile {
                        display: inline-block;
                    }

                    #desktop {
                        display: none;
                    }

                    #desktop2 {
                        display: none;
                    }


                }
            </style>


            <div class="d-flex flex-lg-row-fluid">

                <div id="desktop2">
                    <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                            src="../data/image/logo/steze-2.png" alt="">


                        <div class="text-gray-600 fs-base text-center fw-semibold">
                            Software for managing rooms, handling transactions, <br>and generating cash flow reports. — All in One Software <?php echo $judul; ?>

                        </div>
                    </div>
                </div>
            </div>



            <div class=" p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-600 w-md-400px">

                        <div class="d-flex flex-center flex-column pb-10 pb-lg-20">
                            <form class="form w-100 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"
                                id="kt_sign_in_form" data-kt-redirect-url="" action="" method="post">
                                <div class="text-center mb-11">
                                    <div id="mobile">
                                        <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                                            src="../data/image/logo/belanjo_vektor3.png" alt="">
                                        <h1 class="text-dark fw-bolder mb-3 ">
                                            <?php echo $judul; ?>
                                            <hr>
                                            <h2 class='text-center text-danger'>Admin</h2>
                                        </h1>
                                    </div>

                                    <div id="desktop">
                                        <h1 class="text-dark fw-bolder mb-3 ">
                                            <?php echo $judul; ?>
                                        </h1>
                                        <hr>

                                        <h2 class='text-center text-danger'>Admin</h2>

                                    </div>

                                    <div class="text-gray-500 fw-semibold fs-6">

                                        <?php echo $alamat; ?>
                                    </div>

                                </div>

                                <div class="fv-row mb-8 fv-plugins-icon-container">

                                    <select class="form-control" name="id_hotel" id="id_hotel" placeholder=" Hotel ">
                                        <option>-- Select Kost or Guest House --</option><?php combo_database_v2('data_hotel', 'id_hotel', 'nama', ''); ?>
                                        <option value="">Super Admin</option>
                                        <option value="operasional">Operasional</option>
                                    </select>
                                </div>
                                <div class="fv-row mb-8 fv-plugins-icon-container">

                                    <input type="text" placeholder="Username" name="username" autocomplete="off"
                                        class="form-control bg-transparent">

                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>


                                <div class="fv-row mb-3 fv-plugins-icon-container">

                                    <input type="password" placeholder="Password" name="password" autocomplete="off"
                                        class="form-control bg-transparent">

                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>

                                <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                    <div></div>


                                </div>


                                <div class="d-grid mb-10">
                                    <button type="submit" name="login" id="kt_sign_in_submit" class="btn btn-danger">


                                        <span class="indicator-label">
                                            Sign In</span>



                                        </span>
                                    </button>
                                </div>


                            </form>

                            <div>

                                <br>

                                <center>
                                    <?php echo $copyright; ?>
                                </center>


                            </div>
                        </div>







                    </div>

                </div>

            </div>

        </div>
    </div>


    <script src="<?php echo $url; ?>files/plugins.bundle.js"></script>
    <script src="<?php echo $url; ?>files/scripts.bundle.js"></script>


    <script src="<?php echo $url; ?>files/datatables.bundle.js"></script>


    <script src="<?php echo $url; ?>files/pos.js"></script>
    <script src="<?php echo $url; ?>files/widgets.bundle.js"></script>
    <script src="<?php echo $url; ?>files/widgets.js"></script>
    <script src="<?php echo $url; ?>files/chat.js"></script>
    <script src="<?php echo $url; ?>files/create-app.js"></script>
    <script src="<?php echo $url; ?>files/users-search.js"></script>


</body>


</html>