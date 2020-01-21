<?php
if (isset($_POST['text'])) {
	$_POST['text'] = htmlspecialchars($_POST['text']);

	query("INSERT INTO chat (userID, message, device, IP, time) VALUES (?, ?, 'browser', ?, ?)", [$userdata['userID'], $_POST['text'], $_SERVER['REMOTE_ADDR'], time()]);
}
if (isset($_POST['servicemessagetext'])) {
	$_POST['servicemessagetext'] = htmlspecialchars($_POST['servicemessagetext']);
	if ($userdata['powerlevel'] > 1)
		query("INSERT INTO chat (userID, message, device, IP, time) VALUES (0, ?, 'null', ?, ?)", [$_POST['servicemessagetext'], $_SERVER['REMOTE_ADDR'], time()]);
}
?>
<link rel="stylesheet" type="text/css" href="css/game_chat.css">
<a href="#bottom">Go to the bottom.</a>
<table>
<?php
$query = query("SELECT * FROM chat JOIN users ON chat.userID = users.userID");
$temp = 0;
while ($record = $query->fetch()) {
	?>
	<tr>
		<td bgcolor="#eeeeee">
			<?php if ($record['userID'] == 0) { ?>
				<img src="/static/device/service.svg">
			<?php } else { ?>
				<img src="/static/device/<?=$record['device'] ?>.png" width="16" height="16">
				<img src="/static/flag/<?=$record['country'] ?>.png">
			<?php }
			
			// Smiley ####
			$record['message'] = str_replace(':)',		'<img src="static/smileys/smile.png">', $record['message']);
			$record['message'] = str_replace(':|',		'<img src="static/smileys/neutral.png">', $record['message']);
			$record['message'] = str_replace(':(',		'<img src="static/smileys/frown.png">', $record['message']);
			$record['message'] = str_replace(';)',		'<img src="static/smileys/wink.png">', $record['message']);
			$record['message'] = str_replace(':D',		'<img src="static/smileys/laughter.png">', $record['message']);
			$record['message'] = str_replace(':O',		'<img src="static/smileys/suprised.png">', $record['message']);
			$record['message'] = str_replace(":'(",		'<img src="static/smileys/sob.png">', $record['message']);
			$record['message'] = str_replace(':/',		'<img src="static/smileys/unsure.png">', $record['message']);
			$record['message'] = str_replace(':sick:',	'<img src="static/smileys/sick.png">', $record['message']);
	 		
			?>
			<span style="color:<?=powerlevelcolor($record['powerlevel']) ?>;"><?=$record['nickname'] ?></span>: <?=$record['message'] ?> <br> 
			<span style="color:maroon"> <em>(<?=time() - $record['time'] ?> seconds ago)</em> <?php if ($userdata['powerlevel']) echo '(IP: ' . $record['IP'] . ')' ?></span>
		</td>
	</tr>
	<?php
	$temp++;
}
if ($temp == 0) {
	?>
	<tr>
		<td bgcolor="#eeeeee">
			<img src="/static/device/service.svg">
			<font color="purple">Service Message</font>: There are no messages since last chat reset.
		</td>
	</tr>
	<?php
}
?>
</table>
<span id="bottom"></span>
<?php if ($userdata['powerlevel'] != 0) { ?>
	<form id="form" action="?show=2" method="post">
		<p><input type="text" id="text" name="text"><input type="submit" value="Send"></p>
	</form>
<?php
} else {
	echo '<strong>You\'ve been banned from the chat.</strong>';
}
if ($userdata['powerlevel'] > 1) {
	?>
	<table>
		<tr>
			<td class="layout" bgcolor="#ff0000" style="padding:10px;">
				<p>Post Service Message</p>
				<form id="form" action="?show=2" method="post">
					<input type="text" id="servicemessagetext" name="servicemessagetext"><input type="submit" value="Send">
				</form>
				<a href="?show=1337">Go to the admin page.</a>
			</td>
		</tr>
	</table>
	<?php
}
?>