<?php
if(isset($_COOKIE['pseudo']) && isset($_COOKIE['pass'])){
    $pseudo=$_COOKIE['pseudo'];
    $pass=$_COOKIE['pass'];
    $remember="checked='checked'";
}else{
$pseudo="";
$pass="";
$remember="";
}
?>
    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="#">
                                        <strong style="font-size:28px"><i class="mdi mdi-calendar-multiple-check"></i> <span>B-EVENT</span> </strong>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">&nbsp;&nbsp; </p>
                                </div>

                                <form action="" method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Username or Email</label>
                                        <input class="form-control" type="text" required="" placeholder="Username or Email" name="pseudo" value="<?=$pseudo?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required="" placeholder="Password" name="pass" value="<?=$pass?>">
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                        <input id="checkbox-signin"  class="custom-control-input" type="checkbox" name="remember" checked="checked">
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign in with</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("recover")?>"  class="text-muted ml-1">Forgot your password?</a></p>
                                <p class="text-muted">Don't have an account? <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("register")?>" class="text-primary font-weight-medium ml-1">Sign Up</a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->