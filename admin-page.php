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
$body = "This is the Admin Control Station. To view information:
              First select the desired table,
              then select applicable filters,
              finally submit your query to the database by pressing 'Pull Rows'.";
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
        <?php echo dropdown("table", array("Users", "Content"), "Select Table:"); ?>
      </div>
      <div class="custom-select">
        <?php echo dropdown("showOnly",
                            array("Only Admin", "Only Restricted", "All data"),
                            "Include data:"); ?>
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
      <!--
      <div>
        <input type="submit" name="delete" value="Delete Row(s)">
      </div>
      <div>
        <input type="submit" name="reset" value="Reset Table">
      </div>
      <div>
        <input type="submit" name="purge" value="Purge DB">
      </div>
      -->
    </div>
    <div class="bottomAdminContainer">
        <?php echo $body ?>
    </div>
    </form>
  </body>
</html>
