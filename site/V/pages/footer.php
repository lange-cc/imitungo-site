<footer>
<br>
<div class="row" style="margin-top: 40px;">
    <div class="col-md-12" style="text-align: center;background-color: #770808;color: #eee;padding: 6px;">
    <p style="font-size: 13px;">Copyright &copy; Imitungo 2019</p>
    </div>
</div>
</footer>


</body>

 <script src="<?= ASSETS ?>website/tmp/js/jquery-1.10.2.min.js"></script>
 <script src="<?= ASSETS ?>website/tmp/js/bootstrap.min.js"></script>


<?php
if(JQUERY) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/jquery.js" ></script>
    <script src="<?php echo ASSETS ?>default/js_plugin/popper.js"   ></script>
    <?php
}
if(BOOTSTRAP) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/bootstrap.js" ></script>
    <?php
}

if (VUE_JS) {
        ?>
        <script src="<?php echo ASSETS ?>default/js_plugin/vue.js"></script>
        <script src="<?php echo ASSETS ?>default/js_plugin/axios.js"></script>
<?php } 
?>

<script src="<?=ASSETS?>website/js/main.js"></script>

<?php
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