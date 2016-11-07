<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Crossover - Reports</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="<?= site_url('public/css/default.css')?>">
</head>
<body class="login">
 	<div class="container-fluid">
 		<div class="ui-widget">
 			<h3>Patient Login</h3>
 			<form action="login" method="POST">
 				<input type="hidden" name="user_type" value="P"> 
 				<p>
 					<input type="hidden" value="2" name="user_id" id="user_id">
 					<label for="name">Patient name: </label>
 					<input type="text" id="name" autocomplete="off" class="form-control">
 				</p>
 				<p>
 					<label for="passcode">Pass Code: </label>
 					<input type="text" id="passcode" name="password" class="form-control">
 				</p>
 				<button type="submit" class="btn btn-default">Log in</button>
 			</form>
 		</div>
 	</div>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$(function(){
			$("#name").autocomplete({
				source: "login/patient/list_ajax",
				minLength: 2,
				select: function( event, ui ) {
					$('#user_id').val(ui.item.id);
				}
			});
		})
	</script>
</body>
</html>