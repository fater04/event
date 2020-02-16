<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/8/2019
 * Time: 11:03 PM
 */
$user11 = new \app\DefaultApp\Models\Utilisateur();
$u111 = $user11->rechercher($id);
?>

<div class="row">
    <div class="col-xl-3 col-lg-4">
        <div class="text-center card-box">
            <div class="member-card">
                <div class="thumb-xl member-thumb m-b-10 center-block">
                    <img src="<?=$u111->getPhoto();?>" class="rounded-circle img-thumbnail" alt="profile-image">
                </div>

                <div class="">
                    <h5 class="m-b-5">@<?=$u111->getPseudo();?></h5>
                </div>



                <div class="text-left m-t-40">
                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15"><?=$u111->getPrenom();?>&nbsp;<?=$u111->getNom();?></span></p>

                    <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15"><?=$u111->getTelephone();?></span></p>

                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15"><?=$u111->getEmail();?></span></p>

                </div>


            </div>

        </div> <!-- end card-box -->


    </div> <!-- end col -->


    <div class="col-lg-8 col-xl-9">
        <div class="">
            <div class="card-box">
                <form role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="FullName">Prenom </label>
                            <input type="text" placeholder="John" name="prenom" class="form-control" value="<?=$u111->getPrenom();?>" >
                            <input type="hidden"  name="idd" value="<?=$u111->getId();?>" >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="FullName">Nom</label>
                            <input type="text" placeholder="Doe" name="nom" class="form-control" value="<?=$u111->getNom();?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" placeholder="first.last@example.com" name="email" class="form-control" value="<?=$u111->getEmail();?>" required>
                    </div>
                    <div class="form-group">
                        <label for="Username">Pseudo</label>
                        <input type="text" placeholder="john" name="pseudo" class="form-control" required value="<?=$u111->getPseudo();?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="Username">Telephone</label>
                        <input type="text" placeholder="+509 0000 00 00" name="telephone" data-parsley-length="[5, 15]" class="form-control" value="<?=$u111->getTelephone();?>">
                    </div>
                    <div class="form-group">
                        <label for="Username">Photo</label>
                        <input type="file"  name="image" class="form-control">
                    </div>


                    <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                </form>

            </div>
        </div>

    </div> <!-- end col -->
</div>


