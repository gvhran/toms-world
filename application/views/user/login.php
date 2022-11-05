<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="login-content justify-content-center">
                    <div class="row">
                        <div class="col-md-6 p-5">
                            <h1 style="color: #02306D;">Hello I'm Tom</h1>
                            <img src="assets/img/tom.png" style="width: 100%">
                        </div>
                        <div class="col-md-5">
                            <div class="login-form">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="" class="logo d-flex align-items-center w-auto">
                                        <img src="assets/img/logoTW.png" alt="">
                                    </a>
                                </div><!-- End Logo -->
                                <div class="message"></div>
                                <div class="card mb-3 bg-s">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center">Toms World PH Centralized System</h5>
                                        </div>
                                        <div class="pt-2">
                                            <h5 class="text-center title-system">Welcome!
                                                Sign In your Account</h5>
                                        </div>
                                        <hr>

                                        <form id="login_form" method="POST">
                                            <div class="form-group mb-3">
                                                <label for="yourUsername" class="form-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"></i></span>
                                                    <input type="email" name="email" class="form-control" id="yourUsername">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="yourPassword" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                                                    <input type="password" name="password" class="form-control" id="yourPassword">
                                                </div>
                                            </div>
                                            <div class="text-end mt-2 mb-2">
                                                <a href="">Forgot Password?</a>
                                            </div>
                                            <button class="btn btn-login w-100 btn-rounded" type="submit">LOGIN</button>
                                        </form>
                                        <div class="text-center mt-3 text-muted">
                                            Don't have an account? <a href="<?= base_url('user/register')?>">Create
                                                Account</a>
                                        </div>
                                        <hr>
                                        <h5 style="color:#e65c00; font-size: 19px;">Welcome to Toms World PH
                                            Centralized System.
                                        </h5>
                                        <h6 style="color:#02306D;">Having trouble to Acces you Account?<br> For
                                            assitance please watch this Video Guide. <a href="#">CLICK HERE</a></h6>
                                        <hr>
                                    </div><!-- End of card-body -->
                                </div><!-- End of card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->