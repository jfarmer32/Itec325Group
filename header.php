<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V1.1)
Last edited by: Benjamin balichtman
Purpose: This is the header that will appear on all pages
*/
error_reporting(E_ALL);
require_once("project-functions.php");

echo makeHeader(array("left" => require_once("grid-image.php"),
                      "center" => "Grid-Links",
                      "right" => asUL(array("Help", "Settings", "Logout"))));
?>
