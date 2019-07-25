<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=$this->GetTitle()?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=ASSETS?>admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=ASSETS?>admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=ASSETS?>admin/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?=ASSETS?>admin/css/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= ASSETS ?>admin/images/favicon.ico"/>
</head>

<body>
<input value="<?=LINK?>" id="LINK" type="hidden">
<div class="container-scroller" id="Login">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page" style="padding-left: 0px !important;">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-3 mx-auto">
                    <div class="auto-form-wrapper">
                        <form  @submit.prevent="LoginUser" method="post" action="#">
                            <div class="form-group">
                                <label class="label">Username</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="example@everything.rw" name="username" v-model="credentials.username">
                                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" placeholder="*********" name="password" v-model="credentials.password">
                                         <?=$this->Auth()?>
                                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary submit-btn btn-block "> Login</button>
                            </div>
                            <div class="form-group">
                                <div class="alert" style="font-size: 12px;" v-bind:class="{ 'alert-success' : isSuccess, 'alert-danger' : isDanger, 'alert-info' : isWait }" v-if=" isLogin" >
                                    <img src="<?=ASSETS?>admin/images/loading.gif" width="30" v-if="loader">
                                   <span v-html="message"></span>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between">
                                <div class="form-check form-check-flat mt-0">
                                    <label class="form-check-label">
                                        <input name="keep" v-model="credentials.keep" type="checkbox" class="form-check-input" checked> Keep me signed in
                                    </label>
                                </div>
                                <a href="<?=LINK?>login/forgot-password" class="text-small forgot-password text-black">Forgot Password</a>
                            </div>

                        </form>
                    </div>

                    <p class="footer-text text-center" style="margin-top: 100px;">Copyright © 2019 - <?=date('Y')?> LANGE. All rights reserved.</p>

                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="<?=ASSETS?>admin/vendors/js/vendor.bundle.base.js"></script>
<script src="<?=ASSETS?>admin/vendors/js/vendor.bundle.addons.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?=ASSETS?>admin/js_plugin/off-canvas.js"></script>
<script src="<?=ASSETS?>admin/js_plugin/misc.js"></script>


<!-- endinject -->
</body>
<?php
if(A_VUE_JS) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/vue.js" ></script>
    <script src="<?php echo ASSETS ?>default/js_plugin/axios.js" ></script>
    <?php
}
if(A_JQUERY) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/jquery.js" ></script>
    <script src="<?php echo ASSETS ?>default/js_plugin/popper.js"   ></script>
    <?php
}
if(A_BOOTSTRAP) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/bootstrap.js" ></script>
    <?php
}
if (isset($this->js)) {
    foreach ($this->js as $js) {
        if(file_exists("assets/".$js)) {
            ?>
            <script type="text/javascript" src="<?php echo ASSETS . $js; ?>" ></script>
            <?php
        }else{
            $error = array(
                'Type' => 'File missing',
                'Message' =>  "JavaScript file not found on ".ASSETS . $js,
                'Dir' => "assets/". $js,
                'Code' => '0001'
            );
            SYSTEM_ERROR::render_error($error);
        }
    }
}
?>
</html>