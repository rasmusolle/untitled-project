<?php

/**
 * Echoes text as an error.
 * 
 * @param string $msg 
 */
function errorprint($msg = 'Undefined error.') {
	global $error;
	echo '<font class="error">' . $msg . '</font>';
	$error = true;
}

// Moved from /head.php.
function head_init($cssfile = null) {
	echo '<title>Untitled Project</title>';
	if (isset($cssfile)) {
		echo '<link rel="stylesheet" type="text/css" href="'.$cssfile.'">';
	}
	echo '<link rel="stylesheet" type="text/css" href="css/style.css">';
	// used to be 320 or 330 or 340 or whatever
	echo '<meta name="viewport" content="width=700">';
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
