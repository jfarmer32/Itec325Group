<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V.1.1)
Last edited by: Benjamin Lichtman
Purpose: This page will serve as our landing page.
*/
?>
<html>
  <head>
    <link rel="stylesheet" href="basic.css">
    <title>Grid-links</title>
    <?php
      require_once('project-functions.php');
    ?>
  </head>
  <body>
    <p>
      <?php
        echo makeHeader(array("left" => makeImgGrid("square.jpeg", 11, 6),
                              "center" => "<h1>Grid-Links</h1>",
                              "right" => asUL(array(hyperlink("login.php",
                                                              "Login",
                                                              "menu"),
                                                    hyperlink("createAccount.php",
                                                              "Create Account",
                                                              "menu")))));
      ?>
    </p>
    <br/>
    <span>
      <?php
        echo contentPane();
      ?>
    </span>
  </body>
</html>
