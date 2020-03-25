<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/15/2019
 * Time: 1:08 PM
 */
?>


<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">liste des participants</h4>

            <p class="text-muted font-10 m-b-30"><div>
                <?php if (isset($lisevent)) {
                foreach ($lisevent as $event) { ?>
                <a href="all-participant&event=<?= $event->getId() ?>" class="btn btn-outline-success"> <?= $event->getTitre() ?></a>
                <?php }
                } ?>
                <a href="all-participant&event=all" class="btn btn-outline-light waves-effect">Tous</a>
            </div></p>

            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Sexe</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Profession</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (isset($listeparticipant)) {
                    foreach ($listeparticipant as $user) { ?>
                        <tr>
                            <td><?= $user->getNom(); ?></td>
                            <td><?= $user->getPrenom(); ?></td>
                            <td><?= $user->getSexe(); ?></td>
                            <td><?= $user->getTelephone(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getProfession(); ?></td>
                            <td><?= $user->getDate(); ?></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item" href="all-participant&id=<?= $user->getId() ?>"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
                                    </div>
                                </div>
                            </td>


                        </tr>
                    <?php }
                } ?>

                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->

