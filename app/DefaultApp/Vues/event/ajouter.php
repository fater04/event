<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/17/2019
 * Time: 9:30 PM
 */
$event1 = new \app\DefaultApp\Models\Event();
?>


                    <!-- end page title -->
<div class="row">
    <?php
    if(isset($_GET['edit'])){ $s = $event1->rechercher($_GET['edit']) ?>
    <div class="offset-3 col-md-6">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title">Modifier Evennement</h4>

            <form role="form" method="post" >
                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Titre</label>
                                                        <input type="hidden" name="modifier"/>
                                                        <input type="hidden" name="idd" value=" <?= $s->getId() ?>" />
                                                        <input class="form-control form-white" placeholder="Enter titre" type="text" data-parsley-minlength="5"
                                                               name="titre" value=" <?= $s->getTitre() ?>" required/>
                                                    </div>
                                                    <div class="form-row col-md-12">
                                                        <label class="control-label">Date DebutHeure (2019-01-30)</label>
                                                        <div class="input-group">
                                                            <input class="form-control" placeholder="yyyy-mm-dd" data-mask="9999-99-99" value="<?= $s->getDateDebut() ?>" class="my_dtp_c form-control" id="datepicker-autoclose" type="text" name="datedebut" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"><i class="ion-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label class="control-label">Description</label>
                                                        <textarea name="description" rows="3" class="form-control" data-parsley-minlength="10" required><?= $s->getDescription() ?></textarea>
                                                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Appareil</label>
                       <select class="form-control" name="setting" required>
                          <?php $e1= \app\DefaultApp\Models\Setting::rechercher($s->getIdConfig());?>
                           <option value="<?=$e1->getId();?>"selected><?=$e1->getDeviceId();?></option>

                           <?php    if (isset($listesetting)) {
                           foreach ($listesetting as $s1) { ?>
                               <option value="<?=$s1->getId()?>"><?=$s1->getDeviceId();?></option>
                           <?php }  } ?>
                       </select>
                    </div>

                    <div class="form-group col-md-12"><button type="submit" class="btn btn-primary btn-circle btn-lg">Modifier</button></div>

            </form>
        </div>
    </div>
    <?php }else{?>
        <div class="offset-3 col-md-6">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Ajouter Evennement</h4>

                <form role="form" method="post" >
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label">Titre</label>
                            <input class="form-control form-white" placeholder="Enter titre" type="text" data-parsley-minlength="5"
                                   name="titre" required/>
                        </div>
                        <div class="form-row col-md-12">
                            <div class="form-group col-md-8">
                                <label class="control-label">Date DebutHeure (2019-01-30)</label>
                                <div class="input-group">
                                    <input class="form-control" placeholder="yyyy-mm-dd" data-mask="9999-99-99"  class="my_dtp_c form-control" id="datepicker-autoclose" type="text" name="datedebut" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ion-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label">Heure (format 24h)</label>
                                <div class="input-group">
                                    <input class="form-control" placeholder="12:00" data-mask="99:99"  size="16" type="text" name="heuredebut">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="ion-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Description</label>
                            <textarea name="description" rows="3" class="form-control" data-parsley-minlength="10" required></textarea>
                            <input type="hidden" name="ajouter"/>
                            <input type="hidden" name="id_user" value="<?=$_SESSION['utilisateur'] ?> "/>
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label">Appareil</label>
                            <select class="form-control" name="setting" required>
                                <option value="" >choisissez</option>
                                <?php    if (isset($listesetting)) {
                                    foreach ($listesetting as $s1) { ?>
                                        <option value="<?=$s1->getId()?>"><?=$s1->getDeviceId();?></option>
                                    <?php }  } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12"><button type="submit" class="btn btn-primary btn-circle btn-lg">Ajouter</button></div>
                </form>
            </div>
        </div>
    <?php } ?>
</div>
