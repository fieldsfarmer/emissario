<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

	<div style="margin:0 0 35px;"></div>

	<script src="<?php echo URL; ?>public/js/materialize.js" type="text/javascript"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL_WITH_INDEX_FILE; ?>";

        $(document).ready(function(){
        	$('.button-collapse').sideNav();
        });
	</script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>public/js/application.js"></script>
</body>
</html>
