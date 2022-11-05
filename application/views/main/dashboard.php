<style>
    #inputGroupPrepend {
        background: none;
    }

    #inputGroupPrepend i {
        font-size: 20px;
        color: #636e72;
    }

    #yourUsername,
    #yourPassword {
        border-left: none;
    }

    #yourUsername:focus,
    #yourPassword:focus {
        box-shadow: none;
    }

    #yourName,
    #yourPassword,
    #yourEmail,
    #confirmPassword {
        border-left: none;
    }

    #yourName:focus,
    #yourEmail:focus,
    #yourPassword:focus,
    #confirmPassword:focus {
        box-shadow: none;
    }

    #pic {
        height: 130px;
        width: 150px;
        border-radius: 10px;
        border: 1px solid #bdc3c7;
    }
</style>

<main id="main" class="main">
    <div class="container-fluid">
        <div class="pagetitle">
            <h1>Welcome! <?= $_SESSION['loggedIn']['name']; ?></h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"><?= $_SESSION['loggedIn']['position']; ?> / <?= $_SESSION['loggedIn']['department']; ?></li>
                </ol>
                <div class="ms-auto me-5 pe-3">
                    <div class="d-flex align-items-center">
                        <div id="clock" class="me-2"></div>
                        <div id="date"></div>
                    </div>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section class="main-section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-7">
                    <div class="row">

                        <!-- User Card -->
                        <div class="col-xxl-12 col-md-6">
                            <div class="card info-card">
                                <div class="card-header">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>USER RESTRICTION
                                </div>
                                <div class="card-body">
                                    <div class="fw-bold mt-3">You are allowed to access:</div>

                                    <?php foreach ($getSystem as $row) : ?>
                                        <span class="badge bg-success"><?= $row->perm_desc ?></span>
                                    <?php endforeach; ?>
                                    <hr class="mt-2 mb-2">

                                    <div class="fw-bold">Hepldesk support dashboard:</div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card card-primary guest">
                                                <div class="card-body p-2">
                                                    <div class="card-avatar-primary me-3">
                                                        <i class="fas fa-address-book mx-auto text-danger"></i>
                                                    </div>
                                                    <div class="card-text">
                                                        <h5>PENDING REQUEST</h5>
                                                        <h4><?= $pending; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-primary guest">
                                                <div class="card-body p-2">
                                                    <div class="card-avatar-primary me-3">
                                                        <i class="fas fa-hourglass-start mx-auto text-warning"></i>
                                                    </div>
                                                    <div class="card-text">
                                                        <h5>ONGOING REQUEST</h5>
                                                        <h4><?= $ongoing; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card card-primary guest">
                                                <div class="card-body p-2">
                                                    <div class="card-avatar-primary me-3">
                                                        <i class="fas fa-calendar-alt mx-auto text-success"></i>
                                                    </div>
                                                    <div class="card-text">
                                                        <h5>ACCOMPLISHED REQUEST</h5>
                                                        <h4><?= $finish; ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- End User Card -->

                        <!-- Main Menu -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <i class="bi bi-pc-display-horizontal me-2"></i>SOFTWARE & SYSTEM
                                </div>
                                <div class="card-body">

                                    <div class="row g-2 mt-3">
                                        <!-- System A -->

                                        <?php foreach ($permissions as $row) : ?>

                                            <?php if ($row->perm_id == "1") { ?>
                                                <!-- Helpdesk Card -->
                                                <div class="col-xxl-4 col-md-6">
                                                    <a href="<?= base_url('../helpdesk_ticketing') ?>" target="_blank" style="color: #444444;">
                                                        <div class="card info-card menu-card border">

                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center mt-4">
                                                                    <div class="card-icon d-flex align-items-center justify-content-center">
                                                                        <img src="<?= base_url('assets/img/icons/helpdesk.png') ?>" alt="">
                                                                    </div>
                                                                    <div class="ps-4 text-center">
                                                                        <span class="small pt-1 fw-bold">HELP DESK
                                                                            SUPPORT
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div><!-- End Helpdesk Card -->
                                            <?php } ?>

                                            <?php if ($row->perm_id == "2") { ?>
                                                <div class="col-xxl-4 col-md-6">
                                                    <a href="<?= base_url('main/accountManagement') ?>" target="_blank" style="color: #444444;">
                                                        <div class="card info-card menu-card border">

                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center mt-4">
                                                                    <div class="card-icon d-flex align-items-center justify-content-center">
                                                                        <img src="<?= base_url('assets/img/icons/account.png') ?>" alt="">
                                                                    </div>
                                                                    <div class="ps-4 text-center">
                                                                        <span class="small pt-1 fw-bold">ACCOUNT MANAGEMENT
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div><!-- System A-->
                                            <?php } ?>

                                            <?php if ($row->perm_id == "3") { ?>
                                                <!-- DCM Card -->
                                                <div class="col-xxl-4 col-md-6">
                                                    <a href="#" style="color: #444444;">
                                                        <div class="card info-card menu-card border">

                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center mt-4">
                                                                    <div class="card-icon d-flex align-items-center justify-content-center">
                                                                        <img src="<?= base_url('assets/img/icons/folders.png') ?>" alt="">
                                                                    </div>
                                                                    <div class="ps-4 text-center">
                                                                        <span class="small pt-1 fw-bold">DOCUMENT
                                                                            MONITORING
                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div><!-- End DCM Card -->
                                            <?php } ?>

                                        <?php endforeach; ?>

                                        <!-- Inventory Card -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="#" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/inventory.png') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">INVENTORY
                                                                    MANAGEMENT
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- End Inventory Card -->

                                        <!-- Inventory Card -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="#" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/aione.png') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">AIONE
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- End Inventory Card -->

                                        <!-- System A -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="#" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/hr.png') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">HRDotNet
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- System A-->

                                        <!-- System A -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="#" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/erp.jpg') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">ERP
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- System A-->

                                        <!-- System A -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="https://tomsworld.com/" target="_blank" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/tom.png') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">Toms World
                                                                    Website
                                                                </span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- System A-->

                                        <!-- System A -->
                                        <div class="col-xxl-4 col-md-6">
                                            <a href="#" style="color: #444444;">
                                                <div class="card info-card menu-card border">

                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mt-4">
                                                            <div class="card-icon d-flex align-items-center justify-content-center">
                                                                <img src="<?= base_url('assets/img/icons/warehouse.png') ?>" alt="">
                                                            </div>
                                                            <div class="ps-4 text-center">
                                                                <span class="small pt-1 fw-bold">System A
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- System A-->
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Main Menu -->

                    </div>
                </div><!-- End Left side columns -->

                <!-- Right side columns -->
                <div class="col-lg-5">

                    <!-- MEMO BOARD -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-files me-2"></i>MEMO BOARD
                        </div>
                        <div class="card-body pb-0">

                            <hr>
                            <h6><b> Memo No. 1234</b></h6>
                            <p>To: Department<br>
                                Re: Workshop Seminar<br>
                                View More...</p>
                            <hr>

                            <h6><b> Memo No. 1234</b></h6>
                            <p>To: Department<br>
                                Re: Workshop Seminar<br>
                                View More...</p>
                            <hr>

                            <h6><b> Memo No. 1234</b></h6>
                            <p>To: Department<br>
                                Re: Workshop Seminar<br>
                                View More...</p>
                        </div>
                    </div><!-- End MEMO BOARD  -->

                    <!-- CALENDAR -->
                    <div class="card">
                        <div class="card-header">
                            <i class="bi bi-calendar-week-fill me-2"></i>CALENDAR
                        </div>
                        <div class="card-body">

                            <div class="mt-3" id="calendar"></div>

                        </div>

                    </div>
                </div><!-- CALENDAR -->

            </div><!-- End Right side columns -->

        </section>
    </div><!-- End Container-fluid -->
</main>

<!-- modalPermission -->
<div class="modal fade" id="modalProfile" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Manage Profile</h5>
                <hr class="mt-0">
                <p class="text-center" style="color: #02306D;">You're using a temporary password. Kindly change immediately and update your account profile. Thank You!</p>

                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <div id="error-message"></div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="password" class="form-control" id="yourPassword" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" id="confirmPassword" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="profile_pic" class="form-label">Upload Profile Picture</label>
                        <input type="file" name="inpFile" class="form-control" id="profile_pic" accept="image/*" required oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                    </div>
                    <div class="text-center">
                        <img id="pic" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="register_btn" class="btn btn-danger text-white"><i class="bi bi-save me-2"></i>Update Profile</button>
            </div>
            </form>
        </div>
    </div>
</div>