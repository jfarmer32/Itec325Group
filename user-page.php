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
    <?php  echo "<div class='plain'>Welcome user!</div>" ?>
    <div class="aboveContentRight" id="time"></div>
    <div>
      <?php
      /* echo $_SESSION['login_user']; */
      echo userContent();
      ?>
    </div>

  </body>
</html>
