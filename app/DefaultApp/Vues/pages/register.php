<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 3/5/2019
 * Time: 11:49 AM
 */
?>
 
 <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <a href="#">
                                    <strong style="font-size:28px"><i class="mdi mdi-calendar-multiple-check"></i> <span>B-EVENT</span> </strong>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">Vous n'avez pas de compte? Créez votre propre compte.</p>
                                </div>

                                <form action="" method="post">

                                    <div class="form-group">
                                        <label for="fullname">Username</label>
                                        <input class="form-control" type="text" required placeholder="Enter your name"  name="pseudo">
                                    </div>
                                    <div class="form-group">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control" type="email" required  placeholder=" Enter your Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input class="form-control" type="password" required name="password1" placeholder="Enter your password">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Confirmed Password</label>
                                        <input class="form-control" type="password" required name="password2" placeholder="Enter your password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signup"  checked="checked" name="condition">
                                            <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Sign Up </button>
                                    </div>

                                </form>

                                <div class="text-center">
                                    <h5 class="mt-3 text-muted">Sign up using</h5>
                                    <ul class="social-list list-inline mt-3 mb-0">
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Already have account?  <a  href="<?=\app\DefaultApp\DefaultApp::genererUrl("login")?>"  class="text-muted font-weight-medium ml-1">Sign In</a></p>
                            </div>
                        </div></div>
                </div>


