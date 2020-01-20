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
function head_init($style = 'default', $cssfile = null) {
	echo '<title>Untitled Project</title>';
	if (isset($cssfile)) {
		echo '<style>';
		include($cssfile);
		echo '</style>';
	}
	echo '<style>';
	include('css/style.css');
	echo '</style>';
	// used to be 320 or 330 or 340 or whatever
	echo '<meta name="viewport" content="width=700">';
}
