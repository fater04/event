<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/23/2019
 * Time: 3:45 PM
 */
?>

<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title">liste des registants</h4>
            <p class="text-muted font-14 m-b-30">&nbsp;</p>

            <table id="datatable" class="table table-bordered">
                <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Nom Complet</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //function get_timeago( $ptime )
                //{
                //    $estimate_time = time() - $ptime;
                //
                //    if( $estimate_time < 1 )
                //    {
                //        return 'less than 1 second ago';
                //    }
                //
                //    $condition = array(
                //        12 * 30 * 24 * 60 * 60  =>  'year',
                //        30 * 24 * 60 * 60       =>  'month',
                //        24 * 60 * 60            =>  'day',
                //        60 * 60                 =>  'hour',
                //        60                      =>  'minute',
                //        1                       =>  'second'
                //    );
                //
                //    foreach( $condition as $secs => $str )
                //    {
                //        $d = $estimate_time / $secs;
                //
                //        if( $d >= 1 )
                //        {
                //            $r = round( $d );
                //            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
                //        }
                //    }
                //}
                // $timeago=get_timeago(strtotime(#ee)):
                if (isset($listeutilisateur)) {
                    foreach ($listeutilisateur as $user) { ?>
                        <tr>
                            <td><?= $user->getPseudo(); ?></td>
                            <td><?= $user->getEmail(); ?></td>
                            <td><?= $user->getNom(); ?></td>
                            <td><?php $i = $user->getActive();
                                if ($i == 'oui') {
                                    echo '<span class="badge label-table badge-success">Active</span>';
                                } else {
                                    echo '<span class="badge label-table badge-danger">Inactive</span>';
                                } ?></td>
                            <td><?= $user->date ?></td>
                            <td>
                                <div class="btn-group dropdown">
                                    <a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="edit-user-<?= $user->getId() ?>" ><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit User</a>
                                        <a class="dropdown-item" href="all-user&id=<?= $user->getId() ?>"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
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


