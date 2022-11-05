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
                                    USER RESTRICTION
                                </div>
                                <div class="card-body">
                                    <div class="fw-bold mt-3">You are allowed to access:</div>
                                    <span>HRIS / HELPDESK / DCM</span>
                                    <hr class="mt-2 mb-2">
                                    <div class="fw-bold">You are permitted to access:</div>
                                    <span>SYSTEM 1 / SYSTEM 2 / SYSTEM 3</span>
                                </div>
                            </div>

                        </div><!-- End User Card -->

                        <!-- Main Menu -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    SOFTWARE & SYSTEM
                                </div>
                                <div class="card-body">

                                    <div class="row g-2 mt-3">
                                        <!-- System A -->

                                        <?php foreach ($permissions as $row) : ?>
                                            
                                            <?php if ($row->perm_id == "1") { ?>
                                                <!-- Helpdesk Card -->
                                                <div class="col-xxl-4 col-md-6">
                                                    <a href="<?= base_url('../helpdesk_ticketing')?>" target="_blank" style="color: #444444;">
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
                                                    <a href="<?= base_url('main/accountManagement') ?>" style="color: #444444;">
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
                                            <a href="#" style="color: #444444;">
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
                            MEMO BOARD
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
                            CALENDAR
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