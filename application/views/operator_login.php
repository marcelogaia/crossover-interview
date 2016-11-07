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
			<h3>Operator Login</h3>
			<form action="" method="POST">
				<input type="hidden" name="user_type" value="O"> 
				<p>
					<label for="name">Name</label>
					<input type="text" name="username" class="form-control">
				</p>
				<p>
					<label for="passcode">Pass Code</label>
					<input type="password" id="passcode" name="password" class="form-control">
				</p>

				<button type="submit" class="btn btn-default">Log in</button>
			</form>
		</div>
	</div>
</body>
</html>