<footer>

</footer>
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