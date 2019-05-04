<?php
/*
Group: require_once(teamname.php);
Last edited: 05/03/2019 (V1.0)
Last edited by: Justin Farmer
Purpose: provide logout functionality, is in it's own page so it can be directly
         linked to.
*/
  session_start();
	session_destroy();
  session_unset();
  header("Location: index.php");

 ?>
