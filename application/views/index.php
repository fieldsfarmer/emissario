<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<style>
	html, body {
		height: 100%;
	}
	#outer {
		height: 80%;
	}
	#outer::before {
		display: block;
		content: "";
		height: 15%;
	}
	#inner {
		width: 300px;
		margin: auto;
	}
</style>

<div id="outer" class="container center-align">
	<div id="inner" class="left-align">
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

		<table style="margin-top:40px; width:100%;">
			<tr>
				<td class="left-align" style="padding:0;">
					<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/reset">Forget Password</a>
				</td>
				<td class="right-align" style="padding:0">
					<a href="<?php echo URL_WITH_INDEX_FILE; ?>user/signUp">Create an Account</a>
				</td>
			</tr>
		</table>
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