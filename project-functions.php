<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V1.2)
Last edited by: Justin Farmer
Purpose: provide utility functions for the grid-link project
*/
error_reporting(E_ALL);

/* AsAttrs takes in an array of strings (each key is also a string)
  *   and returns one string that is the attribute-value pairs seperated by an
  *   "=", with the values in 'single quotes'.
  * @param $attrValues The attribute(as the key) value pairs being returned
  *   as a string.
  * @return A string containing the HTML tags as attributes-and-values.
  * asAttrs : string[] -> string
  */
function asAttrs($attrValues) {
    $AVPairs = "";

    if(sizeof($attrValues) !== 0) {
    foreach($attrValues AS $attr => $attrValue) {
      $AVPairs .= "$attr='$attrValue' ";
    }
    }
    else
      return false;

    return substr($AVPairs, 0, strlen($AVPairs) - 1);
  }

  /* hyperlink returns a string of HTML for a hyperlink.
  * @param $url The URL to be linked too
  * @param $linkTxt The name of the link, either a string
  *                 or false(meaning no link was entered)
  * @return The HTML string containing the link to the URL
  * hyperlink : string, string -> string
  */
  function hyperlink($url, $linkTxt, $class) {
    if ($linkTxt === false) //If no link text specified, then default to URL
      $linkTxt = $url;

    return "<a class='$class' href='$url' $addAttrs>$linkTxt</a>";
  }

/**
 * divWithNestedDivs takes in a wrapper class name, and an array of contents
 *  where each key-value entry is a class(key) => content(value)
 * @param  [String] $wrapperClass the parent class that will wrap
 *  the child divs
 * @param  [String[]] $divContents key-value pairs for the child divs
 *  the key is the child's class, the value is the childs content
 * @return [String-or-false] Returns the HTML string for a div with
 *  nested divs
 * Returns false is the given array is empty
 */
function divWithNestedDivs( $wrapperClass, $divContents ) {
  $divsSoFar = "";

  if(sizeof($divContents) !== 0) {
  foreach($divContents AS $childClass => $divContent)
    $divsSoFar .= "  <div class='$childClass'>$divContent</div>\n";
  }
  else
    return false;

  return "<div class='$wrapperClass'>\n$divsSoFar</div>";
}

function adminGridCell( $attrs ) {

  if(sizeof($attrs) === 0)
    return false;
  else
    $cellAttrs = asAttrs($attrs);

  return "<div><input $cellAttrs /></div>\n";
}

function adminGridRow( $cellAttrs ) {
  $rowSoFar = "";

  if(sizeof($cellAttrs) === 0)
    return false;
  else {
    foreach($cellAttrs AS $cellAttr)
      $rowSoFar .= adminGridCell($cellAttr);
  }

  return $rowSoFar;
}
/**
 * makeHeader calls divWithNestedDivs, and sets the parent class to be header
 * @param  [String[]] $contents the array key-value pairs containing the div
 *         contents.
 * @return [String-or-false] Returns false is the given array is empty
 * Returns the HTML for a header
 */
function makeHeader( $contents ) {
  return divWithNestedDivs("header", $contents);
}

/**
 * asUL takes in an array of strings and returns those stings in a UL
 * @param  [array] $listItems the array containing the list items
 * @return [string] The string containing HTML code for an unordered list
 */
function asUL($listItems) {
  $liSoFar = "";

  foreach($listItems AS $listItem)
    $liSoFar .= "  <li>$listItem</li>\n";

  return "<ul>\n$liSoFar</ul>";
}

/** Crude potential grid function
 * makeImgGrid turns a image into a grid of that image
 * @param  [String] $gridBlock the link to the image to be turned into a grid
 * @param  [non-negative-real] $width how many blocks wide
 * @param  [non-negative-real] $height how many blacks tall
 * @return [String] the html string for grid of images
 */
function makeImgGrid($gridBlock, $width, $height) {
  $gridCol = "  <div class='column'>\n"
           . "    <img src=$gridBlock alt='Cell' style='width:100%'>\n"
           . "  </div>\n";

  $gridRow = "<div class='row'>\n";

  if($width > 0 && $height > 0) {
    for($i=0;$i<$width; $i++)
      $gridRow .= $gridCol . " ";

      $gridRow .= "\n</div>";
      $grid = "";

      for($j=0;$j<$height; $j++)
      $grid .= $gridRow . "\n";
    }
    else
      return false;

  return "<div class='gridLinkWrapper'>\n$grid</div>";
}


/**
 * makeGridElement returns the HTML for an image that links to a URL
 * @param  $imageURL the URL to use for the image
 * @param  $linkURL the URL to use for the image link
 * @return $htmlSTR the string for an HTML image that links to a URL
 */
function makeGridElement($imageURL, $linkURL)
{
  $htmlSTR="";
  $htmlSTR.="<a href='".$linkURL."'>"
          ."  <img border='0' alt='Absolute Unit' src='".$imageURL."' width='200' height='200'>"
          ."</a>";
  return $htmlSTR;
}





/* stripWhitespace strips whitespace from a string
* @param $string The string to be stripped
* @return $string, but with whitespace
*   reduced to a single space ' '
*/
function stripWhitespace($string) {
  return trim(preg_replace('/\s\s+/', ' ', $string), " \n\t\r");
}

/* implodeWithKeys acts as a toString for arrays with key-value pairs
* @parm $contents The array with key-value pairs
* @return $contentsSoFar the string result of the array contents
* @return false if the array is empty
*/
function implodeWithKeys( $contents ) {
  $contentsSoFar = "";

  if(sizeof($contents) !== 0) {
    foreach($contents AS $key => $value)
      $contentsSoFar .= "\n$key: $value";
  } else {
      return false;
  }

  return $contentsSoFar;
}

/* test compares two items and returns a string of the result
* @param $actual The actual test result
* @param $expect The result I expect
* @param $normalize An optional argument defaulted to false
* @return $result The string containing the result of the test
* test : ANY, ANY, (boolean) -> string
*/
function test($actual, $expect, $normalize = false) {
  if( is_string($actual) &&
      is_string($expect) &&
      $normalize === true) {
        $actual = stripWhitespace($actual);
        $expect = stripWhitespace($expect);
      }
  if( is_array($actual) &&
      is_array($expect)) {
        $actual = implodeWithKeys($actual);
        $expect = implodeWithKeys($expect);
      }
  return ($actual === $expect)
             ? "Pass"
             : "     Actual: $actual\n     Expected: $expect\n";

  }

/* testResults prints statistics such as #tests run and #failed.
*   (Prints result iff a test fails)
* @param $results An array of test results.
* @return void
* testResults : string[] -> void
*/
function testResults($results, $printAllTests)
{
  $failed = $total = 0;
  foreach($results AS $test => $result)
  {
    ++$total;
    if($printAllTests === true)
    {
      if($result === "Pass")
      {
        echo "\nTest# $total : $test => Pass";
      }
      else
      {
        echo "\n\nTest# $total : $test => *Fail*\n"
             . "\n > $test failed:\n$result";
        ++$failed;
      }
    }
    else if($printAllTests === false && $result !== "Pass")
    {
      ++$failed;
      echo "\n > $test failed:\n$result";
    }
  }
  echo "\n-------Summary--------";
  echo "\n > $total tests run.";
  echo  ($failed === 0)
         ? "\n > All test passed!\n"
         : "\n > $failed test failed.\n";
  echo "----------------------\n";
}

  ?>
