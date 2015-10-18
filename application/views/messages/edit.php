<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }
	$title = "New Message";
	$cancelURL = URL_WITH_INDEX_FILE . "messages";
?>

<div class="container">
	<h4><?php echo $title; ?></h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>messages/save" class="col s12" novalidate="novalidate">
		<input type="hidden" id="userID" name="travelID" value="<?php echo $travelID ?>" />
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="messageReceiver" name="messageReceiver" value="" class="datepicker validate" required aria-required="true" placeholder="" />
				<label for="messageReceiver">Message receiver</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="messageTitle" name="messageTitle" value="" required aria-required="true" placeholder="" />
				<label for="messageTitle">Message title</label>
			</div>
		</div>		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="messageContent" name="messageContent" value="" class="validate" required aria-required="true" placeholder="" />
				<label for="messageContent">Message content</label>
			</div>
		</div>
		<a id="cancel" class="btn waves-effect waves-light">Cancel</a>
		<button type="submit" class="btn waves-effect waves-light" name="action">Save</button>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo $cancelURL; ?>';
		});

		$('select').material_select();


		$('#form').validate({
			rules: {
				travelDate: {
					date: true
				}
			}
		});
	});
</script>