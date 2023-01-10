<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>TOMS WORLD PH CENTRALIZED SYSTEM</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/main-icon.png') ?>" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />

    <!-- Template Main CSS File -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/custom-style.css') ?>" rel="stylesheet">

    <style>
        .table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
            font-weight: bold;
        }

        .table th,
        .table td {
            /* padding: 12px 15px; */
            padding: 3px 5px !important;
            font-size: 13px;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }

        .table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

        #loading {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            display: block;
            opacity: 0.7;
            background-color: rgba(255, 255, 255, 0.9);
            /* z-index: 150; */
        }

        #loading-image {
            position: absolute;
            margin-right: -50px;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            width: 200px;

        }
    </style>
</head>

<body onload="startTime()">
    <div id="loading" class="mx-auto" style="display:none;">
        <img id="loading-image" src="<?= base_url('assets/img/loader.gif') ?>" alt="Loading..." />
    </div>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <h5 class="fw-bold header-text" style="color:#02306D;">Toms World Philippines Centralized System</h5>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-danger badge-number count"></span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <div class="hide-notif">
                            <li class="dropdown-header">
                                You have <span class="count-notif"></span> new notifications
                            </li>
                        </div>
                        <div id="notifications">

                        </div>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <?php if ($_SESSION['loggedIn']['profile_pic'] != '') : ?>
                            <img src="<?= base_url() ?>../toms-world/uploaded_file/profile/<?= $_SESSION['loggedIn']['profile_pic']; ?>" class="rounded-circle" alt="Pofile-Picture"><br>
                        <?php else : ?>
                            <img src="<?= base_url() ?>assets/img/avatar.jpg" alt="Profile" class="rounded-circle"><br>
                        <?php endif ?>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['loggedIn']['name']; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= $_SESSION['loggedIn']['department']; ?></h6>
                            <span><small><i><?= $_SESSION['loggedIn']['email']; ?></i></small></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('main/logout') ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->