<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container" style= "position: fixed; top: 30%; left: 40%; ">
	<div class="container" style="width:300px; margin:0 0 40px 0;">
		<h4>Forget password</h4>
		<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/login" class="col s12" novalidate="novalidate">
			<div class="row">
				<div class="input-field col s12">
					<input type="email" id="email" name="email" class="validate" required aria-required="true" placeholder="" />
					<label for="email">Email</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="action">get password</button>
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