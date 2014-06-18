<?php

// if (session_status() == PHP_SESSION_NONE) {

// 	echo "Session not started!!!!";
// 	session_start();
// 	$_SESSION["processes"] = "This is a test";

// }

echo date("Y-m-d H:i:s T") . "<br />";
echo date("Y-m-d\TH:i:s.uP") . "<br />";


$dt = new DateTime(date("Y-m-d\TH:i:s.uP"));

echo $dt->getOffset(). "<br />";