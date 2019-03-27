<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V1.1)
Last edited by: Benjamin balichtman
Purpose: This is the header that will appear on all pages
*/
error_reporting(E_ALL);
require_once("project-functions.php");
?>
<div class="header">
  <div class="left">Some Image</div>
  <div class="center">Website Name</div>
  <div class="right">
    <?php echo asUL(array("Help", "Settings", "Logout")); ?>
  </div>
</div>
