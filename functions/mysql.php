<?php
$mysqli = new mysqli($host, $user, $pass, $db);
// Set charset to utf8
mysqli_set_charset($mysqli, 'utf8');

// Oh no! A connect_errno exists so the connection attempt failed!
if ($mysqli->connect_errno) {
	echo "Sorry, but we're currently experiencing problems. Please come back later.";
	exit;
}

$sqldebug = 1;

function SqlQuery($query) {
	global $mysqli, $sqldebug;
	
	$res = $mysqli->query($query);
	if (!$res) {
		print "<strong>MySQL error</strong>: ".$mysqli->error;
		if ($sqldebug) print " @ ".$query;
		print "<br>";
	}
	
	return $res;
}

function SqlFetchRow($res) {
	if (!$res) return NULL;
	if ($res->num_rows <= 0) return NULL;
	
	$ret = $res->fetch_assoc();

	return $ret;
}

function SqlQueryFetchRow($query) {
	return SqlFetchRow(SqlQuery($query));
}

function SqlQueryResult($query, $col = 0) {
	$res = SqlQuery($query);
	if (!$res) return NULL;
	if ($res->num_rows <= 0) return NULL;
	
	$ceva = array_values($res->fetch_assoc());
	$rasp = $ceva[$col];
	return $rasp;
}

function SqlNumRows($res) {
	if (!$res) return 0;
	return $res->num_rows;
}

function SqlEscape($val) { global $dblink; return $dblink->real_escape_string($val); }

function SqlInsertId() { global $dblink; return $dblink->insert_id; }

?>