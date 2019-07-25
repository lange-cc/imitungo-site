<html>
<head>
    <title><?=SYSTEM_ERROR::display_error($Error['Type'])?></title>
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
    <script src="<?php echo ASSETS ?>js_plugin/turbolinks.js"></script>
    <?php } ?>
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .body_wrapper
        {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            right: 0;
            background: #fff;
            z-index: 9999999999999999999999999999999999999999999999999999999999999999999;
        }
        .error_nav{
            position: fixed;
            left: 0;
            right: 0;
            top: 0;
            height: 63px;
            background: #004146;
            box-shadow: 1px 1px 12px #000;
        }
        .error_logo{
            color: #fff;
            top: 12px;
            position: relative;
            left: 10px;
            font-weight: 800;
            font-size: 31px;
        }
        .error_type
        {
            font-size: 13px;
            color: #bababa;
            padding-left: 18px;
            top: 5px;
            position: relative;
        }
        .error_code
        {
            float: right;
            position: relative;
            top: 19px;
            right: 10px;
            color: white;
        }
        .error_body{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }
        .error-widget{
            width: 700px;
            height: 250px;
            background: #dadada;
            border-bottom-left-radius: 22px;
            border-bottom-right-radius: 22px;
            padding-top: 73px;
            padding-left: 15px;
            padding-right: 15px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0px 2px 1px #8c8c8c;
        }
        .error-dir
        {
            height: 100px;
            border-top: 4px solid #08565c;
            color: #4d4d4d;
            padding-top: 11px;
        }.error-message{
            color: #000000;
            font-size: 20px;
                 }
    </style>
</head>
<body>
<div class="body_wrapper">
<nav class="error_nav">
   <span class="error_logo">LOGO</span>
    <span class="error_type"><?=SYSTEM_ERROR::display_error($Error['Type'])?></span>

    <span class="error_code">Code: <?=SYSTEM_ERROR::display_error($Error['Code'])?></span>
</nav>
<div class="error_body">
    <div class="error-widget">
        <div class="error-message"><?=SYSTEM_ERROR::display_error($Error['Message'])?></div>
              <div class="error-dir">Directory: <?=SYSTEM_ERROR::display_error($Error['Dir'])?></div>
    </div>
</div>

</div>
</body>
</html>