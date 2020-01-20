<?php

/**
 * Turns a given ID into the user's username.
 * Keep in mind this function doesn't check that the ID exists, so please make sure it exists.
 *
 * <big><b>THIS IS NOT THE SAME AS IDtoNickname()!</b></big>
 *
 * @param int $ID ID to check.
 * @return string the username of the ID.
 */
function IDtoUsername($ID) {
	// Dirty hack for service messages.
	if ($ID == 0) return '<span style="color:purple;">Service Message</span>';
	$temp = SqlQueryFetchRow("SELECT * FROM users WHERE userID={$ID}");
	return $temp['usernamename'];
}

/**
 * Turns a given ID into the user's nickname.
 * Keep in mind this function doesn't check that the ID exists, so please make sure it exists.
 *
 * <big><big><big><big><b>THIS IS NOT THE SAME AS IDtoUsername()!</b></big></big></big></big>
 *
 * @param int $ID ID to check.
 * @return string the nickname of the ID.
 */
function IDtoNickname($ID) {
	// Dirty hack for service messages.
	if ($ID == 0) return '<span style="color:purple;">Service Message</span>';
	$temp = SqlQueryFetchRow("SELECT * FROM users WHERE userID={$ID}");
	return $temp['nickname'];
}

/**
 * Get the color of a powerlevel .
 *
 * @param int $pow Powerlevel
 * @return string Hex code of the powerlevel.
 */
function powerlevelcolor($pow) {
	switch ($pow) {
		case 0: return '#888888';
		case 1: return '#0000FF';
		case 2: return '#C762F2;';
		case 3: return '#cc0000';
	}
}
