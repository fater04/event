<div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card">

                            <div class="card-body p-4">
                            
                                <div class="text-center w-75 m-auto">
                                    <a href="#">
                                    <strong style="font-size:28px"><i class="mdi mdi-calendar-multiple-check"></i> <span>B-EVENT</span> </strong>
                                    </a>
                                    <p class="text-muted mb-4 mt-3">&nbsp;&nbsp;</p>
                                </div>


                                <form action="#" method="post">

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">New Password</label>
                                        <input type="hidden" class="form-control" name="idd" value="<?=$id?>"/>
                                        <input type="password" class="form-control" placeholder="Enter Password" required="" name="pass1">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Confirmed Password</label>
                                        <input type="password" class="form-control" placeholder="Enter Password" required="" name="pass2">
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit">Reset </button>
                                    </div>

                                </form>

                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Back to <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("login")?>"  class="text-muted font-weight-medium ml-1">Log in</a></p>
                            </div> 
                        </div> </div>
                </div>

