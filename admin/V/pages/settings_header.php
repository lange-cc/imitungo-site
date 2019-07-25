<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <link rel="shortcut icon" href="<?= ASSETS ?>admin/images/favicon.ico"/>
    <title><?= $this->GetTitle() ?></title>
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/vendors/iconfonts/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="<?= ASSETS ?>admin/css/style.css">
<?php
if(TURBOLINK_JS) {
    ?>
    <style>
        .turbolinks-progress-bar
        {
            background: #40e0d0; /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
    <script src="<?php echo ASSETS ?>default/js_plugin/turbolinks.js"></script>
    <script>
        document.addEventListener("turbolinks:load", function() {
            Turbolinks.clearCache()
        }
    </script>
    <?php
}
?>

<?php
if(BOOTSTRAP) {
    ?>
    <link rel="stylesheet" href="<?php echo ASSETS ?>default/css/bootstrap/bootstrap.css" data-turbolinks-track="reload">
    <?php
}?>
<?php
if(ANIMATION) {
    ?>
    <link rel="stylesheet" href="<?php echo ASSETS ?>default/css/animate.css" data-turbolinks-track="reload">
    <?php
}?>

<?php
if (isset($this->css)) {
foreach ($this->css as $css) {
if(file_exists("assets/". $css)){
?>
<link rel="stylesheet" href="<?php echo ASSETS . $css; ?>" >
    <?php
}else{
    $error = array(
        'Type' => 'File missing',
        'Message' =>  "CSS file not found on ".ASSETS . $css,
        'Dir' => "assets/". $css,
        'Code' => '0001'
    );
    SYSTEM_ERROR::render_error($error);
}
}
}
?>

    </head>

<body>

    <div class="header">
        <div class="header-title">
            <img src="<?= ASSETS ?>admin/images/logo.jpg" alt="image" class="profile-pic">
            <p>Admin Settings</p>
        </div>
        <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="">
                <span class="nav-icons">
                <p><a href="<?= LINK?>settings/Autoload" class="rounded-circle active"><span class="mdi mdi-translate"></span></a></p>
                <p>Languages</p>
                </span>
                <span class="nav-icons">
                <p><a href="<?= LINK?>settings/settings-permissions" class="rounded-circle"><span class="mdi mdi-lock"></span></a></p>
                <p>Permissions</p>
                </span>
                <span class="nav-icons">
                <p><a href="#" class="rounded-circle"><span class="mdi mdi-clipboard-text"></span></a></p>
                <p>Reports</p>
                </span>
                <span class="nav-icons">
                <p><a href="#" class="rounded-circle"><span class="mdi mdi-account-multiple"></span></a></p>
                <p>Users</p>
                </span>
            </div>
        </div>
        <div class="col-md-3"></div>
        </div>
    </div>