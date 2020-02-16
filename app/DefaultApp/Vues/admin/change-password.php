<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/12/2019
 * Time: 2:18 PM
 */

$user = new \app\DefaultApp\Models\Utilisateur();
$s = $user->rechercher($id);
?>

<div class="row">



    <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 col-sm-12 col-xs-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title">Change Password</h4>
            <form role="form" method="post" data-parsley-validate>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">Current Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" id="inputEmail3" name="pass1"required >
                        <input type="hidden" class="form-control" name="idd" value="<?= $s->getId(); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">New Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" id="input1" name="pass2" data-parsley-minlength="6" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">PASSWORD</label>
                    <div class="col-9">
                        <input type="password" class="form-control" name="pass3" data-parsley-equalto="#input1" required >
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>

</div>
<!-- end row -->
