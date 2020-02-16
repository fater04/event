<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 3/5/2019
 * Time: 11:49 AM
 */
?>
<div class="text-center">
    <a href="#" class="logo-lg"><i class="mdi mdi-calendar-multiple-check"></i>&nbsp;<span>B-EVENT</span> </a>
</div>
<form class="form-horizontal m-t-20" role="form" method="post" >

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                </div>
                <input class="form-control" type="email" required  placeholder="Email" name="email">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                </div>
                <input class="form-control" type="text" required placeholder="Username" name="pseudo">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                </div>
                <input class="form-control" type="password" required placeholder="Password" name="password1">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-12">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="mdi mdi-key"></i></span>
                </div>
                <input class="form-control" type="password" required placeholder="Confirmed Password" name="password2">
            </div>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-12">
            <div class="checkbox checkbox-primary">
                <input id="checkbox-signup" type="checkbox" checked="checked" name="condition">
                <label for="checkbox-signup">
                    I accept <a href="#">Terms and Conditions</a>
                </label>
            </div>
        </div>
    </div>

    <div class="form-group text-right m-t-20">
        <div class="col-xs-12">
            <button class="btn btn-primary btn-custom waves-effect waves-light w-md" type="submit">Register</button>
        </div>
    </div>

    <div class="form-group row m-t-30">
        <div class="col-12 text-center">
            <a href="<?=\app\DefaultApp\DefaultApp::genererUrl("login")?>" class="text-muted">Already have account?</a>
        </div>
    </div>

</form>

