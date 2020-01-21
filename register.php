<?php $sq_number = [rand(1,100),rand(1,100),rand(1,100)] ?>
<html>
	<head>
		<?php head_init("css/style_register.css") ?>
	</head>
	<?php
	if (isset($_POST['sent'])) {
		// See if inputs aren't blank
		if ($_POST['username'] == "" || $_POST['password'] == "" || $_POST['passwordconfirm'] == "") {
			echo '<font class="error">Please fill in the input boxes.</font>';
			goto skipcheck;
		}
		// Security Question Check
		if ($_SESSION['result'] == $_POST['secque']) {
			// Success, continue.

			// Check username conflicts
			$usernamematches = result("SELECT COUNT(*) FROM users WHERE username = ?", [$_POST['username']]);
			if ($usernamematches) {
				echo '<font class="error">Username is already taken.</font>';
				goto skipcheck;
			}
			// Check passwords
			if ($_POST['password'] != $_POST['passwordconfirm']) {
				echo '<font class="error">The password and password confirm boxes aren\'t the same.</font>';
				goto skipcheck;
			}
			// MySQL stuff
			query("INSERT INTO users (username, nickname, password, powerlevel) VALUES (?, ?, ?, 1)", [$_POST['username'], $_POST['username'], $_POST['password']]);
			// RPG stuff
			query("INSERT INTO usersrpg (coinsperhour) VALUES (1)");
			
			// log in
			$_SESSION['loggedin'] = true;
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['password'] = $_POST['password'];
			$_SESSION['firsttime'] = true;

			?>
			<table>
				<tr>
					<td style="text-align: center;" bgcolor="#00ff00">
						You've registered successfully.<br>
						<button type="button" onclick="window.location.href = '/';">Click to continue.</button>
					</td>
				</tr>
			</table>
			<?php
			die();
		} else {
			// Fail.
			echo '<font class="error">Wrong <em>Security Question</em>&trade;&reg;&copy; answer.</font>';
		}
	}
	// Oh no the velociraptor will hunt me down!
	skipcheck:
	// How secure is this? :x
	$_SESSION['result'] = $sq_number[0] + $sq_number[1] + $sq_number[2];
	?>
	<body>
		<table>
			<tr>
				<td bgcolor="#00ff00">
					<span style="text-align:center;">Please fill out this form to register.</span>
					<form id="form" action="/register" method="post">
						<p>Username: <input type="text" id="username" name="username"></p>
						<p>Password: <input type="password" id="password" name="password"></p>
						<p>Confirm Password: <input type="password" id="passwordconfirm" name="passwordconfirm"></p>
						<p>Security Question: <input type="text" id="secque" name="secque">
						<input type="hidden" name="sent" value="true">
						<input type="submit" value="Register">
					</form>
					<br><p style="text-align:center;">You will be able to set your nickname when you log in for the first time.</p>
				</td>
				<td id="explain" style="vertical-align:top;" bgcolor="#ccccff">
					<p style="font-weight:bold;text-align:center;">Explanation</p>
					<span>Username - This is what you will be logging in with.</span><br>
					<span>Password - This is what you'll type in when you log in.</span><br>
					<span>Confirm Password - This is to check that you've entered your password correctly.</span><br>
					<span>Security Question - Enter the sum of <br><?=sprintf("%s + %s + %s",$sq_number[0],$sq_number[1],$sq_number[2]) ?></span>
				</td>
			</tr>
		</table>
		<a href="/">Go back to the login page.</a>
	</body>
</html>