<input value= "main" type="hidden" id="page-type">

<div class="content-wrapper">
    <div class="settings-widget">
        <div class="inventory-ribbon">
            <div class="inventory-section-title">
                All Admin Users
            </div>
            <div class="tool-bar">
                <button class="btn btn-for-site   if-phone-btn"   data-toggle="modal" data-target="#new-user-modal"  ><span class="fa fa-plus-circle" ></span> New</button>
            </div>
        </div>


        <div class="data-list">
            <table class="table table-striped">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Names</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th>Last Login</th>
                    <th>Action</th>
                </tr>

<?php
 $data = $this->users;
 foreach ($data as $index => $user) {
 ?>
                <tr id="user_<?=$user->id?>">
                    <td><?=$index+1?></td>
                    <td><?=$user->names?></td>
                    <td><?=$user->username?></td>
                    <td><?=$user->title?></td>
                    <td><?=$user->last_login?></td>
                    <td>
                        <button class="btn btn-outline-dark  if-phone-btn"  data-toggle="modal" data-target="#update-user-modal"  @click="GetSingleUser(<?=$user->id?>)" title="Edit"><span class="fa fa-pencil"></span></button>
                        <a class="btn btn-outline-danger if-phone-btn" title="Move to Trash" @click="DeleteUser(<?=$user->id?>)"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
<?php
 }
?>

            </table>

            
        </div>






        <!-- The Modal -->
        <div class="modal" id="new-user-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create New User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?=LINK ?>profile/add-new-user"  @submit.prevent="AddUser($event)" method="POST">
                            <div class="row">

                                <div class="col-12">
                                    <div class="site-form-control">
                                            <div class="single-upload-widget">
                                                <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#profile-input','#profile-image-preview',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For prolife</p>
                                            </div>
                                            <div class="single-upload hide fadeInDown" id="profile-image-preview">
                                                <img src="" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#profile-image-preview')">  &times; </a>
                                            </div>
                                        </div>
                                    </div>
                                        <input name="profile_logo" id="profile-input" type='hidden'>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="names" placeholder="Full Names" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="title" placeholder="Job Title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="username" placeholder="Enter Your Email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="password" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <button  class="btn btn-for-site" type="submit">Save</button>
                                    </div>
                                </div>
                                 </form>
                             </div>
                         

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>

<!--        ======================== update category modal ===================================-->
        <!-- The Modal -->
        <div class="modal" id="update-user-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" v-if='user != null'>

                        <input type="hidden" :value="user.id" id="id">
                        <form action="<?=LINK?>profile/update-user-data"  @submit.prevent="UpdateUser($event)" method="POST">
                            <div class="row">

                                <div class="col-12">
                                    <div class="site-form-control">
                                            <div class="single-upload-widget">
                                                <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#profile-input-update','#profile-image-preview-update',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For prolife</p>
                                            </div>
                                            <div class="single-upload  fadeInDown" id="profile-image-preview-update">
                                                <img :src="'<?=ASSETS?>default/files/'+user.profile_logo" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#profile-image-preview-update')">  &times; </a>
                                            </div>
                                        </div>
                                    </div>
                                        <input :value="user.profile_logo" name="profile_logo" id="profile-input-update" type='hidden'>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" :value="user.names" name="names" placeholder="Full Names" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="title" :value="user.title" placeholder="Job Title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="username" :value="user.username" placeholder="Enter Your Email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="password" required="" placeholder="Password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <button  class="btn btn-for-site" type="submit">Update</button>
                                    </div>
                                </div>
                                 </form>
                      


                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>


