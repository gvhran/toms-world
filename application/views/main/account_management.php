<style>
    #table_account td:nth-child(1),
    #table_account td:nth-child(2),
    #table_account td:nth-child(8),
    #table_Subpermission td:nth-child(2) {
        text-align: center;
    }

    #table_account td:nth-child(1) {
        width: 50px;
    }

    #table_permission td:nth-child(2) {
        width: 15%;
        text-align: center;
    }

    #deleteRow {
        color: #c0392b;
        cursor: pointer
    }

    #deleteRow:hover {
        text-decoration: underline;
        cursor: pointer;
        color: #e74c3c;
    }

    .data-reset img {
        width: 70px;
        width: 70px;
        border: 3px solid #bdc3c7;
    }

    .data-reset {
        border: 2px solid #bdc3c7;
        padding: 10px 20px;
        border-radius: 10px;
    }

    #temp {
        border: none;
        outline: none;
        color: #e74c3c;
        font-style: italic;
        font-weight: 600;
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
            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalNewAccount"><i class="bi bi-person-plus-fill me-2"></i>Add New Account</button>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalManagePermission"><i class="bi bi-lock-fill me-2"></i>Manage Permission</button>
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalDepartment"><i class="bi bi-hdd-rack-fill me-2"></i>Manage Department</button>
            <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPosition"><i class="bi bi-person-lines-fill me-2"></i>Manage Position</button>
            <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#modalBranch"><i class="bi bi-shop me-2"></i>Manage Branch</button>
            <button type="button" class="btn btn-info text-white position-relative btn-sm" data-bs-toggle="modal" data-bs-target="#modalReset">
                <i class="bi bi-person-rolodex me-2"></i>Reset Account
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    <?= $totalReset; ?>
                </span>
            </button>
            <hr>
            <div class="card">
                <div class="card-header">
                    <i class="bi bi-person-rolodex me-2"></i>ACCOUNT MANAGEMENT
                </div>
                <div class="card-body">
                    <div class="row g-3 mt-2">
                        <div class="col-sm-6">
                            <a href="<?= base_url('ManageAccount/exportAccount') ?>" class="btn btn-outline-success btn-sm" title="Download Data"><i class="bi bi-cloud-download-fill me-2"></i>Export Data</a>
                            <button class="btn btn-warning btn-sm text-white print_account" title="Print"><i class="bi bi-printer-fill me-2"></i>Print</button>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group input-group-sm">
                                <label class="input-group-text" for="department_filter">Department</label>
                                <select class="form-select form-select-sm" id="department_filter">
                                    <option value="" selected>Select Department</option>
                                    <?php foreach ($department as $row) : ?>
                                        <option value="<?= $row->department ?>"><?= $row->department ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="input-group input-group-sm mb-3">
                                <label class="input-group-text" for="position_filter">Position</label>
                                <select class="form-select form-select-sm" id="position_filter">
                                    <option value="" selected>Select Position</option>
                                    <?php foreach ($position as $row) : ?>
                                        <option value="<?= $row->position_details ?>"><?= $row->position_details ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
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
                <h5><i class="bi bi-person-plus-fill me-2"></i>Add Permissions</h5>
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
<!-- modalPermission -->
<div class="modal fade" id="modalSubPermission" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Add Sub Permissions</h5>
                <hr class="mt-0">
                <div class="form-floating">
                    <div class="permission-list mt-2">
                        <table class="table" width="100%" id="table_Subpermission">
                            <thead>
                                <tr>
                                    <th>Sub Permission</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Add New Account</h5>
                <hr class="mt-0">
                <form id="addAccount" method="POST">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" autocomplete="off" id="fname" name="fname" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control" autocomplete="off" id="mname" name="mname" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" autocomplete="off" id="lname" name="lname" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="email_add">Email Address</label>
                                <input type="email" class="form-control" autocomplete="off" id="email_add" name="email_add" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="contact_no">Contact No.</label>
                                <input type="text" class="form-control" autocomplete="off" id="contact_no" name="contact_no" required>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label for="bday">Birthday</label>
                                <input type="date" class="form-control" autocomplete="off" id="bday" name="bday" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-select" id="department" name="department" required>
                                    <option value="" selected>Select Department</option>
                                    <?php foreach ($department as $row) : ?>
                                        <option value="<?= $row->department ?>"><?= $row->department ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="position">Position</label>
                                <select class="form-select" id="position" name="position" required>
                                    <option value="" selected>Select Position</option>
                                    <?php foreach ($position as $row) : ?>
                                        <option value="<?= $row->position_details ?>"><?= $row->position_details ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="position">Branches</label>
                                <select class="form-select" id="branches" name="branches" required>
                                    <option value="" selected>Select Branch</option>
                                    <?php foreach ($branches as $row) : ?>
                                        <option value="<?= $row->branch ?>"><?= $row->branch ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
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

