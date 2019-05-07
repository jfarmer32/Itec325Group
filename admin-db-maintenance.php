<?php
/*
Group: require_once(teamname.php);
Last edited: 05/06/2019 (V1.3)
Last edited by: Justin Farmer
Purpose: This is the Admin (DB-maintenance)Page, where admin can view, add to, and modify
         the database.
*/
session_start();
error_reporting(E_ALL);

require_once("project-functions.php");
require_once("project-validation.php");
/*
if(!isset($_SESSION["active_session"]) || $_SESSION["active_session"] !== true)
{
  header("location: index.php");
}
$User = $_POST
*/
$title = "Database Maintenance";
$errors = addErrorToPage();
$result = resetDBorTable();
$msg = "";

if(!is_string($result)) {
  ($result) ? $msg="Success" : $msg="Error occured on table operation.";
} else {
  $msg=$result;
}

$noErrors = "<div class='noError'></div>";

if(!empty($_POST['reset'])) {
  $msgFromDB = "<div class='dbMMessage'>$msg</div>";
} else {
  $msgFromDB = $noErrors;
}

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
                                  array("pageLink"=> hyperlink("admin-page.php",
                                                               "Homepage",
                                                               "pageTab"),
                                        "pageLink2" => hyperlink("admin-show-table.php",
                                                                 "View by Table",
                                                                 "pageTab"),
                                        "active" => "Database Maintenance")) ?>

    <div class="aboveContentRight" id="time"></div>

    <form id="dbMForm" action="" method="post">
    <div class="dbMaintenance">
      <div class="custom-select">
        <?php echo dropdown("table", array("Users", "Content"), "[Select Table]"); ?>
      </div>
      <div>
        <input id="reset-table" type="submit" name="reset" value="Reset Table">
      </div>
      <div>
        <input id="reset-db" type="submit" name="reset" value="Purge DB">
      </div>
    </div>
    </form>
    <?php echo $msgFromDB ?>
    <?php echo ($errors === false) ? $noErrors : $errors ?>
  </body>
</html>
