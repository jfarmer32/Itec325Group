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
$body = "The FitnessGram™ Pacer Test is a multistage aerobic capacity test that progressively gets more difficult as it continues. The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed starts slowly, but gets faster each minute after you hear this signal. [beep] A single lap should be completed each time you hear this sound. [ding] Remember to run in a straight line, and run as long as possible. The second time you fail to complete a lap before the sound, your test is over. The test will begin on the word start. On your mark, get ready, start.The FitnessGram™ Pacer Test is a multistage aerobic capacity test that progressively gets more difficult as it continues. The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed starts slowly, but gets faster each minute after you hear this signal. [beep] A single lap should be completed each time you hear this sound. [ding] Remember to run in a straight line, and run as long as possible. The second time you fail to complete a lap before the sound, your test is over. The test will begin on the word start. On your mark, get ready, start.The FitnessGram™ Pacer Test is a multistage aerobic capacity test that progressively gets more difficult as it continues. The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed starts slowly, but gets faster each minute after you hear this signal. [beep] A single lap should be completed each time you hear this sound. [ding] Remember to run in a straight line, and run as long as possible. The second time you fail to complete a lap before the sound, your test is over. The test will begin on the word start. On your mark, get ready, start.";
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
                                "right" => asUL(array(hyperlink("https://www.w3schools.com/css/css_link.asp",
                                                                "Help",
                                                                "menu"),
                                                      hyperLink("https://www.w3schools.com/css/css_link.asp",
                                                                "Settings",
                                                                "menu"),
                                                      hyperLink("https://www.w3schools.com/css/css_link.asp",
                                                                "Logout",
                                                                "menu")))));
                           ?>

    <div class="aboveContentLeft">Admin _______</div>

    <div class="aboveContentRight" id="time"></div>

    <div class="adminGridContainer">
      <div class="custom-select" style="width:auto; height:auto;">
        <?php echo dropdown("table", array("Users", "Content"), "Select Table:"); ?>
      </div>
      <div><?php echo radioTable("filter",
                            array("1 year", "6 months", "1 month", "1 week"),
                            array("Created in the last " => array("1 year", "6 months", "1 month", "1 week"))) ?>
      </div>
      <div>
        <?php echo checkboxRow("Show ",
                               array("showAdmin", "showRestrictd", "onlyAdmin", "onlyRestricted"),
                               array("Admin", "Restricted", "Only Admin", "Only Restricted")) ?>
      </div>
      <div>
        <input type="text" name="userSelected" placeholder="Enter User if needed">
      </div>
      <div>
        <input type="submit" name="adminSumbit" value="Go">
      </div>
    </div>

    <div class="bottomAdminContainer">
        <?php echo $body ?>
    </div>
  </body>
</html>
