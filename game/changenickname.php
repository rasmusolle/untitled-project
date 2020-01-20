<style>
td { width: 380px; }
img { padding: 3px; }
</style>
<?php
if (isset($_POST['changeto'])) {
	if (strlen($_POST['changeto']) <= 30) {
		$userdata['nickname'] = $_POST['changeto'];
		$_POST['changeto'] = mysqli_real_escape_string($mysqli, $_POST['changeto']);
		SqlQuery("UPDATE `users` SET `nickname` = '" . $_POST['changeto'] . "' WHERE `users`.`username` = '{$_SESSION['username']}';");
		echo '<table><tr><td class="layout" style="background-color:#00ff00">Nickname successfully changed to "' . $_POST['changeto'] . '".</td></tr></table>';
	} else {
		echo '<table><tr><td class="layout" style="width:380px;background-color:#ff0000">Error - Nickname is too long.</td></tr></table>';
	}
}
if (isset($_GET['flag'])) {
	if (strlen($_GET['flag']) < 3) {
		$_GET['flag'] = mysqli_real_escape_string($mysqli, $_GET['flag']);
		SqlQuery("UPDATE `users` SET `country` = '" . $_GET['flag'] . "' WHERE `users`.`username` = '{$_SESSION['username']}';");
		echo '<table><tr><td class="layout" style="background-color:#00ff00">Flag successfully changed to <img src="static/flag/' . $_GET['flag'] . '.gif">.</td></tr></table>';
	} else {
		echo '<table><tr><td class="layout" style="width:380px;background-color:#ff0000">Error - Invalid flag.</td></tr></table>';
	}
}
?>
<table>
	<tr>
		<td class="layout" style="background-color:#ed86fe;width:380px;">
			<form target="_top" action="" method="post">
				Change nickname to:<br>
				<input name="changeto" type="text" maxlength=35 size=30 value="<?=$userdata['nickname'] ?>"></input>
				<input type="submit" value="Change"></input>
			</form>
			Maximum nickname length is 30 characters.<br>
			Your nickname is not the same as your username, you will still log in with your username.
		</td>
	</tr>
	<tr>
		<td class="layout" style="background-color:#ffa6ff;width:380px;">
			(Current flag: <img src="static/flag/<?=(isset($_GET['flag']) ? $_GET['flag'] : $userdata['country']) ?>.png">) 
			Change flag:<br>
<?php
foreach ($countries as $country) {
	printf('<a href="?show=443&flag=%s"><img src="static/flag/%s.png"></a>',$country,$country);
}
?>
		</td>
	</tr>
</table>