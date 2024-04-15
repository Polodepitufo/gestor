<?php

	$dbhost="185.224.137.55";
	$dbusuario="u888194751_gestoruser";
	$dbpassword="F@_hOs93Le9!bE4";
	$nombredb="u888194751_gestor";
	$db = mysqli_connect($dbhost, $dbusuario, $dbpassword);
	mysqli_select_db($db,$nombredb);

	if(!$db){
		die("error bd");
	}


?>