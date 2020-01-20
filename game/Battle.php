<?php

if (!isset($_SESSION['inbattle']) || !$_SESSION['inbattle']) {
	$_SESSION['inbattle'] = true;
	$names = [
		"Needle",
		"A zombie",
		"A mutated stone"
	];
	$_SESSION['name'] = $names[array_rand($names)];
	$_SESSION['HP'] = rand(10,20);
	$_SESSION['HPmax'] = $_SESSION['HP'];
	$_SESSION['MP'] = rand(4,7);
	$_SESSION['MPmax'] = $_SESSION['MP'];
	$_SESSION['attack'] = rand(20,50);
	$_SESSION['defense'] = rand(20,50);
	$_SESSION['speed'] = rand(20,50);
	$_SESSION['intelligence'] = rand(20,50);
	$_SESSION['luck'] = rand(20,50);
	echo "<strong>Oh no! " . $_SESSION['name'] . " is blocking the way!</strong><br>";
} else {
	if (isset($_GET['action'])) {
	switch ($_GET['action']) {
		case 'atk':
			switch ($_GET['atktype']) {
				case 1:
					echo 'Debug - prevEnemyHP = ' . $_SESSION['HP'] . '<br>';
					$_SESSION['HP'] = $_SESSION['HP'] - (round($userrpgdata['attack'] / 5,0));
				break;
				case 2:
					echo 'Debug - ';
				break;
			}
		break;
		
		case 'flee':
			$_SESSION['fleelost'] = rand(100,200);
			if ($_SESSION['fleelost'] > $userrpgdata['coins']) {
				$_SESSION['fleelost'] = $userrpgdata['coins'];
			}
			echo '<meta http-equiv="refresh" content="0; url=/">';
			echo '<a href="/">Not being redirected?</a>';
			die();
		break;
	}
	}
}

?>

What to do?<br><br>
<div class="box" style="width:400px;">
	<table style="width:100%">
		<tr><td>Your stats:</td><td>Your enemy's stats:</td></tr>
		<tr>
			<td style="width:50%">
				<table>
					<tr>
						<th class="right">HP</th>
						<td><?=$userrpgdata['HP'] ?>/<?=$userrpgdata['HPmax'] ?></td>
					</tr>
					<tr>
						<th class="right">MP</th>
						<td><?=$userrpgdata['MP'] ?>/<?=$userrpgdata['MPmax'] ?></td>
					</tr>
				</table>
				<hr>
				<table>
					<tr>
						<th class="right">Atk</th>
						<td><?=$userrpgdata['attack'] ?></td>
					</tr>
					<tr>
						<th class="right">Def</th>
						<td><?=$userrpgdata['defense'] ?></td>
					</tr>
					<tr>
						<th class="right">Spd</th>
						<td><?=$userrpgdata['speed'] ?></td>
					</tr>
					<tr>
						<th class="right">Int</th>
						<td><?=$userrpgdata['intelligence'] ?></td>
					</tr>
					<tr>
						<th class="right">Lck</th>
						<td><?=$userrpgdata['luck'] ?></td>
					</tr>
				</table>
			</td>
			<td style="width:50%">
				<table style="">
					<tr>
						<th class="right">HP</th>
						<td><?=$_SESSION['HP'] ?>/<?=$_SESSION['HPmax'] ?></td>
					</tr>
					<tr>
						<th class="right">MP</th>
						<td><?=$_SESSION['MP'] ?>/<?=$_SESSION['MPmax'] ?></td>
					</tr>
				</table>
				<hr>
				<table>
					<tr>
						<th class="right">Atk</th>
						<td><?=$_SESSION['attack'] ?></td>
					</tr>
					<tr>
						<th class="right">Def</th>
						<td><?=$_SESSION['defense'] ?></td>
					</tr>
					<tr>
						<th class="right">Spd</th>
						<td><?=$_SESSION['speed'] ?></td>
					</tr>
					<tr>
						<th class="right">Int</th>
						<td><?=$_SESSION['intelligence'] ?></td>
					</tr>
					<tr>
						<th class="right">Lck</th>
						<td><?=$_SESSION['luck'] ?></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div><br>
<div class="box" style="width:400px; text-align:center;">
	<p>Actions...</p>
	<a class="btn btn-primary" href="?show=4&action=atk&atktype=1">Attack</a>
	<a class="btn btn-primary" href="?show=4&action=atk&atktype=2">Magic</a>
	<a class="btn btn-primary" href="?show=4&action=atk&atktype=3">Special</a>
	<a class="btn btn-primary" href="?show=4&action=items">Items</a>
	<a class="btn btn-primary" href="?show=4&action=flee">Flee</a><br>
	<span>(Please don't escape through closing your browser!)</span>
</div>