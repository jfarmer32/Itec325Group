<?php
/*
Group: require_once(teamname.php);
Last edited: 05/05/2019 (V1.7)
Last edited by: Justin Farmer
Purpose: This is the Admin (Home)Page, where admin can view, add to, and modify
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
*/
$title = "Admin Homepage";

?>
<html>
  <head>
    <title><?php echo $title ?></title>
    <link rel='stylesheet' type='text/css' href='basic.css'>
    <script src="project-scripts.js"></script>
  </head>

  <body onload="loadScripts()">
    <?php echo makeHeader(array("left" => makeImgGrid("./images/square.jpeg", 11, 6),
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
                                  array("active" => "Homepage",
                                        "pageLink" => hyperlink("admin-show-table.php",
                                                                "View by Table",
                                                                "pageTab"),
                                        "pageLink2" => hyperlink("admin-db-maintenance.php",
                                                                 "Database Maintenance",
                                                                 "pageTab"))) ?>

    <div class="aboveContentRight" id="time"></div>

    <div class="adminHomepage">
      <?php
      /* echo $_SESSION['login_user']; */
      echo asUL("hpContent",
                array("To view data:",
                      "  • Navigate to View by Table",
                      "  • Select table and add applicable filters",
                      "  • Submit your query to the database by pressing 'Pull Rows'"));
      echo asUL("hpContent",
                array("To perform Database Maintenance:",
                      "  • Navigate to Database Maintenance",
                      "  • Select table to be reset and press 'Reset Table'",
                      "  • Or reset all tables by pressing 'PurgeDB'"));
      ?>
    </div>

  </body>
</html>
