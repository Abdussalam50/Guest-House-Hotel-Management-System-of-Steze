<?php
$url = "../../../data/tmp/mikro-stay/file/";
include '../../../include/all_include.php';
include '../../../include/function/session.php';
$id_hotel = decrypt($_COOKIE['id_hotel']);
function lastpath($path)
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $current_url = "$protocol://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $tokens = explode('/', $current_url);
    $last = $tokens[sizeof($tokens) - 2];
    if ($last == $path) {
        return true;
    } else {
        return false;
    }
}

$me = decrypt($_COOKIE['kodene']);
$jenenge = ucwords(decrypt($_COOKIE['jenenge']));
$color_type = "danger";

?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?php echo $judul; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="<?php echo $judul; ?>" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="<?php echo $url; ?>files/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url; ?>files/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $url; ?>files/style.bundle.css" rel="stylesheet" type="text/css" />
    <script>
        if (window.top != window.self) {
            window.top.location.replace(window.self.location.href);
        }
    </script>
</head>

<body id="kt_app_body" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">

    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>


    <style>
        .highlight {
            position: relative;
            background: #1e1e3f00;
            border-radius: 0.85rem;
            padding: 1.75rem 1.5rem 1.75rem 1.5rem;
        }
    </style>


    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">

            <br>
            <br>
            <div id="kt_app_header"
                data-kt-sticky-name="app-header-sticky">





            </div>



            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">


                <!--begin::Sidebar-->
                <div id="kt_app_sidebar" class="app-sidebar  flex-column " data-kt-drawer="true"
                    data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}"
                    data-kt-drawer-overlay="true" data-kt-drawer-width="275px" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_app_sidebar_toggle">

                    <div class="d-flex flex-stack px-4 px-lg-6 py-3 py-lg-8" id="kt_app_sidebar_logo">
                        <!--begin::Logo image-->
                        <a href="#">
                            <img alt="Logo" src="../../../data/image/logo/steze-2.png" class="h-20px h-lg-25px theme-light-show" style="
    height: 35px !important;
    margin-left: 10px;
">
                            <img alt="Logo" src="../../../data/image/logo/steze-2.png" class="h-20px h-lg-25px theme-dark-show"> <b style="color:black"></b>
                        </a>
                        <!--end::Logo image-->

                        <!--begin::User menu-->
                        <div class="ms-3">
                            <!--begin::Menu wrapper-->
                            <div class="cursor-pointer position-relative symbol symbol-circle symbol-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                <img src="<?php echo $avatar; ?>" alt="user" style="
    width: 32px;
    height: 32px;
    margin-right:10px;
