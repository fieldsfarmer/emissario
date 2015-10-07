<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

    <!-- jQuery, loaded in the recommended protocol-less way -->
    <!-- more http://www.paulirish.com/2010/the-protocol-relative-url/ -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="<?php echo URL; ?>public/js/materialize.js" type="text/javascript"></script>

    <!-- define the project's URL (to make AJAX calls possible, even when using this in sub-folders etc) -->
    <script>
        var url = "<?php echo URL_WITH_INDEX_FILE; ?>";

        $( document ).ready(function(){
        	$(".button-collapse").sideNav();
        });
    </script>

    <!-- our JavaScript -->
    <script src="<?php echo URL; ?>public/js/application.js"></script>
</body>
</html>
