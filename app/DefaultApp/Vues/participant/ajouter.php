<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/15/2019
 * Time: 1:08 PM
 */

?>
<!-- Form row -->
<div class="row">
    <div class="offset-2 col-md-8">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Ajouter Participant</h4>
            <p class="text-muted m-b-30 font-13">&nbsp;&nbsp; </p>

            <form role="form" method="post" id="form_ajouter" data-parsley-validate>
                <div class="form-group ">
                    <?php  if (isset($id)) { ?> <input type="hidden" name="id_event" value="<?=$id;?>"/> <?php } else{?>
                    <select class="form-control"  name="id_event" required >
                        <?php if (isset($lisevent)) {
                        foreach ($lisevent as $event) { ?>
                        <option value="" selected hidden>CHOISIR</option>
                        <option value=" <?= $event->getId() ?>"> <?= $event->getTitre() ?></option>
                        <?php }
                        } ?>

                    </select>
                    <?php } ?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="col-form-label">NOM *</label>
                        <input type="text" class="form-control" id="inputEmail4" data-parsley-minlength="2" name="nom" data-parsley-maxlength="100"placeholder="NOM" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4" class="col-form-label">PRENOM *</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="PRENOM" name="prenom" data-parsley-minlength="2" data-parsley-maxlength="50"required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="col-form-label">SEXE*</label>
                 <select class="form-control" required name="sexe">
                    <option value="" selected hidden>CHOISIR</option>
                     <option value="Masculin">Masculin</option>
                     <option value="Feminin">Feminin</option>
                 </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4" class="col-form-label">PROFESSION</label>
                        <input type="text" class="form-control" id="inputPassword4" placeholder="Profession" name="profession" data-parsley-minlength="2" data-parsley-maxlength="30"  >
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4" class="col-form-label">TELEPHONE *</label>
                        <input type="text" class="form-control" id="inputEmail4" data-mask="99999999"  placeholder="TELEPHONE" name="telephone" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4" class="col-form-label">EMAIL</label>
                        <input type="email" class="form-control" id="inputPassword4" placeholder="EMAIL" data-parsley-type="email" name="email">
                    </div>
                </div>

<div class="text-center form-group"><br/>
    <input type="hidden" name="addP"/>
    <input type="hidden" name="idd" value="<?=$_SESSION['utilisateur'];?>"/>
    <button type="submit" class="btn btn-primary btn-circle btn-lg">Ajouter</button>

</div>

            </form>
        </div>
    </div>
</div>
<!-- end row -->

