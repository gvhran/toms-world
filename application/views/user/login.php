<main>
    
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="login-content justify-content-center">
                    <div class="row">
                        <div class="col-md-6 p-5">
                            <h1 style="color: #02306D;">Hello I'm Tom!</h1>
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
                                            <h5 class="card-title text-center">Welcome to Toms World Philippines</h5>
                                        </div>
                                        <div class="pt-2">
                                            <h5 class="text-center title-system">
                                                Sign In Your Account</h5>
                                        </div>
                                        <hr>
                                        <form id="login_form" method="POST">
                                            <div class="form-group mb-3">
                                                <label for="yourUsername" class="form-label">Email Address</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"></i></span>
                                                    <input type="email" name="email" class="form-control" id="yourUsername" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="yourPassword" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                                </div>
                                            </div>
                                           <br>
                                            <button class="btn btn-login w-100 btn-rounded" type="submit">LOGIN</button>
                                            <div class="text-end mt-2 mb-2">
                                                <a href="#modalForgotPass" data-bs-toggle="modal">Forgot Password?</a>
                                            </div>
                                            To download User Manual Guide. <br>
                                        <a href="assets/img/Ticketing System User Manual.pdf">CLICK HERE</a></h6>
                                        </form>
                                        <hr>
                                       
                                        <h6 style="color:#02306D;">Having trouble to Access your Account or Do you have any technical concerns?<br> 
                                        Please contact your respective IT Officers.<br>                                                                               <hr>
                                        Powered by: <br>
                                        ITSD Software Development Group - 
                                        <!--<a href="mailto:Vhran.Guanio@tomsworld.com.ph">Vhran.Guanio@tomsworld.com.ph</a>-->
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


<!-- modalPermission -->
<div class="modal fade" id="modalForgotPass" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-lock-fill me-2"></i>Forgot Password</h5>
                <hr class="mt-0">
                <div class="form-group">
                    <label for="yourPassword" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-rolodex"></i></span>
                        <input type="email" name="username" class="form-control" id="resetUsername" placeholder="Enter your username">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-danger text-white reset_password"><i class="bi bi-save-fill me-2"></i>Submit</button>
            </div>
        </div>
    </div>
</div>