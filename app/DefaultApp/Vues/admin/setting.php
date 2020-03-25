<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/12/2019
 * Time: 2:18 PM
 */

$setting = new \app\DefaultApp\Models\Setting();
?>

<div class="row">

    <?php
    if(isset($_GET['edit'])){ $s = $setting->rechercher($_GET['edit']) ?>

        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Modifier Appareil</h4>
                <form role="form" method="post" >
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">DEVICE ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputEmail3" name="deviceid" value="<?= $s->getDeviceId(); ?>" required>
                            <input type="hidden" class="form-control" name="idd" value="<?= $s->getId(); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">PHONE</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputEmail3" name="phone" value="<?= $s->getPhone(); ?>" required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">MESSAGE</label>
                        <div class="col-9">
                            <textarea class="form-control" name="message" rows="5" required><?= $s->getMessage(); ?></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="modifier"/>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    <?php  }else{
    ?>
        <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
           <div class="card-box">
                <h4 class="m-t-0 m-b-30 header-title">Ajouter apparaeil</h4>

                <form role="form" method="post" >

                    <div class="form-group row">

                        <label for="inputEmail3" class="col-3 col-form-label">DEVICE ID</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputEmail3" name="deviceid" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">PHONE</label>
                        <div class="col-9">
                            <input type="text" class="form-control" id="inputEmail3" name="phone"required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputEmail3" class="col-3 col-form-label">MESSAGE</label>
                        <div class="col-9">
                            <textarea class="form-control" name="message" rows="5" required></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="ajouter"/>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    <?php } ?>
        <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-sm-12">
                <div class="card m-b-20 card-body">
                    <h4 class="card-title text-info">Telecharger Notre application mobile</h4>
                    <p class="card-text">Pour la configuration du portail sms il faut telecharger notre application mobile a(version android, Ios bientot).une fois telecharger installer le.
                        Connectez-vous avec votre identifiant puis recuperer l'identifiant (DEVICE ID). pour que vous puissez ajouter l'appareil.</p>
                    <a href="<?=  app\DefaultApp\DefaultApp ::autre("app/bios_sms_sender_v1.0.0.1.apk") ?>"   class="btn btn-success waves-effect waves-light m-b-5"  download="bios_sms_sender_v1.0.0.apk"> <i class="fa fa-download m-r-5"></i><span>Telechrger (bios_sms_sender.apk)</span></a>
                </div>
            </div>
            <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">Liste des appareils Enregistres</h4>
            <p class="text-muted font-14 m-b-20">
           &nbsp;</p>

            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Device ID</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>option</th>
                </tr>
                </thead>
                <tbody>
                <?php    if (isset($listesetting)) {
                foreach ($listesetting as $s1) { ?>
                <tr>
                    <th scope="row"><?=$s1->getDeviceId();?></th>
                    <td><?=$s1->getPhone();?></td>
                    <td><?=substr($s1->getMessage(),0, 15)?></td>
                    <td>
                        <a href="configuration&edit=<?=$s1->getId()?>"><span class="fa fa-edit"></span></a>
                        <a href="configuration&remove=<?=$s1->getId()?>"><span class="fa fa-remove"></span></a>
                    </td>
                </tr>
                <?php } } ?>

                </tbody>
            </table>
        </div>

    </div>
</div>


