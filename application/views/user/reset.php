<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container" style= "position: fixed; top: 30%; left: 40%; ">
	<div class="container" style="width:300px; margin:0 0 40px 0;">
		<h2 class="page-header">Forget password</h2>
		<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/login" class="form-horizontal">
			<div class="form-group">
				<label for="email" class="col-sm-2 control-label">Email</label>
				<div class="col-sm-10">
					<input type="email" id="email" name="email" class="form-control" required aria-required="true" />
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Get Password</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#form').validate({
			rules: {
				email: {
					email: true
				}
			}
		});
	});
</script>