">


                            </div>

                            <!--begin::User account menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">


                                        <!--begin::Username-->
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center ">
                                                Account
                                                <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"><?php echo $jenenge; ?></span>
                                            </div>

                                            <a href="#" class="fw-semibold text-muted text-hover-<?php echo $color_type; ?> fs-7">
                                                administrator@gmail.com </a>
                                        </div>
                                        <!--end::Username-->
                                    </div>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu separator-->
                                <div class="separator my-2"></div>
                                <!--end::Menu separator-->






                                <!--begin::Menu item-->
                                <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                    <a href="#" class="menu-link px-5">
                                        <span class="menu-title position-relative">
                                            Mode

                                            <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M13.341 22H11.341C10.741 22 10.341 21.6 10.341 21V18C10.341 17.4 10.741 17 11.341 17H13.341C13.941 17 14.341 17.4 14.341 18V21C14.341 21.6 13.941 22 13.341 22ZM18.5409 10.7L21.141 9.19997C21.641 8.89997 21.7409 8.29997 21.5409 7.79997L20.5409 6.09997C20.2409 5.59997 19.641 5.49997 19.141 5.69997L16.5409 7.19997C16.0409 7.49997 15.941 8.09997 16.141 8.59997L17.141 10.3C17.441 10.8 18.0409 11 18.5409 10.7ZM8.14096 7.29997L5.54095 5.79997C5.04095 5.49997 4.44096 5.69997 4.14096 6.19997L3.14096 7.89997C2.84096 8.39997 3.04095 8.99997 3.54095 9.29997L6.14096 10.8C6.64096 11.1 7.24095 10.9 7.54095 10.4L8.54095 8.69997C8.74095 8.19997 8.64096 7.49997 8.14096 7.29997Z" fill="grey"></path>
                                                    <path d="M13.3409 7H11.3409C10.7409 7 10.3409 6.6 10.3409 6V3C10.3409 2.4 10.7409 2 11.3409 2H13.3409C13.9409 2 14.3409 2.4 14.3409 3V6C14.3409 6.6 13.9409 7 13.3409 7ZM5.54094 18.2L8.14095 16.7C8.64095 16.4 8.74094 15.8 8.54094 15.3L7.54094 13.6C7.24094 13.1 6.64095 13 6.14095 13.2L3.54094 14.7C3.04094 15 2.94095 15.6 3.14095 16.1L4.14095 17.8C4.44095 18.3 5.04094 18.5 5.54094 18.2ZM21.1409 14.8L18.5409 13.3C18.0409 13 17.4409 13.2 17.1409 13.7L16.1409 15.4C15.8409 15.9 16.0409 16.5 16.5409 16.8L19.1409 18.3C19.6409 18.6 20.2409 18.4 20.5409 17.9L21.5409 16.2C21.7409 15.7 21.6409 15 21.1409 14.8Z" fill="grey"></path>
                                                </svg> </span>
                                        </span>
                                    </a>

                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px" data-kt-menu="true" data-kt-element="theme-mode-menu" style="">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2 active" data-kt-element="mode" data-kt-value="light">
                                                <span class="menu-icon" data-kt-element="icon">
                                                </span>
                                                <span class="menu-title">
                                                    Light
                                                </span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">
                                                <span class="menu-icon" data-kt-element="icon">
                                                </span>
                                                <span class="menu-title">
                                                    Dark
                                                </span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-0">
                                            <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">
                                                <span class="menu-icon" data-kt-element="icon">
                                                </span>
                                                <span class="menu-title">
                                                    System
                                                </span>
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->

                                </div>
                                <!--end::Menu item-->




                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="../../../login/logout.php" class="menu-link px-5">
                                        Sign Out
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::User account menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::User menu-->
                    </div>

                    <!--begin::Sidebar nav-->
                    <div class="flex-column-fluid px-4 px-lg-8 py-4" id="kt_app_sidebar_nav">
                        <!--begin::Nav wrapper-->
                        <div id="kt_app_sidebar_nav_wrapper" class="d-flex flex-column hover-scroll-y pe-4 me-n4"
                            data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                            data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                            data-kt-scroll-wrappers="#kt_app_sidebar, #kt_app_sidebar_nav" data-kt-scroll-offset="5px">


                            <!--begin::Stats-->
                            <div class="d-flex mb-3 mb-lg-6">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6">
                                    <!--begin::Date-->
                                    <span class="fs-6 text-gray-500 fw-bold">Pelanggan


                                    </span>
                                    <?php
                                    $queryPelanggan = mysql_query("SELECT * FROM data_pelanggan WHERE id_hotel='$id_hotel'");
                                    $jumlahPelanggan = mysql_num_rows($queryPelanggan);
                                    ?>
                                    <!--end::Date-->

                                    <!--begin::Label-->
                                    <div id="transaksi" class="fs-5 fw-bold text-black"> <?php echo $jumlahPelanggan ?>
                                        Pelanggan
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 ">
                                    <!--begin::Date-->
                                    <span class="fs-6 text-gray-500 fw-bold">Transaksi</span>
                                    <!--end::Date-->
                                    <?php
                                    $queryTransaksi = mysql_query("SELECT * FROM data_transaksi JOIN data_pelanggan ON data_transaksi.id_pelanggan=data_pelanggan.id_pelanggan WHERE data_transaksi.id_hotel='$id_hotel'");
                                    $jumlahTransaksi = mysql_num_rows($queryTransaksi);
                                    ?>
                                    <!--begin::Label-->
                                    <div id="tersedia" class="fs-5 fw-bold text-black"> <?php echo $jumlahTransaksi ?>
                                        Transaksi
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->


                            </div>
                            <!--end::Stats-->


                            <!--begin::Links-->
                            <div class="mb-6">


                                <!--begin::Row-->
                                <div class="row row-cols-3" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <div class="col mb-4">

                                        <a href="../index.php"
                                            class="btn btn-icon btn-outline btn-bg-light btn-active-light-<?php echo $color_type; ?> btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                            data-kt-button="true">
                                            <!--begin::Icon-->
                                            <span class="mb-2">
                                                <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen019.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                        fill="grey" />
                                                    <path opacity="0.3"
                                                        d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                        fill="grey" />
                                                </svg>
                                                <!--end::Svg Icon--> </span>

                                            <span class="fs-7 fw-bold">Home</span>

                                        </a>

                                    </div>
                                    <?php
                                    if (isset($_COOKIE['jenenge'])) {
                                        $idHotel = decrypt($_COOKIE['id_hotel']);
                                        $m = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);
                                        foreach ($m as $i) {
                                            if ($i->t == 'm') {
                                                $idmenu = $i->id;
                                                if ($idmenu == 'B') {
                                                    $m1 = new SimpleXMLElement('../../../include/settings/menu.xml', null, true);

                                                    foreach ($m1 as $i1) {

                                                        if ($i1->s == "$idmenu" and $i1->t == 'sm') {
                                    ?>
                                                            <div class="col mb-4">

                                                                <a href="<?php echo strtolower($i1->n) == 'data pendapatan' ? $i1->l . "&id_hotel=$idHotel" : (strtolower($i1->n) == 'data cashflow' ? $i1->l . "&id_hotel=$idHotel" : $i1->l) ?>"
                                                                    class="btn btn-icon btn-outline btn-bg-light btn-active-light-<?php echo $color_type; ?> btn-flex flex-column flex-center w-lg-90px h-lg-90px w-70px h-70px border-gray-200"
                                                                    data-kt-button="true">
                                                                    <!--begin::Icon-->
                                                                    <span class="mb-2">
                                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen019.svg-->
                                                                        <?php generateIcon($i1->n) ?>
                                                                        <!--end::Svg Icon--> </span>

                                                                    <span class="fs-7 fw-bold"><?php

                                                                                                echo $i1->n;

                                                                                                ?></span>

                                                                </a>

                                                            </div>

                                        <?php
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        ?>

                                        <?php
                                    }

                                    function generateIcon($name)
                                    {
                                        $convert = strtolower(str_replace(" ", '', $name));
                                        if ($convert === 'pelanggan') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                    fill="grey" />
                                                <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                    fill="grey" />
                                            </svg>
                                        <?php
                                        } elseif ($convert == 'admin') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 10.7192H3C2.4 10.7192 2 11.1192 2 11.7192C2 12.3192 2.4 12.7192 3 12.7192H6V14.7192C6 18.0192 8.7 20.7192 12 20.7192C15.3 20.7192 18 18.0192 18 14.7192V12.7192H21C21.6 12.7192 22 12.3192 22 11.7192C22 11.1192 21.6 10.7192 21 10.7192Z"
                                                    fill="grey" />
                                                <path d="M11.6 21.9192C11.4 21.9192 11.2 21.8192 11 21.7192C10.6 21.4192 10.5 20.7191 10.8 20.3191C11.7 19.1191 12.3 17.8191 12.7 16.3191C12.8 15.8191 13.4 15.4192 13.9 15.6192C14.4 15.7192 14.8 16.3191 14.6 16.8191C14.2 18.5191 13.4 20.1192 12.4 21.5192C12.2 21.7192 11.9 21.9192 11.6 21.9192ZM8.7 19.7192C10.2 18.1192 11 15.9192 11 13.7192V8.71917C11 8.11917 11.4 7.71917 12 7.71917C12.6 7.71917 13 8.11917 13 8.71917V13.0192C13 13.6192 13.4 14.0192 14 14.0192C14.6 14.0192 15 13.6192 15 13.0192V8.71917C15 7.01917 13.7 5.71917 12 5.71917C10.3 5.71917 9 7.01917 9 8.71917V13.7192C9 15.4192 8.4 17.1191 7.2 18.3191C6.8 18.7191 6.9 19.3192 7.3 19.7192C7.5 19.9192 7.7 20.0192 8 20.0192C8.3 20.0192 8.5 19.9192 8.7 19.7192ZM6 16.7192C6.5 16.7192 7 16.2192 7 15.7192V8.71917C7 8.11917 7.1 7.51918 7.3 6.91918C7.5 6.41918 7.2 5.8192 6.7 5.6192C6.2 5.4192 5.59999 5.71917 5.39999 6.21917C5.09999 7.01917 5 7.81917 5 8.71917V15.7192V15.8191C5 16.3191 5.5 16.7192 6 16.7192ZM9 4.71917C9.5 4.31917 10.1 4.11918 10.7 3.91918C11.2 3.81918 11.5 3.21917 11.4 2.71917C11.3 2.21917 10.7 1.91916 10.2 2.01916C9.4 2.21916 8.59999 2.6192 7.89999 3.1192C7.49999 3.4192 7.4 4.11916 7.7 4.51916C7.9 4.81916 8.2 4.91918 8.5 4.91918C8.6 4.91918 8.8 4.81917 9 4.71917ZM18.2 18.9192C18.7 17.2192 19 15.5192 19 13.7192V8.71917C19 5.71917 17.1 3.1192 14.3 2.1192C13.8 1.9192 13.2 2.21917 13 2.71917C12.8 3.21917 13.1 3.81916 13.6 4.01916C15.6 4.71916 17 6.61917 17 8.71917V13.7192C17 15.3192 16.8 16.8191 16.3 18.3191C16.1 18.8191 16.4 19.4192 16.9 19.6192C17 19.6192 17.1 19.6192 17.2 19.6192C17.7 19.6192 18 19.3192 18.2 18.9192Z"
                                                    fill="grey" />
                                            </svg>
                                        <?php
                                        } else if ($convert == 'operasional') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                                viewBox="0 0 24 25" fill="none">
                                                <path opacity="0.3"
                                                    d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z"
                                                    fill="grey" />
                                                <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z"
                                                    fill="grey" />
                                            </svg>
                                        <?php
                                        } elseif ($convert == 'transaksi') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z"
                                                    fill="grey" />
                                                <path opacity="0.3"
                                                    d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z"
                                                    fill="grey" />
                                                <path opacity="0.3"
                                                    d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z"
                                                    fill="grey" />
                                                <path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z"
                                                    fill="grey" />
                                            </svg>
                                        <?php } elseif ($convert == 'laporan') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                    fill="grey" />
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="grey" />
                                            </svg>

                                        <?php } elseif ($convert == 'Operasional') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 24 25" fill="none">
                                                <path opacity="0.3" d="M8.9 21L7.19999 22.6999C6.79999 23.0999 6.2 23.0999 5.8 22.6999L4.1 21H8.9ZM4 16.0999L2.3 17.8C1.9 18.2 1.9 18.7999 2.3 19.1999L4 20.9V16.0999ZM19.3 9.1999L15.8 5.6999C15.4 5.2999 14.8 5.2999 14.4 5.6999L9 11.0999V21L19.3 10.6999C19.7 10.2999 19.7 9.5999 19.3 9.1999Z" fill="grey"></path>
                                                <path d="M21 15V20C21 20.6 20.6 21 20 21H11.8L18.8 14H20C20.6 14 21 14.4 21 15ZM10 21V4C10 3.4 9.6 3 9 3H4C3.4 3 3 3.4 3 4V21C3 21.6 3.4 22 4 22H9C9.6 22 10 21.6 10 21ZM7.5 18.5C7.5 19.1 7.1 19.5 6.5 19.5C5.9 19.5 5.5 19.1 5.5 18.5C5.5 17.9 5.9 17.5 6.5 17.5C7.1 17.5 7.5 17.9 7.5 18.5Z" fill="grey"></path>
                                            </svg>

                                        <?php } elseif ($convert == 'kamar') {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="grey"></path>
                                                <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="grey"></path>
                                            </svg> <?php } elseif ($convert == 'pengaturan') {
                                                    ?><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="grey"></path>
                                                <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="grey"></path>
                                            </svg>
                                        <?php
                                                } else {
                                        ?>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z"
                                                    fill="grey" />
                                                <path d="M7 16H6C5.4 16 5 15.6 5 15V13H8V15C8 15.6 7.6 16 7 16Z"
                                                    fill="grey" />
                                                <path opacity="0.3"
                                                    d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z"
                                                    fill="grey" />
                                                <path d="M18 16H17C16.4 16 16 15.6 16 15V13H19V15C19 15.6 18.6 16 18 16Z"
                                                    fill="grey" />
                                                <path opacity="0.3"
                                                    d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z"
                                                    fill="grey" />
                                                <path d="M7 5H6C5.4 5 5 4.6 5 4V2H8V4C8 4.6 7.6 5 7 5Z"
                                                    fill="grey" />
                                                <path opacity="0.3"
                                                    d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z"
                                                    fill="grey" />
                                                <path d="M18 5H17C16.4 5 16 4.6 16 4V2H19V4C19 4.6 18.6 5 18 5Z"
                                                    fill="grey" />
                                            </svg>
                                    <?php
                                                }
                                            }
                                    ?>






                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Links-->


                        </div>
                        <!--end::Nav wrapper-->
                    </div>
                    <!--end::Sidebar nav-->

                    <!--begin::Footer-->
                    <div class="flex-column-auto d-flex flex-center px-4 px-lg-8 py-3 py-lg-8" id="kt_app_sidebar_footer">
                        <!--begin::Apps-->
                        <div class="app-footer-item me-6">
                            <!--begin::Menu- wrapper-->
                            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-<?php echo $color_type; ?> w-35px h-35px w-md-40px h-md-40px"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-start">

                                <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M14 3V21H10V3C10 2.4 10.4 2 11 2H13C13.6 2 14 2.4 14 3ZM7 14H5C4.4 14 4 14.4 4 15V21H8V15C8 14.4 7.6 14 7 14Z"
                                            fill="grey" />
                                        <path d="M21 20H20V8C20 7.4 19.6 7 19 7H17C16.4 7 16 7.4 16 8V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z"
                                            fill="grey" />
                                    </svg>
                                </span>
                            </div>

                            <!--begin::My apps-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">Grafik</div>
                                        <!--end::Card title-->

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">


                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body py-5">
                                        <!--begin::Scroll-->
                                        <div class="mh-450px scroll-y me-n5 pe-5">
                                            <!--begin::Row-->
                                            <div class="row g-2">

                                                <div class="col-4">
                                                    <a href="../grafik_transaksi/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">Transaksi</span>
                                                    </a>
                                                </div>


                                                <div class="col-4">
                                                    <a href="../grafik_pendapatan/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">Pendapatan</span>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <a href="../grafik_operasional/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">Operasional</span>
                                                    </a>
                                                </div>


                                                <div class="col-4">
                                                    <a href="../grafik_kamar/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">kamar</span>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="../grafik_type_kamar/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">Type kamar</span>
                                                    </a>
                                                </div>


                                                <div class="col-4">
                                                    <a href="../grafik_rekapitulasi/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen056.svg-->
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/graphs/gra002.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                                            viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M20 8L12.5 5L5 14V19H20V8Z"
                                                                fill="#ed406c" />
                                                            <path d="M21 18H6V3C6 2.4 5.6 2 5 2C4.4 2 4 2.4 4 3V18H3C2.4 18 2 18.4 2 19C2 19.6 2.4 20 3 20H4V21C4 21.6 4.4 22 5 22C5.6 22 6 21.6 6 21V20H21C21.6 20 22 19.6 22 19C22 18.4 21.6 18 21 18Z"
                                                                fill="#ed406c" />
                                                        </svg> <!--end::Svg Icon-->


                                                        <!--end::Svg Icon-->
                                                        <span class="fw-semibold">Rekapitulasi</span>
                                                    </a>
                                                </div>


                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::My apps--> <!--end::Menu wrapper-->
                        </div>
                        <!--end::Apps-->

                        <!--begin::Quick links-->
                        <div class="app-footer-item me-6">
                            <!--begin::Menu- wrapper-->
                            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-<?php echo $color_type; ?> w-35px h-35px w-md-40px h-md-40px"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-start">

                                <span class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z"
                                            fill="grey" />
                                        <path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z"
                                            fill="grey" />
                                    </svg>
                                </span>
                            </div>

                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                                <!--begin::Heading-->
                                <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10"
                                    style="background-image:url('https://preview.keenthemes.com/metronic8/demo23/assets/media/misc/menu-header-bg.jpg')">
                                    <!--begin::Title-->
                                    <h3 class="text-white fw-semibold mb-3">
                                        Master Data
                                    </h3>
                                    <!--end::Title-->

                                    <!--begin::Status-->
                                    <span class="badge bg-<?php echo $color_type; ?> text-inverse-<?php echo $color_type; ?> py-2 px-3"> Shortcut kelola Database</span>
                                    <!--end::Status-->
                                </div>
                                <!--end::Heading-->

                                <!--begin:Nav-->
                                <div class="row g-0">
                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="../data_kamar/index.php"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                                    fill="#4097f7" />
                                                <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                                    fill="#4097f7" />
                                            </svg>
                                            <span class="fs-5 fw-semibold text-gray-800 mb-0">Kamar</span>
                                            <span class="fs-7 text-gray-400">Kelola Kamar</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->

                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="../data_tipe_kamar/index.php"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z"
                                                    fill="#4097f7" />
                                                <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z"
                                                    fill="#4097f7" />
                                                <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z"
                                                    fill="#4097f7" />
                                            </svg>
                                            <span class="fs-5 fw-semibold text-gray-800 mb-0">Type</span>
                                            <span class="fs-7 text-gray-400">Kelola Type Kamar</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->

                                    <!--begin:Item-->
                                    <div class="col-6">
                                        <a href="../data_metode_pembayaran/index.php"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z"
                                                    fill="#4097f7" />
                                                <path d="M12.0006 11.1542C13.1434 11.1542 14.0777 10.22 14.0777 9.0771C14.0777 7.93424 13.1434 7 12.0006 7C10.8577 7 9.92348 7.93424 9.92348 9.0771C9.92348 10.22 10.8577 11.1542 12.0006 11.1542Z"
                                                    fill="#4097f7" />
                                                <path d="M15.5652 13.814C15.5108 13.6779 15.4382 13.551 15.3566 13.4331C14.9393 12.8163 14.2954 12.4081 13.5697 12.3083C13.479 12.2993 13.3793 12.3174 13.3067 12.3718C12.9257 12.653 12.4722 12.7981 12.0006 12.7981C11.5289 12.7981 11.0754 12.653 10.6944 12.3718C10.6219 12.3174 10.5221 12.2902 10.4314 12.3083C9.70578 12.4081 9.05272 12.8163 8.64456 13.4331C8.56293 13.551 8.49036 13.687 8.43595 13.814C8.40875 13.8684 8.41781 13.9319 8.44502 13.9864C8.51759 14.1133 8.60828 14.2403 8.68991 14.3492C8.81689 14.5215 8.95295 14.6757 9.10715 14.8208C9.23413 14.9478 9.37925 15.0657 9.52439 15.1836C10.2409 15.7188 11.1026 15.9999 11.9915 15.9999C12.8804 15.9999 13.7421 15.7188 14.4586 15.1836C14.6038 15.0748 14.7489 14.9478 14.8759 14.8208C15.021 14.6757 15.1661 14.5215 15.2931 14.3492C15.3838 14.2312 15.4655 14.1133 15.538 13.9864C15.5833 13.9319 15.5924 13.8684 15.5652 13.814Z"
                                                    fill="#4097f7" />
                                            </svg>
                                            <span class="fs-5 fw-semibold text-gray-800 mb-0">Payment</span>
                                            <span class="fs-7 text-gray-400">Metode Pembayaran</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->

                                    <!--begin:Item-->
                                    <!-- <div class="col-6">
                                        <a href="../data_admin/index.php"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                    fill="#4097f7" />
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="#4097f7" />
                                            </svg>
                                            <span class="fs-5 fw-semibold text-gray-800 mb-0">Admin</span>
                                            <span class="fs-7 text-gray-400">kelola Admin</span>
                                        </a>
                                    </div> -->
                                    <div class="col-6">
                                        <a href="../data_bank/index.php"
                                            class="d-flex flex-column flex-center h-100 p-6 bg-hover-light">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                    fill="#4097f7" />
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="#4097f7" />
                                            </svg>
                                            <span class="fs-5 fw-semibold text-gray-800 mb-0">Bank</span>
                                            <span class="fs-7 text-gray-400">Kelola Bank</span>
                                        </a>
                                    </div>
                                    <!--end:Item-->
                                </div>
                                <!--end:Nav-->


                            </div>
                            <!--end::Menu-->
                            <!--end::Menu wrapper-->
                        </div>
                        <!--end::Quick links-->

                        <!--begin::Settings-->
                        <div class="app-footer-item">
                            <!--begin::Menu- wrapper-->
                            <div class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-<?php echo $color_type; ?> w-35px h-35px w-md-40px h-md-40px"
                                data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-start">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path opacity="0.3"
                                            d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z"
                                            fill="grey"></path>
                                        <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z"
                                            fill="grey"></path>
                                    </svg>
                                </span>
                            </div>
                            <!--end::Menu wrapper-->

                            <!--begin::My apps-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-350px" data-kt-menu="true">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">Pengaturan</div>
                                        <!--end::Card title-->

                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar">


                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                    <!--end::Card header-->

                                    <!--begin::Card body-->
                                    <div class="card-body py-5">
                                        <!--begin::Scroll-->
                                        <div class="mh-450px scroll-y me-n5 pe-5">
                                            <!--begin::Row-->
                                            <div class="row g-2">

                                                <div class="col-4">
                                                    <a href="../data_pengaturan_printer/index.php?input=detail"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <img src="https://stock.ridikcindustries.com/admin/upload/1737378453-35735-credit-card.png"
                                                            class="w-25px h-25px mb-2" alt="" />
                                                        <span class="fw-semibold">Printer</span>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <a href="../data_pengaturan_aplikasi/index.php"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <img src="https://stock.ridikcindustries.com/admin/upload/1737378453-35735-credit-card.png"
                                                            class="w-25px h-25px mb-2" alt="" />
                                                        <span class="fw-semibold">Aplikasi</span>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <a href="../backuprestore/index.php?input=backup"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <img src="https://stock.ridikcindustries.com/admin/upload/1737378453-35735-credit-card.png"
                                                            class="w-25px h-25px mb-2" alt="" />
                                                        <span class="fw-semibold">Backup</span>
                                                    </a>
                                                </div>

                                                <div class="col-4">
                                                    <a href="../backuprestore/index.php?input=restore"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <img src="https://stock.ridikcindustries.com/admin/upload/1737378453-35735-credit-card.png"
                                                            class="w-25px h-25px mb-2" alt="" />
                                                        <span class="fw-semibold">Restore</span>
                                                    </a>
                                                </div>
                                                <div class="col-4">
                                                    <a href="<?php logout(); ?>"
                                                        class="d-flex flex-column flex-center text-center text-gray-800 text-hover-<?php echo $color_type; ?> bg-hover-light rounded py-4 px-3 mb-3">
                                                        <img src="https://stock.ridikcindustries.com/admin/upload/1737378453-35735-credit-card.png"
                                                            class="w-25px h-25px mb-2" alt="" />
                                                        <span class="fw-semibold">Logout</span>
                                                    </a>
                                                </div>


                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::My apps--> <!--end::Menu wrapper-->
                        </div>
                        <!--begin::Settings-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Sidebar-->


                <?php


                if (lastpath("home")) {
                    if (isset($_GET['p'])) {
                        include $_GET['p'] . '.php';
                    } else {
                        include 'home.php';
                    }
                } else {


                    if (lastpath("data_transaksi") && isset($_GET['input']) && $_GET['input'] == "tambah") {
                        include 'halaman.php';
                    } else {
                ?>

                        <div class="app-main flex-column flex-row-fluid " id="kt_app_main">
                            <!--begin::Content wrapper-->
                            <div class="d-flex flex-column flex-column-fluid">


                                <!--begin::Content-->
                                <div id="kt_app_content" class="app-content  flex-column-fluid ">


                                    <!--begin::Content container-->
                                    <div id="kt_app_content_container" class="app-container  container-xxl ">
                                        <!--begin::Card-->
                                        <div class="card">


                                            <!--begin::Card body-->
                                            <div class="card-body ">
                                                <h2> <?php tabelnomin(); ?> </h2>
                                                <br>
                                                <?php include 'halaman.php'; ?>

                                            </div>
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Card-->
                                    </div>
                                    <!--end::Content container-->
                                </div>
                                <!--end::Content-->

                            </div>
                            <!--end::Content wrapper-->


                        </div>

                <?php
                    }
                }


                ?>
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

    <!-- <script src="http://localhost/PROJECT/GIT/Kasir%20Mikro%20Web/admin/data/tmp/micro/assets/js/jquery.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <?php
    ScriptTemplate::render();
    ?>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>



</body>

</html>