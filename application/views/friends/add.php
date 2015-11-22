<?php if (!$this) { exit(header('HTTP/1.0 403 Forbidden')); } ?>

<div class="container">
	<h2 class="page-header">New Friends</h2>

	<div class="form-horizontal">
		<div class="form-group">
			<label for="search" class="col-sm-2 control-label">Search by Name/Email</label>
			<div class="col-sm-3">
				<div class="input-group">
					<input type="text" id="search" name="search" class="form-control" />
					<span id="searchIcon" class="input-group-addon" style="cursor: pointer;">
						<i class="glyphicon glyphicon-search"></i>
					</span>
				</div>
			</div>
		</div>
	</div>

	<h3 class="page-header" style="margin-bottom: 10px;">Search Results</h3>
	<div class="table-responsive">
		<table id="searchResults" class="table table-striped">
			<thead>
				<tr>
					<th width="1%">&nbsp;</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>City</th>
					<th>State</th>
					<th>Country</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

	<h3 class="page-header" style="margin-bottom: 10px;">Selected Users</h3>
	<form id="form" method="post" action="<?php echo URL_WITH_INDEX_FILE; ?>friends/save" class="form-horizontal">
		<input type="hidden" id="userID" name="userID" value="<?php echo $userID ?>" />
		<input type="hidden" id="friendIDs" name="friendIDs" />

		<div class="table-responsive" style="margin-bottom: 30px;">
			<table id="selectedUsers" class="table table-striped">
				<thead>
					<tr>
						<th width="1%">&nbsp;</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>City</th>
						<th>State</th>
						<th>Country</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="button" id="cancel" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-default">Save</button>
			</div>
		</div>
	</form>
</div>

<script>
	$(document).ready(function(){
		$('#cancel').click(function(){
			window.location.href = '<?php echo URL_WITH_INDEX_FILE; ?>friends';
		});

		$('#searchIcon').click(searchPotentialFriends);

		jQuery('#search').keyup(function(e){
			if (e.keyCode == 13) {
				searchPotentialFriends();
			}
		});

		$.validator.addMethod('atLeastOne', function() {
			  return $('#selectedUsers').find('tbody tr').length > 0 ? true : false;
		}, 'Please select at least one user.');

		$('#form').validate({
			ignore: '',
			rules: {
				friendIDs: {
					atLeastOne: true
				}
			},
			errorPlacement: function (error, element) {
				error.insertAfter($('#selectedUsers'));
			},
			highlight: function(element) {
				$('#selectedUsers').closest('.table-responsive').removeClass('has-success').addClass('has-error');
			},
			unhighlight: function(element) {
				$('#selectedUsers').closest('.table-responsive').removeClass('has-error').addClass('has-success');
			}
		});

		$('#form').submit(function() {
			var friendIDs = '';
			$('#selectedUsers').find('.potentialFriendID').each(function() {
				friendIDs = friendIDs + ',' + $(this).val();
			});
			if (friendIDs.substr(0,1) == ',') {
				friendIDs = friendIDs.substr(1);
			}

			$('#friendIDs').val(friendIDs);
		});
	});

	searchPotentialFriends = function() {
		$.ajax({
			url: '<?php echo URL_WITH_INDEX_FILE; ?>friends/searchPotentialFriends',
			type: 'post',
			data: {
				search: $('#search').val()
			},
			dataType: 'text',
			success: function(result) {
				potentialFriends = $.parseJSON(result);

				$('#searchResults').find('tbody').empty();

				for (var i = 0; i < potentialFriends.length; i++) {
					tr = $('<tr></tr>');

					span = $('<span style="cursor:pointer; display:inline-block; padding:0 5px;"><i class="glyphicon glyphicon-plus"></i></span>');
					span.click(addSelected);

					friendIDField = $('<input type="hidden" class="potentialFriendID" />')
					friendIDField.val(potentialFriends[i].ID);

					tdAction = $('<td width="1%"></td>');
					tdAction.append(span);
					tdAction.append(friendIDField);

					tr.append(tdAction);
					tr.append('<td>' + potentialFriends[i].First_Name + '</td>');
					tr.append('<td>' + potentialFriends[i].Last_Name + '</td>');
					tr.append('<td>' + getValueForDisplay(potentialFriends[i].City) + '</td>');
					tr.append('<td>' + getValueForDisplay(potentialFriends[i].State) + '</td>');
					tr.append('<td>' + getValueForDisplay(potentialFriends[i].Country) + '</td>');

					$('#searchResults').find('tbody').append(tr);
				}
			}
		});
	}

	getValueForDisplay = function(value) {
		return value == null ? '' : value;
	}

	addSelected = function() {
		var resultRow = $(this).closest('tr');
		var friendID = resultRow.find('input.potentialFriendID').val();

		/* Ensure user has not been added to the selected table */
		var valid = true;
		$('#selectedUsers').find('input.potentialFriendID').each(function() {
			if ($(this).val() == friendID) {
				valid = false;
				return false;
			}
		});

		/* Add user to selected table */
		if (valid) {
			/* Create a copy of the row */
			var tr = resultRow.clone();
			var tdAction = tr.find('i.glyphicon-plus');

			/* Remove add icon */
			tr.find('i.glyphicon-plus').closest('span').remove();

			/* Add delete icon */
			span = $('<span style="cursor:pointer; display:inline-block; padding:0 5px;"><i class="glyphicon glyphicon-remove"></i></span>');
			span.click(removeSelected);
			span.insertBefore(tr.find('input.potentialFriendID'));

			/* Add row to chart data */
			$('#selectedUsers').find('tbody').append(tr);

			/* Remove validation message if any */
			$('#friendIDs-error').remove();
		}
	}

	removeSelected = function() {
		$(this).closest('tr').remove();
	}
</script>