<link rel="stylesheet" type="text/css" href="css/game_shop.css">
<?php
if (isset($_GET['category'])) {
	?>
	<table style="font-family:arial;">
		<tr>
			<th>Name</th>
			<th>Description</th>
			<th>HP</th>
			<th>MP</th>
			<th>Atk</th>
			<th>Def</th>
			<th>Spd</th>
			<th>Int</th>
			<th>Lck</th>
			<th>Coins</th>
			<th>Stars</th>
		</tr>
		<?php
		// $_GET['category'] is user-inputted. Check so it's an int.
		if (!is_numeric($_GET['category'])) $_GET['category'] = 0;
		$query = query("SELECT * FROM items WHERE category = ?", [$_GET['category']]);
		while ($record = $query->fetch()) {
			?>
			<tr>
				<td><?=$record['itemname'] ?></td>
				<td><?=$record['itemdesc'] ?></td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>
				<td><?=$record['coins'] ?></td>
				<td><?=$record['stars'] ?></td>
			</tr>
			<?php
		}
		?>
	</table>
<?php } else { ?>
	<table>
		<tr>
			<th class="menu">
				<a href="?show=3&category=1">Weapons</a>
			</th>
			<td class="menu">
				Currently equipped: <b>Generic Sword</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=2">Armor</a>
			</th>
			<td class="menu">
				Currently equipped: <b>Chainmail Armor</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=3">Sheilds</a>
			</th>
			<td class="menu">
				Currently equipped: <b>Frozen Pizza</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=4">Helmets</a>
			</th>
			<td class="menu">
				Currently equipped: <b>Tinfoil Hat</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=5">Boots</a>
			</th>
			<td class="menu">
				Currently equipped: <b>Boots with crispbread</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=6">Accessories</a>
			</th>
			<td class="menu">
				Currently equipped: <b>iPad&reg;</b>
			</td>
		</tr>
		<tr>
			<th class="menu">
				<a href="?show=3&category=-1">Other Items</a>
			</th>
			<td class="menu">
				Come in - we got candy!
			</td>
		</tr>
		
	</table>
<?php } ?>