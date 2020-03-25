<?php
/**
 * Created by PhpStorm.
 * User: fater
 * Date: 4/8/2019
 * Time: 11:02 PM
 */
?>


<div class="row">


    <div class="offset-1 col-lg-8 col-xl-9">
        <div class="">
            <div class="card-box">
                <form role="form" method="post" data-parsley-validate enctype="multipart/form-data">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="FullName">Prenom </label>
                        <input type="text" placeholder="John" name="prenom" class="form-control" >
                    </div>
                        <div class="form-group col-md-6">
                            <label for="FullName">Nom</label>
                            <input type="text" placeholder="Doe" name="nom" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="email" placeholder="first.last@example.com" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Username">Pseudo</label>
                        <input type="text" placeholder="john" name="pseudo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="Username">Telephone</label>
                        <input type="text" placeholder="+509 0000 00 00" name="telephone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Username">Photo</label>
                        <input type="file"  name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" placeholder="6 - Characters" id="Password" data-parsley-minlength="6" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="RePassword">Re-Password</label>
                        <input type="password" placeholder="6 - Characters" data-parsley-equalto="#Password" name="password" data-parsley-minlength="6" class="form-control" required>
                    </div>

                    <button class="btn btn-primary waves-effect waves-light w-md" type="submit">Save</button>
                </form>

            </div>
        </div>

    </div> <!-- end col -->
</div>

