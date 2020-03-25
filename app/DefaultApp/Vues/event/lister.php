<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/17/2019
 * Time: 9:31 PM
 */

?>
<div class="row">
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-4">
                <div class="widget">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <a href="add-event" class="btn btn-lg btn-primary btn-block waves-effect waves-light">
                               <i class="fa fa-plus"></i> Create New</a>
                                <br/><br/> <br/><br/>
                                <div class="table-responsive text-center">
                                    <h4>Liste des Evennements</h4>
                                    <table class="table table-hover table-stripped" >
                                        <thead>
                                        <tr>
                                            <th>
                                                Titre
                                            </th>
                                            <th>
                                                Date
                                            </th>
                                            <th>
                                                Option
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (isset($lisevent)) {
                                            foreach ($lisevent as $event) { ?>
                                                <tr>
                                                    <td>
                                                        <?= $event->getTitre() ?>

                                                    <td>
                                                        <?= $event->getDateDebut() ?>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group dropdown">
                                                            <a href="javascript: void(0);" class="dropdown-toggle arrow-none btn btn-light btn-sm" data-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-horizontal"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item" href="add-participant-<?= $event->getId() ?>" ><i class="mdi mdi-plus mr-2 text-muted font-18 vertical-middle"></i>Add participant</a>
                                                                <li class="dropdown-divider"></li>
                                                                <a class="dropdown-item" href="add-event&edit=<?= $event->getId() ?>" ><i class="mdi mdi-pencil mr-2 text-muted font-18 vertical-middle"></i>Edit Event</a>
                                                                <a class="dropdown-item" href="event&id=<?= $event->getId() ?>"><i class="mdi mdi-delete mr-2 text-muted font-18 vertical-middle"></i>Remove</a>
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
                        </div>
                    </div>
                </div>
            </div> <!-- end col-->
            <div class="col-lg-8">
                <div class="card-box">
                    <div id="calendar"></div>
                </div>
            </div> <!-- end col -->
        </div>  <!-- end row -->


        <div class="modal fade none-border" id="event-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title mt-0"><strong>Information</strong></h5>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="add-category">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h5 class="modal-title mt-0"><strong>Add</strong> Event</h5>
                    </div>
                    <form role="form" method="post" >
                        <div class="modal-body">

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="control-label">Titre</label>
                                    <input class="form-control form-white" placeholder="Enter titre" type="text" data-parsley-minlength="5"
                                           name="titre" required/>
                                </div>
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-8">
                                        <label class="control-label">Date Debut</label>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="2016-03-30"   class="my_dtp_c form-control"  type="text" name="datedebut" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ion-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label">Heure </label>
                                        <div class="input-group">
                                            <input class="form-control" placeholder="12:00:00"   size="16" type="text" name="heuredebut">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="ion-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="control-label">Description</label>
                                    <textarea name="description" rows="3" class="form-control" data-parsley-minlength="10" required></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light save-category">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </div>
    <!-- end col-12 -->
</div>