<!-- modalManagePermission ADD -->
<div class="modal fade" id="modalManagePermission" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-lock-fill me-2"></i>Manage Permissions</h5>
                <hr class="mt-0">
                <form id="addPermissionForm" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="system_name" placeholder="Please input system name" aria-label="Permission" required autocomplete="off">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success"><i class="bi bi-plus-square-fill me-2"></i>Add New Permission</button>
                        </div>
                    </div>
                </form>
                <div class="form-floating">
                    <div class="permission-list mt-2">
                        <table class="table" width="100%" id="table_permissionManage">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Permission (System Name)</th>
                                    <th width="25%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($getPermission as $row) : ?>
                                    <tr>
                                        <td><?= $row->perm_id; ?></td>
                                        <td><?= $row->perm_desc; ?></td>
                                        <td width="25%" class="text-center">
                                            <button class="btn btn-outline-danger btn-sm add_sub_permission" title="Add Sub Permission" id="<?= $row->perm_id; ?>">
                                                <i class="bi bi-folder-plus me-2"></i>Add Sub Permission
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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

<!-- Modal Sub Permission -->
<div class="modal fade" id="modalAddSubPermission" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-lock-fill me-2"></i>Manage Sub Permissions</h5>
                <hr class="mt-0">
                <input type="hidden" name="perm_id" id="perm_id" />
                <table class="table" id="maintable" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sub Menu Permission Details</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="table_body">

                    </tbody>
                </table>
                <button class="btn btn-success btn-sm add_row"><i class="bi bi-plus-lg me-2"></i>Add New Row</button>
                <hr>
                <table class="table" id="table_sub" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Sub Menu Permission Details</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-danger text-white save_permission"><i class="bi bi-save me-2"></i>Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Department -->
<div class="modal fade" id="modalDepartment" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-hdd-rack-fill me-2"></i>Manage Department</h5>
                <hr class="mt-0">
                <form id="addDepartment" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" name="dept_code" placeholder="Department Code" required autocomplete="off">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" name="department" placeholder="Please input department" required autocomplete="off">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill me-2"></i>Add Department</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table" id="table_department" width="100%">
                    <thead>
                        <tr>
                            <th>Department Code</th>
                            <th>Department</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Department -->
<div class="modal fade" id="modalPosition" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-lines-fill me-2"></i>Manage Position</h5>
                <hr class="mt-0">
                <form id="addPosition" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-3">
                            <input type="text" class="form-control form-control-sm" name="position_code" placeholder="Position Code" required autocomplete="off">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" name="position" placeholder="Please input position" required autocomplete="off">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill me-2"></i>Add Position</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table" id="table_position" width="100%">
                    <thead>
                        <tr>
                            <th>Position Code</th>
                            <th>Position</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Department -->
<div class="modal fade" id="modalReset" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-lines-fill me-2"></i>Reset Password</h5>
                <hr class="mt-0">
                <div id="resetBoard">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Branch -->
<div class="modal fade" id="modalBranch" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-shop me-2"></i>Manage Branch / Store</h5>
                <hr class="mt-0">
                <form id="addBranches" method="POST">
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <input type="text" class="form-control form-control-sm" name="branch" placeholder="Branch / Store" required autocomplete="off">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control form-control-sm" name="branch_address" placeholder="Please input address" required autocomplete="off">
                        </div>
                        <div class="col-sm">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-plus-square-fill me-2"></i>Add Branch</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table" id="table_branch" width="100%">
                    <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
            </div>
        </div>
    </div>
</div>