<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 12/30/2018
 * Time: 1:57 PM
 */
?>

                        <div class="row">
                        <div class="col-lg-6">
                        <div class="card">
                                    <div class="card-body">                                  
                                        <h4 class="header-title" >Statistique </h4>                                       
                                        <div class="mt-3" dir="ltr">
                                            <div id="apex-pie-2" class="apex-charts"></div>
                                        </div>
                                    </div>
                                </div> <!-- end card-->
                            </div>

                            <div class="col-lg-6">
                            <div class="col-12">
                                 <div class="text-center mb-2">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card-box border">
                                                    <i class="fa fa-user-friends font-24"></i>
                                                    <h3 class="text-success"><?php 
                                                    if ($_SESSION['role'] == "admin") { 
                                                      echo   \app\DefaultApp\Models\Participant::countParticipant();
                                                    }else{
                                                       echo  \app\DefaultApp\Models\Participant::countParticipant($_SESSION['utilisateur']);
                                                    }
                                                    ?></h3>
                                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">All Participants</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card-box border">
                                                    <i class="fa fa-calendar font-24"></i>
                                                    <h3 class="text-warning"><?php
                                                    if ($_SESSION['role'] == "admin") { 
                                                    echo  \app\DefaultApp\Models\Event::countEvent();
                                                    }else{
                                                      echo  \app\DefaultApp\Models\Event::countEvent($_SESSION['utilisateur']);
                                                    }
                                                    ?></h3>
                                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">All Events</p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card-box border">
                                                    <i class="fa fa-male font-24"></i>
                                                    <h3 class="text-success"><?php 
                                                    if ($_SESSION['role'] == "admin") { 
                                                      echo   \app\DefaultApp\Models\Participant::countSexe('Masculin');
                                                    }else{
                                                       echo  \app\DefaultApp\Models\Participant::countParticipant('Masculin',$_SESSION['utilisateur']);
                                                    }
                                                    ?></h3>
                                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Garcons</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xl-6">
                                                <div class="card-box border">
                                                    <i class="fa fa-female font-24"></i>
                                                    <h3 class="text-warning"><?php
                                                    if ($_SESSION['role'] == "admin") { 
                                                        echo   \app\DefaultApp\Models\Participant::countSexe('Feminin');
                                                      }else{
                                                         echo  \app\DefaultApp\Models\Participant::countParticipant('Feminin',$_SESSION['utilisateur']);
                                                      }
                                                    ?></h3>
                                                    <p class="text-uppercase mb-1 font-13 font-weight-medium">Filles</p>
                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

<div class="row">

                            <div class="col-lg-4">
                                <div class="text-center card-box">
                                    <div class="pt-2 pb-2">
                                        <img src="https://event.bioshaiti.com/app/DefaultApp/public/img/wilker.jpg" class="rounded-circle img-thumbnail" width="30%" alt="profile-image">

                                        <h4 class="mt-3 font-17"><a href="extras-profile.html" class="text-dark">Dorvelus Wilker</a></h4>
                                        <p class="text-muted">@Developer<span> | </span> <span> <a href="https://www.bioshaiti.com" class="text-pink">bioshaiti.com</a> </span></p>

                                        <p class="text-muted font-13 mb-3">
                                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                                        </p>
    <a href="mailto:wilkerdorvelus@yahoo.com"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-email mr-1"></i> Message</a>
        <a href="tel:+50931110731" class="btn btn-light btn-sm waves-effect"><i class="mdi mdi-phone mr-1"></i> Call</a>

                                        <ul class="social-list list-inline mt-3 mb-0">
                                            <li class="list-inline-item">
                                                <a href="https://www.facebook.com/wilker.dorvelus" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://twitter.com/fater_04" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="https://github.com/fater04" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                            </li>
                                        </ul>

                                    </div> <!-- end .padding -->
                                </div> <!-- end card-box-->
                            </div>
                            <div class="col-lg-4">
                                <div class="text-center card-box">
                                    <div class="pt-2 pb-2">
                                        <img src="https://event.bioshaiti.com/app/DefaultApp/public/img/IMG_0054 (2).JPG" class="rounded-circle img-thumbnail" width="23%"  alt="profile-image">

                                        <h4 class="mt-3 font-17"><a href="extras-profile.html" class="text-dark">Alcindor Losthlven</a></h4>
                                        <p class="text-muted">@Developer<span> | </span> <span> <a href="https://www.bioshaiti.com" class="text-pink">bioshaiti.com</a> </span></p>

                                        <p class="text-muted font-13 mb-3">
                                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                                        </p>
    <a href="mailto:alcindorlos@gmail.com"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-email mr-1"></i> Message</a>
        <a href="tel:+50937391567" class="btn btn-light btn-sm waves-effect"><i class="mdi mdi-phone mr-1"></i> Call</a>

                                        <ul class="social-list list-inline mt-3 mb-0">
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                            </li>
                                        </ul>

                                    </div> <!-- end .padding -->
                                </div> <!-- end card-box-->
                            </div>
                             <div class="col-lg-4">
                                <div class="text-center card-box">
                                    <div class="pt-2 pb-2">
                                        <img src="https://event.bioshaiti.com/app/DefaultApp/public/img/IMG_20200212_150838_719.jpg" class="rounded-circle img-thumbnail" width="21%"  alt="profile-image">

                                        <h4 class="mt-3 font-17"><a href="extras-profile.html" class="text-dark">Herby Charles</a></h4>
                                        <p class="text-muted">@Developer<span> | </span> <span> <a href="https://www.herbycharles.com" class="text-pink">herbycharles.com</a> </span></p>

                                        <p class="text-muted font-13 mb-3">
                                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.
                                        </p>
    <a href="mailto:info@herbycharles.com"  class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-email mr-1"></i> Message</a>
        <a href="tel:+50944720056" class="btn btn-light btn-sm waves-effect"><i class="mdi mdi-phone mr-1"></i> Call</a>

                                        <ul class="social-list list-inline mt-3 mb-0">
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-purple text-purple"><i class="mdi mdi-facebook"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a href="#" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github-circle"></i></a>
                                            </li>
                                        </ul>

                                    </div> <!-- end .padding -->
                                </div> <!-- end card-box-->
                            </div>

                        </div>

