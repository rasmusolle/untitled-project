<?php
if ($userdata['powerlevel'] < 2) {
	die('What are you trying to do here? This is <b>ADMIN SPACE</b>, you know?');
}
if ((isset($_GET['a']) ? $_GET['a'] : (isset($_POST['a']) ? $_POST['a'] : false))) {
	switch ((isset($_GET['a']) ? $_GET['a'] : $_POST['a'])) {
		case 'chatclear':
			query("TRUNCATE TABLE chat");
			echo '<span class="starclr">Chat has been cleared successfully.</span>';
		break;
		case 'banuser':
			echo 'Coming soon!';
		break;
	}
}
echo $_SERVER['REQUEST_URI'];
?>
<style><?php include('css/admin.css') ?></style>
<hr>
<p><a href="&a=chatclear">Clear the chat from messages.</a></p>
<table>
	<tr>
		<td bgcolor="#eeeeee">
			<form id="banform" action="?show=1337" method="post">
				<input type="hidden" name="a" value="banuser">
				Ban <select name="user">
					<?php
					$query = query("SELECT * FROM users");
					while ($record = $query->fetch()) {
						echo '<option value="' . $record['userID'] . '">' . $record['nickname'] . ' (ID: ' . $record['userID'] . ')</option>';
					}
					?>
				</select><br>
				For <input type="number" name=""> minute(s).<br>
				<input type="submit" value="Send">
			</form>
		</td>
	</tr>
</table>
<a href="accLog.php">accesslog</a>