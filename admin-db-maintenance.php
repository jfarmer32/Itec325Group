<?php
/*
Group: require_once(teamname.php);
Last edited: 05/03/2019 (V1.0.1)
Last edited by: Justin Farmer
Purpose: This is the Admin (DB-maintenance)Page, where admin can view, add to, and modify
         the database.
*/
session_start();
error_reporting(E_ALL);

require_once("project-functions.php");
/*
if(!isset($_SESSION["active_session"]) || $_SESSION["active_session"] !== true)
{
  header("location: index.php");
}
$User = $_POST
*/
$title = "Admin Page";
$body = "This is the Admin Control Station. To view information:\n"
           .  " First select the desired table,\n"
           .  " Then select applicable filters, \n"
           .  " Finally submit your query to the database by pressing 'Pull Rows'.\n";
?>
<html>
  <head>
    <title><?php echo $title ?></title>
    <link rel='stylesheet' type='text/css' href='basic.css'>
    <script src="project-scripts.js"></script>
  </head>

  <body onload="loadScripts()">
    <?php echo makeHeader(array("left" => makeImgGrid("square.jpeg", 11, 6),
                                "center" => "<h1>Grid-Links</h1>",
                                "right" => asUL("headerMenu",
                                                array(hyperlink("#",
                                                                "Help",
                                                                "menu",
                                                                array("id" => "adminHelp", "onclick" => "adminAlert()")),
                                                      hyperLink("index.php",
                                                                "Return",
                                                                "menu"),
                                                      hyperLink("logout.php",
                                                                "Logout",
                                                                "menu")))));
                           ?>
    <?php  echo divWithNestedDivs("aboveContentLeft",
                                  array("pageLink"=> hyperlink("admin-page.php",
                                                               "Homepage",
                                                               "pageTab"),
                                        "pageLink2" => hyperlink("admin-show-table.php",
                                                                 "View by Table",
                                                                 "pageTab"),
                                        "active" => "Database Maintenance")) ?>

    <div class="aboveContentRight" id="time"></div>

    <form id="dbMForm" onsubmit="confirmDelete()" method="post">
    <div class="dbMaintenance">
      <div class="custom-select">
        <?php echo dropdown("table", array("Users", "Content"), "[Select Table]"); ?>
      </div>
      <div>
        <input type="submit" name="reset" value="Reset Table">
      </div>
      <div>
        <input type="submit" name="purge" value="Purge DB">
      </div>
    </div>
    </form>
  </body>
</html>
