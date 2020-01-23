<?php
$userdata = fetch("SELECT * FROM users WHERE username = ?", [$_SESSION['username']]);

if (isset($_GET['logout'])) {
	session_destroy();
	die('You\'ve been logged out.<br><a href="/">Go to the login page.</a>');
}

if ($userdata['bantime'] >=  time()) {
	query("UPDATE users SET bantime = '0' WHERE userID = ?", [$userdata['userID']]);
	$userdata['bantime'] = 0;
}

if ($userdata['bantime'] >= 1) {
	$userdata['powerlevel'] = 0;
}

$cphDbg = false;

$coinearntime = time() - $userdata['lastview'];
if ($cphDbg)
	echo $coinearntime . '<br>';
$coinearnamount = $coinearntime * ($userdata['coinsperhour'] / 3600);
if ($cphDbg)
	echo $coinearnamount;
query("UPDATE users SET coins = ?, lastview = ? WHERE userID = ?", [($userdata['coins'] + $coinearnamount), time(), $userdata['userID']]);

?>
<html>
	<head>
		<?php head_init('css/game.css') ?>
		<link rel="stylesheet" type="text/css" href="css/bootstrap-btn.css">
	</head>
	<body>
		<?php if (isset($_SESSION['firsttime']) && $_SESSION['firsttime'] == true) { ?>
			<table><tr>
				<td class="layout w400" bgcolor="#00ff00" style="padding:10px;">
					<p>Welcome to Untitled Project!</p>
				</td>
			</tr></table>
			<?php $_SESSION['firsttime'] = false;
		}
		if (isset($_SESSION['fleelost'])) { ?>
			<table>
				<tr>
					<td class="layout w400" bgcolor="#00ff00" style="padding:10px;">
						<p>You fled successfully, but you lost <?=$_SESSION['fleelost'] ?> Coins while fleeing.</p>
					</td>
				</tr>
			</table><?php
			$userdata['coins'] = $userdata['coins'] - $_SESSION['fleelost'];
			query("UPDATE users SET coins = ? WHERE userID = ?", [$userdata['coins'], $userdata['userID']]);
			unset($_SESSION['fleelost']);
		}
		// If there's no get request found, you just logged in so set it to 1.
		if (!isset($_GET['show'])) {
			$_GET['show'] = 1;
			$loggedin = true;
		}
		if ($_GET['show'] != 4) { ?>
		<nav>
				<a class="btn btn-primary" href="./">Home</a>
				<a class="btn btn-primary" href="?show=4">Battle</a>
				<a class="btn btn-primary" href="?show=3">Shop</a>
				<a class="btn btn-primary" href="?show=2">More</a>
				<a class="btn btn-primary" href="?show=999">Star Exchange</a>
				<a class="btn btn-primary" href="help/">Help</a>
		</nav><br>
		<?php }
		switch ($_GET['show']) {
			case 1:
				include('game/1.php');
			break;
			case 2:
				include('game/chat.php');
				break;
			case 3:
				include('game/shop.php');
				break;
			case 4:
				include('game/battle.php');
				break;
			case 999:
				include('game/StarsExchange.php');
			break;
			case 1337:
				include('game/admin.php');
			break;
			case 443:
				include('game/changenickname.php');
			break;
			default:
				echo 'Invalid page.';
			break;
		}
		?>
		<br><br><br>
		<hr>
		<a href="?logout">Log out</a><br>
		<?php
		$render = (microtime(true) - $start);
		printf("Page created in %.6f seconds using %.03f KB of RAM.", $render, memory_get_usage() / 1024);
		?>
		<br>
	</body>
</html>
<?php
if ($_SESSION['loginnew'])
	$_SESSION['loginnew'] = false;
?>