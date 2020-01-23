<?php
?>
<style>
/* table tweaks - make a th element be right-aligned */
th.right {
	text-align: right;
}
/* abbr fixes. */
abbr {
	text-decoration: underline;
}
</style>
<?php if ($_SESSION['loginnew']) { ?>
	<p style="color:blue;padding-top:0;">Welcome back! You've gotten <?=round($coinearnamount, 2) ?> coins since your last visit!</p>
<?php } ?>
Welcome <span style="color: <?=powerlevelcolor($userdata['powerlevel']) ?>"><?=$userdata['nickname'] ?></span>.
<a href="?show=443" style="color:darkpink;text-decoration:none;">(change nickname)</a>
<br><br>Your stats:<br>
<div class="box">
	<table>
		<tr>
			<th class="right">Coins</th>
			<td><?=round($userrpgdata['coins'], 2) ?></td>
		</tr>
		<tr>
			<th class="right">*</th>
			<td><?=$userrpgdata['stars'] ?></td>
		</tr>
	</table>
	<hr>
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
			<th class="right"><abbr title="Attack (Strength)">Atk</abbr></th>
			<td><?=$userrpgdata['attack'] ?></td>
		</tr>
		<tr>
			<th class="right"><abbr title="Defense">Def</abbr></th>
			<td><?=$userrpgdata['defense'] ?></td>
		</tr>
		<tr>
			<th class="right"><abbr title="Speed">Spd</abbr></th>
			<td><?=$userrpgdata['speed'] ?></td>
		</tr>
		<tr>
			<th class="right"><abbr title="Intelligence">Int</abbr></th>
			<td><?=$userrpgdata['intelligence'] ?></td>
		</tr>
		<tr>
			<th class="right"><abbr title="Luck">Lck</abbr></th>
			<td><?=$userrpgdata['luck'] ?> <span style="color:darkred"><abbr title="You've won the latest Lottery drawings.">(0.5x)</abbr></span></td>
		</tr>
	</table>
</div>&nbsp;
<div class="box">
	Items:
	<ul>
		<li>MP Restorer (x3)</li>
		<li></li>
	</ul>
</div>
<br>Coins per hour: <?=$userrpgdata['coinsperhour'] ?>