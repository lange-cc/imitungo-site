<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= IsDefined($this->title) ?></title>
    <style>
        .turbolinks-progress-bar {
            background: #40e0d0; /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }
    </style>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/turbolinks.js"></script>
    <script>
        document.addEventListener("turbolinks:load", function () {
            Turbolinks.clearCache()
        });
    </script>
    <link rel="stylesheet" href="<?php echo DEV_ASSETS ?>css/bootstrap/bootstrap.css" data-turbolinks-track="reload">
    <link rel="stylesheet" href="<?php echo DEV_ASSETS ?>iconfonts/font-awesome/css/font-awesome.css" data-turbolinks-track="reload">
    <link rel="stylesheet" href="<?php echo DEV_ASSETS ?>css/animate.css" data-turbolinks-track="reload">
    <?php
    if (isset($this->css)) {
    foreach ($this->css as $css) {
    if (file_exists("app/system/dev/public/" . $css)) {
    ?>
    <link rel="stylesheet" href="<?php echo DEV_ASSETS . $css; ?>">
<?php
}
}
}
?>
    <input type="hidden" id="LINK" value="<?=LINK?>">
