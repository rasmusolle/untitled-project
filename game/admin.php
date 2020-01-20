<?php
if ($userdata['powerlevel'] < 2) {
	die('What are you trying to do here? This is <b>ADMIN SPACE</b>, you know?');
}
if ((isset($_GET['a']) ? $_GET['a'] : (isset($_POST['a']) ? $_POST['a'] : false))) {
	switch ((isset($_GET['a']) ? $_GET['a'] : $_POST['a'])) {
		case 'chatclear':
			SqlQuery("TRUNCATE TABLE chat;");
			echo '<font color=blue>Chat has been cleared successfully.</font>';
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
					$db_query = SqlQuery("SELECT * FROM users");
					
					while ($record = mysqli_fetch_array($db_query)) {
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