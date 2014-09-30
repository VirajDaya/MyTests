<?php
// RAPID-1523_1 Second Change
// RAPID-1523_1 First Change after Changes from RAPID-1540_2, RAPID-1541_2 and RAPID-1542_2
// if (session_status() == PHP_SESSION_NONE) {

// 	echo "Session not started!!!!";
// 	session_start();
// 	$_SESSION["processes"] = "This is a test";

// }

echo date("Y-m-d H:i:s T") . "<br />";
echo date("Y-m-d\TH:i:s.uP") . "<br />";


$dt = new DateTime(date("Y-m-d\TH:i:s.uP"));

echo $dt->getOffset(). "<br />";
