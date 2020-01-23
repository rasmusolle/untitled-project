<?php
if (isset($_POST['buystars'])) {
	if ($_POST['quantity'] < ($userdata['coins'] / $_POST['value'])) {
		$userdata['coins'] = $userdata['coins'] - ($_POST['quantity'] * $_POST['value']);
		$userdata['stars'] = $userdata['stars'] +  $_POST['quantity'];
		query("UPDATE users SET coins = ?, stars = ? WHERE userID = ?", [$userdata['coins'], $userdata['stars'], $userdata['userID']]);
		echo 'Bought ' . $_POST['quantity'] . ' stars at a rate of ' . $_POST['value'] . ' Coins / Star';
	} else {
		errorprint('Not enough coins to complete this action.');
	}
}
if (isset($_POST['sellstars'])) {
	if ($_POST['quantity'] < $userdata['stars']) {
		$userdata['coins'] = $userdata['coins'] + ($_POST['quantity'] * $_POST['value']);
		$userdata['stars'] = $userdata['stars'] -  $_POST['quantity'];
		query("UPDATE users SET coins = ?, stars = ? WHERE userID = ?", [$userdata['coins'], $userdata['stars'], $userdata['userID']]);
		echo 'Sold ' . $_POST['quantity'] . ' stars at a rate of ' . $_POST['value'] . ' Coins / Star';
	} else {
		errorprint('Not enough stars to complete this action.');
	}
}
if ($error) echo '<br>';
?>
<link rel="stylesheet" type="text/css" href="/css/game_exchange.css">

<b>Stars Exchange</b><br>
<b>Stars: <span class="starclr">* <?=round($userdata['stars'], 2) ?></span></b><br>
<b>Coins: <span style="coinclr"> <?=round($userdata['coins'], 2) ?></span></b><br><br>

<table>
	<tr>
		<td class="layout buyclr">
			<h3>Place BUY <span class="starclr">Stars</span> order. Using coins.</h3><br>
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
			<h3>Place SELL <span class="starclr">Stars</span> order. To get coins.</h3><br>
			<form target="_top" action="" method="post">
				<input type="hidden" name="sellstars" value="true">
				<input type="hidden" name="value" value="302">
				Sell quantity: <input name="quantity" type="text" value="10">
				<br> @ price: 238 Coins each<br><br><br>
				<input type="submit" value="Place Sell Order"><br>
			</form>
		</td>
	</tr>
</table>