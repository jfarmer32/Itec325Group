<?php
/*
Group: require_once(teamname.php);
Last edited: 05/06/2019 (V1.6)
Last edited by: Justin Farmer
Purpose: This is the Admin (Show-Table)Page, where admin can view, add to, and modify
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
*/
$title = "Admin Page";
$errors = addErrorToPage();
$noErrors = "<div class='noError'></div>";
$tableRows = getTableRows();
$tableError = "<tr><td>An error has occured.</td></tr>";
$result = modifyTable();

$msg = "";

(is_numeric($result))
   ? $msg= "$result rows modified."
   : $msg="Error occured on table operation.";

if(!empty($_POST['modify'])) {
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
                                  array("pageLink" => hyperlink("admin-page.php",
                                                                      "Homepage",
                                                                      "pageTab"),
                                        "active" => "View by Table",
                                        "pageLink2" => hyperlink("admin-db-maintenance.php",
                                                                 "Database Maintenance",
                                                                 "pageTab"))) ?>

    <div class="aboveContentRight" id="time"></div>

    <form id="tableForm" action="" method="get">
    <div class="adminGridContainer">
      <div class="custom-select">
        <?php echo dropdown("table", array("Users", "Content"), "[Select Table]"); ?>
      </div>
      <div class="custom-select">
        <?php echo dropdown("showOnly",
                            array("Only Admin", "Only Restricted", "All data"),
                            "Include which data?"); ?>
      </div>
      <div class="custom-select">
        <?php echo dropdown("filterByAge",
                            array("5 years", "1 year", "6 months", "1 month", "1 week", "24 hours"),
                            "All content from the past:"); ?>
      </div>
      <div>
        <input type="text" name="userEntered" placeholder="Enter User if needed">
      </div>
      <div style="padding-top: 15px;">
        <input id="adminSubmit" type="submit" name="adminSubmit" value="Pull Rows">
      </div>
    </div>
    </form>
    <form id="deleteForm" action="" onsubmit="confirmModify()" method="post">
    <div class="middleAdminContainer">
        <table class="adminTable"><?php echo ($errors === false) ? $tableRows : $tableError; ?></table>
    </div>

    <div class="bottomWMiddleAdminContainer">
      <div>
        <input id="modify-delete" type="submit" name="modify" value="Delete">
      </div>
      <div>
        <input id="nodify-restrict" type="submit" name="modify" value="Restrict">
      </div>
    </div>
    </form>
    <?php echo ($errors === false) ? $noErrors : $errors; ?>
  </body>
</html>
