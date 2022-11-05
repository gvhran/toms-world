<style>
    #table_account td:nth-child(1),
    #table_account td:nth-child(2),
    #table_account td:nth-child(8) {
        text-align: center;
    }

    #table_account td:nth-child(1) {
        width: 50px;
    }

    #table_permission td:nth-child(2) {
        width: 15%;
        text-align: center;
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
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-person-rolodex me-2"></i>ACCOUNT MANAGEMENT
                </div>
                <div class="card-body">
                    <button class="btn btn-success btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#modalNewAccount"><i class="bi bi-person-plus-fill me-2"></i>Add New Account</button>
                    <div class="table-responsive mt-3">
                        <table class="table table-hover table-striped" id="table_account" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="15%">Action</th>
                                    <th class="text-center">Profile</th>
                                    <th>Username</th>
                                    <th>Fullname</th>
                                    <th>Department</th>
                                    <th>Position</th>
                                    <th>Date Created</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div><!-- End Container-fluid -->
</main>

<!-- modalPermission -->
<div class="modal fade" id="modalPermission" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Manage Permissions</h5>
                <hr class="mt-0">
                <div class="form-floating">
                    <div class="permission-list mt-2">
                        <table class="table" width="100%" id="table_permission">
                            <thead>
                                <tr>
                                    <th>Permission</th>
                                    <th class="text-center" width="15%">Access</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- modalNewAccount -->
<div class="modal fade" id="modalNewAccount" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Add New Account</h5>
                <hr class="mt-0">
                <form id="addAccount" method="POST">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control" autocomplete="off" id="fullname" name="fullname" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_add" class="form-label">Email Address</label>
                        <input type="email" class="form-control" autocomplete="off" id="email_add" name="email_add" required>
                    </div>
                    <div class="mb-3">
                        <label for="position" class="form-label">Position</label>
                        <input type="text" class="form-control" autocomplete="off" id="position" name="position" required>
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select form-select-sm text-uppercase" id="department" name="department" required>
                            <option selected>Select Department</option>
                            <option value="Department 1">Department 1</option>
                            <option value="Department 2">Department 2</option>
                            <option value="Department 3">Department 3</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="submit" class="btn btn-danger text-white"><i class="bi bi-save me-2"></i>Save Account</button>
            </div>
            </form>
        </div>
    </div>
</div>