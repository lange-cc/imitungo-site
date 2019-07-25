<div class="dev-wrapper" id="create-form" >
    <div  class="create-dev-form fadeInDown">
        <div class="create-form-title">
            Create page
        </div>
        <div class="form-create-widget">
            <div class="alert alert-success fadeInDown" v-if="alert_success"><span class="fa fa-info-circle"></span> {{message}}</div>
            <div class="alert alert-danger fadeInDown" v-if="alert_dander"><span class="fa fa-warning"></span> {{message}}</div>
            <input type="text" name="page-name" class="form-control" placeholder="Enter page name" v-model="page_name"> <br>
            <select name="page-type" class="form-control" v-model="page_type">
                <option value="admin" selected>Admin</option>
                <option value="website">Site</option>
<!--                <option value="api">Api</option>-->
            </select>
                <br>
            <div class="row">
                <div class="col-lg-8">
                    <button v-on:click="Request" class="btn btn-success btn-outline-success">Create Page</button>
                </div>
                <div class="col-lg-4">
                    <img src="<?= DEV_ASSETS ?>images/loading.gif" v-if="loading_icon" class="dev-loading-icon">
                </div>
            </div>
        </div>

    </div>
</div>