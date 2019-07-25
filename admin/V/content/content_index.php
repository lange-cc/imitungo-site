
<input value= "main" type="hidden" id="page-type">

<div class="content-wrapper">
    <div class="content-widget">
        <div class="inventory-ribbon">
            <div class="inventory-section-title">
                Content
            </div>
            <div class="tool-bar">
                <button class="btn btn-for-site   if-phone-btn"   data-toggle="modal" data-target="#new-content-modal"  ><span class="fa fa-plus-circle" ></span> New</button>
            </div>
        </div>



        <div class="data-list"  >
                <table class="table table-striped">
                    <tr>
                        <th>N<sup>o</sup></th>
                        <th>Title</th>
                        <th>Sub Title</th>
                        <th>Image</th>
                        <th>Video</th>
                        <th>Action</th>
                    </tr>

                    <?php
                      $data =  $this->content;
                       foreach ($data as $index =>  $article) {
                    ?>
                    <tr>
                        <td><?=$index+1?></td>
                        <td><?=$article->title?></td>
                        <td><?=$article->sub_title?></td>
                        <td>
                        <?php
                              if($article->image != '')
                              {
                            ?>
                        <img src='<?=ASSETS?>default/files/<?=$article->image?>' class='img-responsive'>
                        <?php
                              }
                              ?>
                              </td>
                        <td>
                            <?php
                              if($article->video != '')
                              {
                            ?>
                        <iframe width="100%" height="100" src="https://www.youtube.com/embed/<?=$article->video?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            <?php
                              }
                              ?>
                        </td>
                        <td>
                            <button class="btn btn-outline-dark  if-phone-btn"  data-toggle="modal" data-target="#update-content-modal"  @click="GetSingleContent(<?=$article->id?>)" title="Edit"><span class="fa fa-pencil"></span></button>
                            <a class="btn btn-outline-danger   if-phone-btn" title="Move to Trash" @click="DeleteContent(<?=$article->id?>)"><span class="fa fa-trash"></span></a>
                        </td>
                    </tr>

                    <?php
                    }
                    ?>


                </table>
    
               
            </div>



       

         <!-- The Modal -->
         <div class="modal" id="new-content-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Content</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?=LINK ?>content/add-new-content"  @submit.prevent="AddContent($event)" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="title" placeholder="Title" class="form-control">
                                
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="sub_title" placeholder="Sub Title" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <a href="#" @click='media_switch = true' class="btn btn-primary">Image</a>
                                        <a href="#" @click='media_switch = false' class="btn btn-success">Video</a>
                                    </div>
                                </div>

                                <div class="col-12" v-if='media_switch'>
                                    <div class="site-form-control">
                                        <div class="single-upload-widget">
                                            <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#update-profile-input','#update-profile-image-preview',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For product</p>
                                            </div>
                                            <div class="single-upload hide fadeInDown" id="update-profile-image-preview">
                                                <img src="" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#update-profile-image-preview')">  &times; </a>
                                            </div>
                                        </div>
                                        <input name="image" id="update-profile-input" type='hidden'>
                                    </div>
                                </div>


                                <div class="col-12" v-if='media_switch == false'>
                                    <div class="site-form-control">
                                         <textarea placeholder='Embend video from youtube' name='video' class="form-control"></textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <button  class="btn btn-for-site" type="submit">Save</button>
                                    </div>
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

<!-- -------------------------------------------------- -->

  <!-- The Modal -->
  <div class="modal" id="update-content-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-titsle">Update Content</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" v-if='content_item != null'>
                        <input id='id' :value='content_item.id' type='hidden'>
                        <form action="<?=LINK ?>content/update-content"  @submit.prevent="UpdateContent($event)" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="title" :value='content_item.title' placeholder="Title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="sub_title" :value='content_item.sub_title' placeholder="Sub Title" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <a href="#" @click='media_switch = true' class="btn btn-primary">Image</a>
                                        <a href="#" @click='media_switch = false' class="btn btn-success">Video</a>
                                    </div>
                                </div>

                                <div class="col-12" v-if='media_switch'>
                                    <div class="site-form-control">
                                        <div class="single-upload-widget">
                                            <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#profile-input','#profile-image-preview',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For product</p>
                                            </div>
                                            <div class="single-upload fadeInDown" id="profile-image-preview">
                                                <img :src="'<?=ASSETS?>default/files/'+content_item.image" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#profile-image-preview')">  &times; </a>
                                            </div>
                                        </div>
                                        <input name="image" :value='content_item.image' id="profile-input" type='hidden'>
                                    </div>
                                </div>


                                <div class="col-12" v-if='media_switch == false'>
                                    <div class="site-form-control">
                                         <textarea v-html='content_item.video' placeholder='Embend video from youtube' name='video' class="form-control"></textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <button  class="btn btn-for-site" type="submit">Update</button>
                                    </div>
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

        <!-- ================================= -->


</div>
</div>
