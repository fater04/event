<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/8/2019
 * Time: 11:03 PM
 */

?>

<div class="row">
    <div class="col-12">

        <div class="card-box table-responsive">

            <table id="datatable" class="table table-bordered">
                <thead>
                <tr >
                                            <th>
                                               IP
                                            </th>
                                            <th>
                                              Navigateur
                                            </th>
                                            <th>
                                              OS
                                            </th>
                                            <th>
                                              DEVICE
                                            </th>
                                            <th>
                                              PAGE
                                            </th>
                                            <th>
                                               USER
                                            </th>
                                            <th>
                                              DATE
                                            </th>
                                            
                                        </tr>
                </thead>
                <tbody>
                <?php
                if (isset($loglist)) {
                    foreach ($loglist as $l1) { ?>
                <tr>
                    <td><?= $l1->getIP(); ?></td>
                    <td><?= $l1->getNavigateur(); ?></td>
                    <td><?= $l1->getOs(); ?></td>
                    <td><?= $l1->getDevice(); ?></td>
                    <td><?= $l1->getPages(); ?></td>
                    <td><?= \app\DefaultApp\Models\Utilisateur::return_user_pseudo($l1->getIdUser()); ?></td>
                    <td><?= $l1->getDate(); ?></td>
                    
                  
                </tr>
                    <?php }  } ?>

                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->

