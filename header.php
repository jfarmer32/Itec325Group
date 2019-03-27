<?php
/*  @group require_once(teamname.php);
*   @author Justin Farmer
*   @course itec325-2019spring
*   @assignment 325 Group Project
*
* This is the header that will appear on all pages
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
