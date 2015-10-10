<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<div class="container" style="width:300px; margin:0;">
		<h4>Login</h4>
		<form method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>user/login" class="col s12">
			<div class="row">
				<div class="input-field col s12">
					<input type="email" id="email" name="email" class="validate" required aria-required="true" />
					<label for="email">Email</label>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12">
					<input type="password" id="password" name="password" class="validate" required aria-required="true" />
					<label for="password">Password</label>
				</div>
			</div>
			<button type="submit" class="btn waves-effect waves-light" name="action">Login</button>
		</form>
	</div>
</div>