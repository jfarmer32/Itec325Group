<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V1.2)
Last edited by: Justin Farmer
Purpose: This is the Admin Page, where admin can do admin things
*/
error_reporting(E_ALL);
require_once("project-functions.php");

$title = "Admin Page";
$body = tableHeader(array("Username", "Password", "profilePicture", "isAdmin", "isUserRestricted"));
$currentTable = $_GET['table'];
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
                                "right" => asUL(array(hyperlink("#",
                                                                "Help",
                                                                "menu",
                                                                array("id" => "adminHelp", "onclick" => "adminAlert()")),
                                                      hyperLink("index.php",
                                                                "Return",
                                                                "menu"),
                                                      hyperLink("https://www.w3schools.com/css/css_link.asp",
                                                                "Logout",
                                                                "menu")))));
                           ?>

    <div class="aboveContentLeft">Admin</div>

    <div class="aboveContentRight" id="time"></div>

    <form id="tableForm" onsubmit="confirmPull()" method="get">
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
        <input type="text" name="userSelected" placeholder="Enter User if needed">
      </div>
      <div style="padding-top: 15px;">
        <input type="submit" name="adminSubmit" value="Pull Rows">
      </div>
    </div>

    <form id="deleteForm" onsubmit="confirmDelete()" method="post">

    <div class="middleAdminContainer">
        <table class="adminTable"><?php echo $body ?><tr><td>1</td><td>3</td><td>5</td><td>7</td><td>9</td></tr></table>
    </div>

    <div class="bottomWMiddleAdminContainer">
      <div>
        <input type="submit" name="delete" value="Delete Row(s)">
      </div>
      <div class = "label">
        <h2>Database maintainence:</h2>
      </div>
      <div>
        <?php
          echo radioTable("Change table",
                          array("Users", "Content"),
                          array("changeTable" => array("Users", "Content")));
        ?>
      </div>
      <div>
        <input type="submit" name="reset" value="Reset Table">
      </div>
      <div>
        <input type="submit" name="purge" value="Purge DB">
      </div>
    </div>

    </form>
  </form>
  </body>
</html>
