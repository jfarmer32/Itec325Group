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
      require_once('header.php');
      require_once('project-functions.php');
    ?>
  </head>
  <body>
    <p>
      <?php
        $bensContent=array("https://benlichtman.com"=>"https://i.redd.it/o5eo1p0kawn11.png"
                          ,"http://owsla.com/"=>"http://boughton2018.com/wp-content/uploads/2019/02/coloring-pages-i-pinimg-comoriginals00f18800f188a917347aee7f-outstanding-music-notes-picture-inspirations.png"
                          ,"https://www.radford.edu/content/radfordcore/home.html"=>"https://s3-us-west-2.amazonaws.com/asset.plexuss.com/college/overview_images/4146_radford-university_06.jpg");
        foreach ($bensContent as $key => $value)
        {
          echo makeGridElement($value,$key);
        }
      ?>
    </p>
  </body>
</html>
