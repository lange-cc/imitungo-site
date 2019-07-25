
<input value= "items" type="hidden" id="page-type">
<input value= "<?=$this->category_id?>" type="hidden" id="category_id">
<div class="content-wrapper">
    <div class="items-widget">
        <div class="inventory-ribbon">
            <div class="inventory-section-title">
                <?=$this->category_name?>
            </div>
            <div class="tool-bar">
                <button class="btn btn-for-site   if-phone-btn"   data-toggle="modal" data-target="#new-item-modal"  ><span class="fa fa-plus-circle" ></span> New Item</button>
                <a href="<?=LINK?>items/" class="btn btn-primary">Back</a>
            </div>
        </div>


        <div class="data-list"  >
            <table class="table table-striped">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Product Name</th>
                    <th>Status</th>
                    <th>Price</th>
                    <th>Created Date</th>
                    <th>Action</th>

                </tr>
                <tr v-for="(item,index) in  items">
                    <td v-html="index+1"></td>
                    <td v-html="item.name"></td>
                    <td>
                        <span v-if="item.status == 'published'"  class="alert alert-success">Published</span>
                        <span  v-if="item.status == 'pending'" class="alert alert-primary">Pending</span>
                        <span  v-if="item.status == 'canceled'" class="alert alert-danger">Canceled</span>
                    </td>
                    <td v-html="item.price"></td>
                
                    <td v-html="item.created_date"></td>
                    <td>
                        <a :href=" '<?=LINK?>items/view-item/'+item.id"  title="View Item" class="btn btn-outline-primary"><span class="mdi mdi-eye-outline"></span></a>
                        <button class="btn btn-outline-dark  if-phone-btn"  data-toggle="modal" data-target="#update-item-modal"  @click="GetSingleItem(item.id)" title="Edit"><span class="fa fa-pencil"></span></button>
                        <a class="btn btn-outline-danger   if-phone-btn" title="Move to Trash" @click="DeleteItem(item.id,index)"><span class="fa fa-trash"></span></a>
                    </td>
                </tr>
            </table>

            <div class="pagination-widget">
                <ul class="pagination">
                    <li class="page-item" v-if="prev_page != null"  @click="GetAll(prev_page)"><a class="page-link" href="#">Previous</a></li>
                    <li class="page-item" v-for="page in end_page" v-if="page != 0"  :class=" 'page_'+page " @click="GetAll(page)"><a class="page-link" href="#" v-html="page"></a></li>
                    <li class="page-item" v-if="next_page != null" @click="GetAll(next_page)"> <a class="page-link" href="#">Next</a></li>
                </ul>
            </div>
        </div>






        <!-- The Modal -->
        <div class="modal" id="new-item-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Item</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?=LINK ?>items/add-new-item"  @submit.prevent="AddItems($event)" method="POST">
                            <?= $this->Auth() ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Product Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <div class="single-upload-widget">
                                            <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#profile-input','#profile-image-preview',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For product</p>
                                            </div>
                                            <div class="single-upload hide fadeInDown" id="profile-image-preview">
                                                <img src="" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#profile-image-preview')">  &times; </a>
                                            </div>
                                        </div>
                                        <input name="image" id="profile-input" type='hidden'>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-bottom: 30px;background: #fff;padding: 19px;margin-top: 20px;">
                                    <h6>Add other images</h6>
                                 <div class="row">
                                     <div class="col-3 add-other-files-container">
                                         <a href="#" class="btn btn-primary"  @click="OpenMiltUpload('#images-input',this)" ><span class="fa fa-plus-circle"></span> Add</a>
                                     </div>

                                     <div class="col-3"  v-for="(image,index) in  other_images" style="padding: 5px;position: relative;background: #ddd">
                                         <img :src="  '<?=ASSETS?>default/files/'+image" class="img-responsive">
                                         <a href="#" @click="RemoveImages(index)" class="btn btn-remove-selected">&times;</a>
                                     </div>

                                 </div>
                                    <input name="other_image" id="images-input" type='hidden'>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="location" class="form-control" placeholder="Location">
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" value="<?=$this->category_id?>" name="category_id">

                                <div class="col-12">
                                    <h5>Status</h5>
                                    <div class="site-form-control">
                                        <select class="form-control" name="status">
                                            <option value="pending"  >Pending</option>
                                            <option value="published">Publish</option>
                                            <option value="canceled">Cancel</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="creator" value="admin">
                                <input type="hidden" class="form-control" name="client_id" value="0">


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="model" class="form-control" placeholder="Model">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="price" class="form-control" placeholder="Price, EX:200000">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="numbers" name="year" class="form-control" placeholder="Year">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="plate_number" class="form-control" placeholder="Plate Number">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="email" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <textarea name="measurement" style="height: 150px;" class="form-control" placeholder="Measurement"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <textarea name="description" style="height: 200px;" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 v-spacer">
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

        <!--        ======================== update category modal ===================================-->
        <div class="modal" id="update-item-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Item</h4>
                        <a href="#" type="button" class="close" data-dismiss="modal">&times;</a>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body" v-if="item != null">
                        <input type="hidden" :value="item.id" id="id">
                        <form action="<?=LINK ?>items/update-item"  @submit.prevent="UpdateItem($event)" method="POST">
                            <?= $this->Auth() ?>
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" :value="item.name" placeholder="Product Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <div class="single-upload-widget">
                                            <div class="single-upload fadeInDown"
                                                 @click="OpenUpload('#profile-input-update','#profile-image-preview-update',this)"
                                                 v-if="profile == true">
                                                <h5>Select Image</h5>
                                                <p class="site-text-color"> For product</p>
                                            </div>
                                            <div class="single-upload fadeInDown" id="profile-image-preview-update">
                                                <img :src="    '<?=ASSETS?>default/files/'+item.image" class="img-responsive" style="width: 100%;">
                                                <a class="btn profile-cancel-btn"   @click="CanceProfile('#profile-image-preview-update')">  &times; </a>
                                            </div>
                                        </div>
                                        <input name="image" id="profile-input-update" type='hidden'>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-bottom: 30px;background: #fff;padding: 19px;margin-top: 20px;">
                                    <h6>Add other images</h6>
                                    <div class="row">
                                        <div class="col-3 add-other-files-container">
                                            <a href="#" class="btn btn-primary"  @click="OpenMiltUpload('#update-images-input',this)" ><span class="fa fa-plus-circle"></span> Add</a>
                                        </div>

                                        <div class="col-3"  v-for="(image,index) in  other_images" style="padding: 5px;position: relative;background: #ddd">
                                            <img :src="  '<?=ASSETS?>default/files/'+image" class="img-responsive">
                                            <a href="#" @click="RemoveImages(index)" class="btn btn-remove-selected">&times;</a>
                                        </div>

                                    </div>
                                    <input name="other_image"    id="update-images-input" type='hidden'>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="location"  :value="item.location"  class="form-control" placeholder="Location">
                                    </div>
                                </div>

                                <input type="hidden" class="form-control"  value="<?=$this->category_id?>" name="category_id">

                                <div class="col-12">
                                    <h5>Status</h5>
                                    <div class="site-form-control">
                                        <select class="form-control" name="status">
                                            <option value="pending" v-if="item.status == 'pending'" selected>Pending</option>
                                            <option value="published"  v-if="item.status == 'published'" selected>Publish</option>
                                            <option value="canceled"  v-if="item.status == 'canceled'" selected>Cancel</option>
                                            <option value="pending"  >Pending</option>
                                            <option value="published">Publish</option>
                                            <option value="canceled">Cancel</option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" class="form-control" name="creator" value="admin">
                                <input type="hidden" class="form-control" name="client_id" value="0">


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="model" class="form-control" :value="item.model" placeholder="Model">
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="price" class="form-control" :value="item.price" placeholder="Price, EX: FRW 200,000">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="numbers" name="year" class="form-control" :value="item.year" placeholder="Year">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="plate_number" :value='item.plate_number' class="form-control" placeholder="Plate Number">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="phone" :value="item.phone" class="form-control" placeholder="Phone">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="email" name="email"  :value='item.email' class="form-control" placeholder="Email">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <textarea name="measurement" :value="item.measurement" style="height: 150px;" class="form-control" placeholder="Measurement"></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="site-form-control">
                                        <textarea name="description" :value="item.description" style="height: 200px;" class="form-control" placeholder="Description"></textarea>
                                    </div>
                                </div>

                                <div class="col-12 v-spacer">
                                    <div class="site-form-control">
                                        <button  class="btn btn-for-site" type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="#" type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</a>
                    </div>

                </div>
            </div>
        </div>



    </div>
</div>


