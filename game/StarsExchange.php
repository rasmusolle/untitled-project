<?php
if (isset($_POST['buystars'])) {
	if ($_POST['quantity'] < ($userrpgdata['coins'] / $_POST['value'])) {
		$userrpgdata['coins'] = $userrpgdata['coins'] - ($_POST['quantity'] * $_POST['value']);
		$userrpgdata['stars'] = $userrpgdata['stars'] +  $_POST['quantity'];
		SqlQuery("UPDATE `usersrpg` SET `coins` = '" . $userrpgdata['coins'] . "' WHERE `usersrpg`.`userID` = " . $userdata['userID'] . ";");
		SqlQuery("UPDATE `usersrpg` SET `stars` = '" . $userrpgdata['stars'] . "' WHERE `usersrpg`.`userID` = " . $userdata['userID'] . ";");
		echo 'Bought ' . $_POST['quantity'] . ' stars at a rate of ' . $_POST['value'] . ' Coins / Star';
	} else {
		errorprint('Not enough coins to complete this action.');
	}
}
if (isset($_POST['sellstars'])) {
	if ($_POST['quantity'] < $userrpgdata['stars']) {
		$userrpgdata['coins'] = $userrpgdata['coins'] + ($_POST['quantity'] * $_POST['value']);
		$userrpgdata['stars'] = $userrpgdata['stars'] -  $_POST['quantity'];
		SqlQuery("UPDATE `usersrpg` SET `coins` = '" . $userrpgdata['coins'] . "' WHERE `usersrpg`.`userID` = " . $userdata['userID'] . ";");
		SqlQuery("UPDATE `usersrpg` SET `stars` = '" . $userrpgdata['stars'] . "' WHERE `usersrpg`.`userID` = " . $userdata['userID'] . ";");
		echo 'Sold ' . $_POST['quantity'] . ' stars at a rate of ' . $_POST['value'] . ' Coins / Star';
	} else {
		errorprint('Not enough stars to complete this action.');
	}
}
if ($error) echo '<br>';
?>
<link rel="stylesheet" type="text/css" href="/css/game_exchange.css"/>

<b>Stars Exchange</b><br>
<b>Stars: <font color="blue">* <?=round($userrpgdata['stars'], 2) ?></font></b><br>
<b>Coins: <span style="color:#ffc800"> <?=round($userrpgdata['coins'], 2) ?></span></b><br><br>

<table>
	<tr>
		<td class="layout buyclr">
			<h3>Place BUY <font color="blue">Stars</font> order. Using coins.</h3><br>
			<form target="_top" action="" method="post">
				<input type="hidden" name="buystars" value="true">
				<input type="hidden" name="value" value="302">
				Buy quantity: <input name="quantity" type="text" value="10">
				<br> @ price: 302 Coins each<br><br><br>
				<input type="submit" value="Place Buy Order">
			</form>
		</td>
	</tr>
	<tr>
		<td class="layout sellclr">
			<h3>Place SELL <font color="blue">Stars</font> order. To get coins.</h3><br>
			<form target="_top" action="" method="post">
				<input type="hidden" name="sellstars" value="true">
				<input type="hidden" name="value" value="302">
				Sell quantity: <input name="quantity" type="text" value="10">
				<br> @ price: 238 Coins each<br><br><br>
				<input type="submit" value="Place Sell Order"><br />
			</form>
		</td>
	</tr>
</table>