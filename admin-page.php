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

  <body onload="startTime()">
    <?php echo makeHeader(array("left" => makeImgGrid("images/square.jpeg", 11, 6),
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

    <div class="aboveContentRight" id="time">Time:</div>

    <div class="adminGridContainer">
      <?php echo adminGridRow(array("cell1" => array("name" => "viewUsers",
                                                     "type" => "submit",
                                                     "value" => "View Users"),
                                    "cell2" => array("name" => "viewContent",
                                                     "type" => "submit",
                                                     "value" => "View Content"),
                                    "cell3" => array("name" => "viewSomethingElse",
                                                     "type" => "submit",
                                                     "value" => "View Something"),
                                    "cell4" => array("name" => "filter1",
                                                     "type" => "radio",
                                                     "value" => "Filter1"),
                                    "cell5" => array("name" => "filter2",
                                                     "type" => "radio",
                                                     "value" => "Filter2"),
                                    "cell6" => array("name" => "filter3",
                                                     "type" => "radio",
                                                     "value" => "Filter3"),
                                    "cell7" => array("name" => "filter4",
                                                     "type" => "checkbox",
                                                     "value" => "Filter4"),
                                    "cell8" => array("name" => "filter5",
                                                     "type" => "checkbox",
                                                     "value" => "Filter5"),
                                                   )) ?>

    </div>
    <div class="bottomAdminContainer">
        <?php echo $body ?>
    </div>
  </body>
</html>
