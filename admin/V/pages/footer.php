<footer class="footer">
    <div class="container-fluid clearfix">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 - <?= date('Y') ?>
            <a href="http://www.bootstrapdash.com/" target="_blank"> LANGE </a>. All rights reserved.</span>
    </div>
</footer>
</div>
</div>

<?php require_once ADMIN_FOLDER."/V/pages/upload.php";?>


<?php
if (A_JQUERY) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/jquery.js"></script>
    <script src="<?php echo ASSETS ?>default/js_plugin/popper.js"></script>
    <?php
}
if (A_BOOTSTRAP) {
    ?>
    <script src="<?php echo ASSETS ?>default/js_plugin/bootstrap.js"></script>
    <?php
} ?>


<script src="<?= ASSETS ?>admin/vendors/js/vendor.bundle.base.js"></script>
<script src="<?= ASSETS ?>admin/vendors/js/vendor.bundle.addons.js"></script>
<script src="<?= ASSETS ?>admin/js_plugin/off-canvas.js"></script>
<script src="<?= ASSETS ?>admin/js_plugin/misc.js"></script>
<script src="<?= ASSETS ?>admin/js/upload.js"></script>
<script src="<?= ASSETS ?>admin/js_plugin/dashboard.js"></script>
<script src="<?= ASSETS ?>admin/js/main.js"></script>


<?php
if (isset($this->js)) {
    foreach ($this->js as $js) {
        if (file_exists("assets/" . $js)) {
            ?>
            <script type="text/javascript" src="<?php echo ASSETS . $js; ?>"></script>
            <?php
        } else {
            $error = array(
                'Type' => 'File missing',
                'Message' => "JavaScript file not found on " . ASSETS . $js,
                'Dir' => "assets/" . $js,
                'Code' => '0001'
            );
            SYSTEM_ERROR::render_error($error);
        }
    }
}
?>
</body>

</html>