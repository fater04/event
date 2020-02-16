<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/23/2019
 * Time: 3:44 PM
 */
?>
<div class="row">



    <div class="offset-lg-3 col-lg-6 offset-md-2 col-md-8 col-sm-12 col-xs-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title">AJouter</h4>
            <form role="form" method="post" data-parsley-validate>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">Nom Complet</label>
                    <div class="col-9">
                        <input type="text" class="form-control" id="inputEmail3" name="nom"required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">Email</label>
                    <div class="col-9">
                        <input type="email" class="form-control" id="input1" name="email"  required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">Password</label>
                    <div class="col-9">
                        <input type="password" class="form-control" name="password"  required >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputEmail3" class="col-3 col-form-label">Evennement</label>
                    <div class="col-9">
                        <select class="form-control" name="event" required>
                            <option selected hidden value="">Choisir</option>
                            <?php
                            if (isset($lisevent)) {
                                foreach ($lisevent as $ev) { ?>

                                    <option value="<?= $ev->getId(); ?>"><?= $ev->getTitre(); ?></option>
                                <?php } }?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>

</div>
