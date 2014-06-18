<?php

$sid = session_id();
// if($sid) {
if(session_status() == PHP_SESSION_NONE) {
	echo "Session exists!";
	session_start();
	echo "Process <br>" .  print_r( $_SESSION,true) . "<br>";
} else {
	session_start();
	echo "Session missing and started <br />";

	echo "Process <br>" .  print_r( $_SESSION,true) . "<br>";
}


