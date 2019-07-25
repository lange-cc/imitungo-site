
<input value= "main" type="hidden" id="page-type">

<div class="content-wrapper">
    <div class="items-widget">
        <div class="inventory-ribbon">
            <div class="inventory-section-title">
                Categories
            </div>
            <div class="tool-bar">
                <button class="btn btn-for-site   if-phone-btn"   data-toggle="modal" data-target="#new-category-modal"  ><span class="fa fa-plus-circle" ></span> New Category</button>
            </div>
        </div>


        <div class="data-list"  >
            <table class="table table-striped">
                <tr>
                    <th>N<sup>o</sup></th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                <tr v-for="(category,index) in   categories">
                    <td v-html="index+1"></td>
                    <td v-html="category.name "></td>
                    <td>
                        <a :href=" '<?=LINK?>items/view-category/'+category.name+'/'+category.id"  title="View Items" class="btn btn-outline-primary"><span class="mdi mdi-eye-outline"></span></a>
                        <button class="btn btn-outline-dark  if-phone-btn"  data-toggle="modal" data-target="#update-category-modal"  @click="GetSingleCategory(category.id)" title="Edit"><span class="fa fa-pencil"></span></button>
                        <a class="btn btn-outline-danger   if-phone-btn" title="Move to Trash" @click="DeleteCategory(category.id,index)"><span class="fa fa-trash"></span></a>
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
        <div class="modal" id="new-category-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="<?=LINK ?>items/add-new-category"  @submit.prevent="AddCategory($event)" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Category Name" class="form-control">
                                        <input type="hidden" name="parent_id" value="0">
                                        <?= $this->Auth() ?>
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

<!--        ======================== update category modal ===================================-->
        <!-- The Modal -->
        <div class="modal" id="update-category-modal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Update Category</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="hidden" :value="category.id" id="id">
                        <form action="<?=LINK ?>items/update-category"  @submit.prevent="UpdateCategory($event)" method="POST">
                            <div class="row">
                                <div class="col-12">
                                    <div class="site-form-control">
                                        <input type="text" name="name" placeholder="Category Name" :value="category.name"  class="form-control">
                                        <?= $this->Auth() ?>
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



    </div>
</div>


