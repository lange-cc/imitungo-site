<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?= $this->GetTitle() ?></title>
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/css/style.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/css/upload.css">
    <link rel="shortcut icon" href="<?= ASSETS ?>admin/images/favicon.ico"/>
    <?php
    if (A_TURBOLINK_JS) {
        ?>
        <style>
            .turbolinks-progress-bar {
                background: #40e0d0; /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }
        </style>
        <script src="<?php echo ASSETS ?>default/js_plugin/turbolinks.js"></script>
        <script>
            document.addEventListener("turbolinks:load", function () {
                Turbolinks.clearCache();
            });
        </script>
        <?php
    }
    ?>
    <?php
    if (VUE_JS) {
        ?>
        <script src="<?php echo ASSETS ?>default/js_plugin/vue.js"></script>
        <script src="<?php echo ASSETS ?>default/js_plugin/axios.js"></script>
    <?php } ?>

    <?php
    if (A_BOOTSTRAP) {
        ?>
        <link rel="stylesheet" href="<?php echo ASSETS ?>default/css/bootstrap/bootstrap.css"
              data-turbolinks-track="reload">
        <?php
    } ?>

    <?php
    if (ANIMATION) {
        ?>
        <link rel="stylesheet" href="<?php echo ASSETS ?>default/css/animate.css" data-turbolinks-track="reload">
        <?php
    } ?>

    <?php
    if (isset($this->css)) {
        foreach ($this->css as $css) {
            if (file_exists("assets/" . $css)) {
                ?>
                <link rel="stylesheet" href="<?php echo ASSETS . $css; ?>">
                <?php
            } else {
                $error = array(
                    'Type' => 'File missing',
                    'Message' => "CSS file not found on " . ASSETS . $css,
                    'Dir' => "assets/" . $css,
                    'Code' => '0001'
                );
                SYSTEM_ERROR::render_error($error);
            }
        }
    }
    ?>

</head>
<body>

<div class="alert-template">
    <div class="alert fadeInDown" style="display: none;" v-bind:style="{ display: show}"
         v-bind:class="{ 'alert-danger': OnError, 'alert-success': OnSuccess , 'alert-primary' : OnWait }">
        <span v-if='loading' class="fa fa-facebook spin" style="margin-right: 10px;"></span>
        {{message_data}}
    </div>
</div>

<div class="ask-dialog" style="display: none;" v-bind:style="{ display: show}">
    <div class="ask-dialog-template fadeInDown">
        <div class="dialog-template-title" v-html="message_data">
        </div>
        <div class="dialog-template-option">
            <div class="tool-bar">
                <button class="btn btn-outline-dark   if-phone-btn" @click="Confirmed()">Yes</button>
                <button class="btn btn-for-site   if-phone-btn" @click="Canceled()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row" id="profile-widget">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <div class="phone-logo-image">
            <img src="<?= ASSETS ?>admin/images/favicon.ico" alt="logo image">
        </div>

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-right">
    
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="javascript:void(0)"
                   @click=" isProfile_widget = 'block'">
                    <span class="profile-text">Hello, <?=$this->user->names?></span>
                    <img class="img-xs rounded-circle" src="<?= ASSETS ?>default/files/<?=$this->user->profile_logo?>"
                         alt="Profile image">
                </a>

                <div class="user-profile-widget fadeInRight" style="display: none;"
                     v-bind:style="{ display: isProfile_widget}">
                    <div class="profile-logo">
                        <img class="img-lg rounded-circle" src="<?= ASSETS ?>default/files/<?=$this->user->profile_logo?>"
                             alt="Profile image">
                        <h5 class="profile-name text-white"><?=$this->user->names?></h5>
                        <p class="user-title"><?=$this->user->title?></p>
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0)" @click="edit_profile = true"
                                   class="btn btn-sm btn-success">Edit</a>
                            </div>
                            <div class="col-6">
                                <a href="<?=LINK?>login/logout" class="btn  btn-sm btn-dark">Logout</a>
                            </div>
                        </div>
                        <div class="profile-edit-overlay fadeInUp" v-if="edit_profile">

                          <form @submit.prevent="UpdateUser($event)" method="post" action="<?=LINK?>profile/update-user">
                            <div class="logo-editor">
                                <div class="logo-img-btn"  id="user_profile_logo_preview">
                                    <img class="img-lg rounded-circle" src="<?= ASSETS ?>default/files/<?=$this->user->profile_logo?>"
                                         alt="Profile image">
                                    <a href="#" class="btn btn-icons btn-rounded btn-info" 
                                    @click="OpenUpload('#user_profile_logo_input','#user_profile_logo_preview',this)">
                                    <span
                                                class="mdi mdi-pencil"></span></a>
                                </div>
                            </div>

                           <input type="hidden" name="profile_logo" value="<?=$this->user->profile_logo?>" id="user_profile_logo_input">
                         
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Names" name="names" value="<?=$this->user->names?>">
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Job Title" name="title" value="<?=$this->user->title?>" >
                                        <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-8">
                                            <button type="submit" class="btn btn-sm btn-success "> Update</button>
                                        </div>
                                        <div class="col-4">
                                            <a href="javascript:void(0)" @click="edit_profile = false"
                                               class="btn  btn-sm btn-dark">Close</a>
                                        </div>
                                    </div>
                                </div>


                            </form>

                        </div>
                    </div>


                    <a href="javascript:void(0)" @click=" isProfile_widget = 'none'"
                       class="btn btn-dark btn-fw fill-bottom-width">Close</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link nav-desktop">
                <div class="user-wrapper">
                    <div class="logo-image ">
                        <img src="<?= ASSETS ?>admin/images/logo.png" alt="logo image">
                    </div>

                </div>

            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" href="<?=LINK?>content"  aria-expanded="<?=IsCurrentPage('content','true')?>" >
                <i class="menu-icon fa fa-file-text-o"></i>
                <span class="menu-title">Content</span>
            </a>
        </li>


 <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#clients"  aria-expanded="<?=IsCurrentPage('clients','true')?>" aria-controls="ui-basic">
                   <i class="menu-icon mdi mdi-account"></i>
                   <span class="menu-title">Clients</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="clients">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item submenu">
                           <a class="nav-link" href="<?=LINK?>clients/dealer"> <i class="fa fa-bank" style="margin-right: 4px"></i> Dealer</a>
                       </li>
                        <li class="nav-item submenu">
                           <a class="nav-link" href="<?=LINK?>clients/buyer"> <i class="fa fa-money" style="margin-right: 4px"></i>  Customer</a>
                       </li>
                   </ul>
               </div>
           </li>



        <li class="nav-item">
            <a class="nav-link" href="<?=LINK?>items"  aria-expanded="<?=IsCurrentPage('items','true')?>" >
                <i class="menu-icon mdi mdi-store"></i>
                <span class="menu-title">Items</span>
            </a>
        </li>


 <li class="nav-item">
               <a class="nav-link" data-toggle="collapse" href="#setting" aria-expanded="<?=IsCurrentPage('settings','true')?>" aria-controls="ui-basic">
                   <i class="menu-icon mdi mdi-settings"></i>
                   <span class="menu-title">Settings</span>
                   <i class="menu-arrow"></i>
               </a>
               <div class="collapse" id="setting">
                   <ul class="nav flex-column sub-menu">
                       <li class="nav-item submenu">
                           <a class="nav-link" href="<?=LINK?>settings/admin-users"> <i class="menu-icon mdi mdi-account"></i> Admin User</a>
                       </li>
                   </ul>
               </div>
           </li>
    </ul>
</nav>
<input value="<?= LINK ?>" id="LINK" type="hidden">

<div class="container-fluid page-body-wrapper">
    <div class="main-panel">



