<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); }

if (is_numeric($wishID))
{
	$title = "Edit Wish";
	$cancelURL = URL_WITH_INDEX_FILE . "wishes/view/" . $wishID;
}
else
{
	$title = "New Wish";
	$cancelURL = URL_WITH_INDEX_FILE . "wishes";
}
?>

<div class="container">
	<h4><?php echo $title; ?></h4>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>wishes/save" class="col s12" novalidate="novalidate">
		<input type="hidden" id="userID" name="wishID" value="<?php echo $wishID ?>" />
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />

		<div class="row">
			<div class="input-field col s12">
				<textarea id="description" name="description" class="materialize-textarea validate" required aria-required="true" placeholder=""><?php echo $wish->Description ?></textarea>
				<label for="description">Description</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="destinationCity" name="destinationCity" value="<?php echo $wish->Destination_City ?>" placeholder="" />
				<label for="destinationCity">Destination City</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="destinationCountry" name="destinationCountry" value="<?php echo $wish->Destination_Country ?>" placeholder="" />
				<label for="destinationCountry">Destination Country</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input type="text" id="weight" name="weight" value="<?php echo $wish->Weight ?>" placeholder="" />
				<label for="weight">Weight</label>
			</div>
			<div class="input-field col s6">
				<input type="text" id="maxDate" name="maxDate" value="<?php echo $wish->Formatted_Max_Date ?>" class="datepicker validate" placeholder="" />
				<label for="maxDate">Max Date</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="text" id="compensation" name="compensation" value="<?php echo $wish->Compensation ?>" placeholder="" />
				<label for="compensation">Compensation</label>
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

		$('.datepicker').pickadate({
			format: 'mm/dd/yyyy'
		});

		$('#form').validate({
			rules: {
				maxDate: {
					date: true
				}
			}
		});
	});
</script>