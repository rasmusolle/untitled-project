<?php
session_start();

$start = microtime(true);

require("config.php");
require("functions/functions.php");
require("functions/mysql.php");

if (isset($_SESSION['loggedin'])) {
	include("index_game.php");
} else {
	if (!isset($_GET['register'])) {
		include("index_notloggedin.php");
	} else {
		include("register.php");
	}
}
?>