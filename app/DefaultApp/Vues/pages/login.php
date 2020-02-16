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
<div class="text-center">
    <a href="#" class="logo-lg"><i class="mdi mdi-calendar-multiple-check"></i> <span>B-EVENT</span> </a>
</div>

<form class="form-horizontal m-t-20" action="" method="post">

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                </div>
                <input class="form-control" type="text" required="" placeholder="Username or Email" name="pseudo" value="<?=$pseudo?>">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                </div>
                <input class="form-control" type="password" required="" placeholder="Password" name="pass" value="<?=$pass?>">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="checkbox checkbox-primary">
                <input id="checkbox-signup" type="checkbox" name="remember" checked="checked">
                <label for="checkbox-signup">
                    Remember me
                </label>
            </div>

        </div>
    </div>

    <div class="form-group text-right m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-custom w-md waves-effect waves-light" type="submit">Log In
            </button>
        </div>
    </div>

    <div class="form-group row m-t-30">
        <div class="col-sm-7">
            <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("recover")?>" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your
                password?</a>
        </div>
        <div class="col-sm-5 text-right">
            <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("register")?>" class="text-muted">Create an account</a>
        </div>
    </div>
</form>