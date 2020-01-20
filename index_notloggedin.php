<html>
	<head>
		<?php head_init("default","css/style_notloggedin.css") ?>
	</head>
	<?php
	if (isset($_POST['sent'])) {
		if (($_POST['username'] == "") || ($_POST['password'] == "")) {
			errorprint('Please fill in the input boxes.');
		} else {
			// Never trust user input! HTML tag checks aren't needed because it doesn't get printed.
			$username = mysqli_real_escape_string($mysqli, $_POST['username']);
			$password = mysqli_real_escape_string($mysqli, $_POST['password']);
			$db_query = $mysqli->query("SELECT * FROM users WHERE username = '" . $username	. "' AND password = '" . $password . "'");
			if (mysqli_num_rows($db_query) == 1) {
				$record = mysqli_fetch_array($db_query);
				if ($password == $record['password']) {
					?>
					<table><tr><td style="text-align: center;" bgcolor="#00ff00">
						You've been successfully logged in.<br>
						<button type="button" onclick="window.location.href = window.location.href;">Click to continue.</button>
					</td></tr></table>
					<?php
					$_SESSION['loginnew'] = true;
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					die();
				}
			} else {
				errorprint("Wrong credentials. Make sure you're using your username and not your nickname.");
			}
		}
	}
	?>
	<body>
		<table>
			<tr>
				<td style="text-align: center;" bgcolor="#ff3333">
					<p>Please log in using your Username and Password.</p>
					<form action="./" method="post">
						Username: <input type="text" id="username" name="username"><br>
						Password: <input type="password" id="password" name="password"><br>
						<input type="hidden" name="sent" value="true">
						<input type="submit" value="Login">
					</form>
					<p>Don't have an account? <a href="?register">Create one.</a></p>
				</td>
			</tr>
			<tr>
				<td style="text-align: center;" bgcolor="#ddccff">
					<a href="#">About</a> <a href="#">Cookie Information</a><!-- | <a href="#">Privacy Policy thingy</a>-->
				</td>
			</tr>
		</table>
	</body>
</html>