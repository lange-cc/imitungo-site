<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?=Isdefined($this->title)?></title>
        <style>
            .turbolinks-progress-bar
            {
                background: #40e0d0; /* fallback for old browsers */
                background: -webkit-linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* Chrome 10-25, Safari 5.1-6 */
                background: linear-gradient(to right, #40e0d0, #ff8c00, #ff0080); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            }
        </style>
        <script src="<?php echo DEV_ASSETS ?>js_plugin/turbolinks.js"></script>
        <script>
            document.addEventListener("turbolinks:load", function() {
                Turbolinks.clearCache()
            }
        </script>
        <link rel="stylesheet" href="<?php echo DEV_ASSETS ?>css/bootstrap/bootstrap.css" data-turbolinks-track="reload">
    <?php
    if (isset($this->css)) {
        foreach ($this->css as $css) {
            if(file_exists("app/system/dev/public/".$css)) {
                ?>
    <link rel="stylesheet" href="<?php echo DEV_ASSETS . $css; ?>">
                <?php
            }
        }
    }
    ?>

</head>
<body>
<div class="dev-wrapper">
    <div class="form-container">
           <div class="card-form">
                 <div class="card-image-viewer"></div>
                  <div class="card-primary-form">
                      <h1>Developer information</h1>
                          <form method="post" action="">
                              <div class="input-widget">
                                  <label>Full names</label>
                                  <input placeholder="Enter full names" class="form-control" name="names" type="text">
                              </div>
                              <div class="input-widget">
                                  <label>Profile</label> <br>
                                  <a  href="#" class="btn btn-success" >Select Profile </a>
                              </div>
                              <div class="input-widget">
                                  <label>Email</label>
                                  <input placeholder="Enter email" class="form-control" name="email" type="email">
                              </div>
                              <div class="input-widget">
                                  <label>Password</label>
                                  <input placeholder="Enter password" class="form-control" name="password" type="password"><br>
                              </div>
                              <div class="input-widget">
                                  <input value="Next" class="btn btn-primary"  type="submit">
                              </div>

                          </form>
                  </div>
           </div>
    </div>
</div>
<footer></footer>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/vue.js" ></script>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/axios.js" ></script>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/jquery.js" ></script>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/popper.js"   ></script>
    <script src="<?php echo DEV_ASSETS ?>js_plugin/bootstrap.js" ></script>
    <?php
if (isset($this->js)) {
    foreach ($this->js as $js) {
        if(file_exists("app/system/dev/public/".$js)) {
            ?>
            <script type="text/javascript" src="<?php echo DEV_ASSETS . $js; ?>" ></script>
            <?php
        }
    }
}
?>
</body>
</html>



