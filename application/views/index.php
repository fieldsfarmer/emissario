<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<div class="container" style="width:300px; margin:0 0 40px 0;">
		<h4>Login</h4>
		<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/login" class="col s12" novalidate="novalidate">
			<div class="row">
				<div class="input-field col s12">
					<input type="email" id="email" name="email" class="validate" required aria-required="true" placeholder="" />
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" id="password" name="password" class="validate" required aria-required="true" placeholder="" />
					<label for="password">Password</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="action">Login</button>
		</form>
	</div>
	<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/signUp">Create an Account</a>
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