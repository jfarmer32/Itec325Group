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

echo makeHeader(array("left" => require_once("grid-image.php"),
                      "center" => "Grid-Links",
                      "right" => asUL(array("Help", "Settings", "Logout"))));
?>
