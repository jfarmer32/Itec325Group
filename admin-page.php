<?php
/*  @group require_once(teamname.php);
*   @author Justin Farmer
*   @course itec325-2019spring
*   @assignment 325 Group Project
*
* This is the Admin Page, where admin can do admin things
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
  </head>

  <body>
    <?php require_once("header.php"); ?>

    <div class="aboveContentLeft">Admin _______</div>
    <div class="aboveContentRight">Date/Time</div>

    <div class="adminGridContainer">
      <div><input name='viewUsers' type='submit' value='View Users' /></div>
      <div><input name='viewContent' type='submit' value='View Content' /></div>
      <div><input name='viewSomethingElse' type='submit' value='View Something' /></div>
      <div>Older than 1 year<input name='filter1'type='radio' value='Filter1' /></div>
      <div>Older than 6 months<input name='filter2'type='radio' value='Filter2' /></div>
      <div>Created in the past week<input name='filter3'type='radio' value='Filter3' /></div>
      <div>Display all columns<input name='filter4'type='checkbox' value='Filter4' /></div>
      <div>Some other filter<input name='filter5'type='checkbox' value='Filter5' /></div>
    </div>
    <div class="bottomAdminContainer" >
      <?php echo $body ?>
    </div>
  </body>
</html>
