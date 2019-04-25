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
function asAttrs($attrValues)
{
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

/* dropdown takes in a $name and an array of $options and returns
*   a string HTML for a drop-down menu.
* @param $name the name of the of the dropdown
* @param $options the array of dropdown options
* @return $dropdownMenu the string of HTML for a drowdown menu
* dropdown : string, string[] -> string
*/
function dropdown($name, $options, $selectOne = true) {
    $openSelect = "\n<select name='$name' id='$name'>";
    $closeSelect = "</select>\n";
    $pos = 0;

     if(is_string($selectOne)) {
        $dropdownOptions = "<option value =0>$selectOne</option>\n";
        $pos = 1;
      }
     else if($selectOne === true) {
        $dropdownOptions = "<option value =0>Select One</option>\n";
        $pos = 1;
      }
     else
        $dropdownOptions = "";

  foreach($options AS $option) {
    $dropdownOptions .= "<option value ='$pos'>$option</option>\n";
    $pos++;
  }

  return "$openSelect\n$dropdownOptions" . "$closeSelect";
}

/**
 * makeHeader calls divWithNestedDivs, and sets the parent class to be header
 * @param  [String[]] $contents the array key-value pairs containing the div
 *         contents.
 * @return [String-or-false] Returns false is the given array is empty
 * Returns the HTML for a header
 */
function makeHeader( $contents )
{
  return divWithNestedDivs("header", $contents);
}

/**
 * asUL takes in an array of strings and returns those stings in a UL
 * @param  [array] $listItems the array containing the list items
 * @return [string] The string containing HTML code for an unordered list
 */
function asUL($listItems)
{
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
function makeGridElement($imageURL, $linkURL=false)
{
  $htmlSTR="";
  $class="";
  if ($linkURL === false)
  {
    $htmlSTR.="<a class='gridPane'>";
    $class.="gridPaneUserPic";
  }
  else
  {
    $htmlSTR.="<a class='gridPane' href='".$linkURL."'>";
    $class.="gridPaneElement";
  }
  $htmlSTR.="  <img border='0' class='".$class."' alt='If you can read this... an image link is broken!' src='".$imageURL."'>"
          ."</a>";
  return $htmlSTR;
}

/* resetArrayIndices takes in an array and returns that array with
*    it's indices reset to be numeric, starting at 0
* @param $contents The array whose indices are being reset
* @return $numericArray The original array, but with numeric indices
* resetArrayIndices : any[] -> any[]
*/
function resetArrayIndices($contents) {
  $numericArray = array();
  $pos = 0;

    foreach($contents AS $content) {
      $numericArray[$pos] = $content;
      $pos++;
    }
  return $numericArray;
}

/* AsRow takes in an array of strings and returns a single, long
  *   string, the HTML for one table row.
  * @param $elements The array being turned into a table row.
  * @param $firstIteamAsHeader A boolean that indicates if the first
  *   element is a header. (Defaults to true)
  * @return A string containing the HTML for one table row.
  * asRow : string[], (boolean) -> string
  */
function asRow($elements, $firstCellIsHeader = true) {
  $rowSoFar = "";
  $tableCells = resetArrayIndices($elements);

      if($tableCells[0] !== ""){
      foreach($tableCells AS $index => $tableCell) {
        ($firstCellIsHeader === true && $index === 0)
          ? $rowSoFar = "        <th>$tableCell</th>\n"
          : $rowSoFar .= "        <td>$tableCell</td>\n";
        }
      }
    return " <tr>\n$rowSoFar      </tr>\n";
  }
/** Needs documentation
 * [checkboxRow description]
 * @return [type] [description]
 */
function checkboxRow($title, $elements, $options) {
  if(sizeof($options) !== 0)
    $header = tableHeader($options, true);

  $rowSoFar = "<th>$title</th>\n";

  foreach($elements AS $element)
    $rowSoFar .= "<td><input type='checkbox' name='$element' value='$element'></td>\n";

  return "<table>\n $header<tr>\n$rowSoFar      </tr>\n</table>";
}

/* radioTableRow takes in a $name and an array of $radios and returns
*    a bank of radio buttons inside of a table-row.
* @param $subject the subject of the radio buttons
* @param $rowName the name of the row
* @param $options the options each set of radios will have
* @return a table row of radio buttons
* radioTableRow : string, string[] -> string
*/
function radioTableRow($subject, $rowName, $options, $htmlAttrs = array()) {
  $attrs = asAttrs($htmlAttrs);
  $radiosSoFar = array($rowName);

    foreach($options AS $option)
        $radiosSoFar[$rowName."-".$option] = "<input type='radio' name='[$subject][$rowName]' value='$option' id='$rowName-$option' $attrs/>";

  return asRow($radiosSoFar, true);
}

/* tableHeader takes in an array of strings and returns a string of HTML
*    that is a row with each string from $headers enclosed in <th> tags
* @param $headers The array of strings being turned into table headings
* @param $shiftRight an optional parameter defaulted to false, when set to true
*         the first <th> will be empty.
* @return $tableHeader the HTML for a row of table headings, enclosed in <tr></tr>
*/
function tableHeader($headers, $shiftRight = false) {
  ($shiftRight === true)
    ? $tableHeader = "      <th></th>\n"
    : $tableHeader = "";

    foreach($headers AS $header)
      $tableHeader .= "      <th>$header</th>\n";

  return "     <tr>\n$tableHeader     </tr>\n";
}

/* radioTable takes in a $name, and two arrays $headers, and $stuffs and
*    and returns the HTML for a table of radio buttons.
* @param $subject the subject of the radio buttons
* @param $options the options each set of radios will have
* @param $radioRows the name and contents of each row
* @return $radioTable the table of radio buttons
* radioTable : string, string[], string[] -> string
*/
function radioTable($subject, $options, $radioRows) {
  $radioTable = "";

  if(sizeof($options) !== 0)
    $radioTable = tableHeader($options, true);

    foreach($radioRows AS $rowName => $radioRow)
      $radioTable .= "     " . radioTableRow($subject, $rowName, $radioRow);

  return "    <table>\n$radioTable\n    </table>";
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
function test($actual, $expect, $normalize = false)
{
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

/* NEEDS DOCUMENTATION
 *
*/
function contentPane($links=false, $images=false, $debug=false)
{
  $htmlSTR="";
  $conn=mysqli_connect('localhost','unknown','security1#','social-site');
  if ($debug)
  {
    echo "Connection ", ($conn ? "" : "NOT "), "established.<br />\n";
    if (mysqli_connect_error()) { echo "Error details: ", mysqli_connect_error(), "\n"; }
  }
  //GET USER PROFILE PICS
  $query="SELECT * FROM users";
  $results=mysqli_query($conn,$query);
  if ($debug)
  {
    echo "query was a ", ($results ? "success (though it might still have only 0 rows)" : "failure"), ".<br />\n";
  }
  while ($row=mysqli_fetch_assoc($results))
  {
    $htmlSTR.=makeGridElement($row['profilePicture']);
    $query2="SELECT * FROM content WHERE User='".$row['Username']."'";
    $results2=mysqli_query($conn,$query2);
    $contentLimiter=0;
    while ($row2=mysqli_fetch_assoc($results2))
    {
      if ($contentLimiter < 7)
      {
        $htmlSTR.=spacer();
        $htmlSTR.=makeGridElement($row2['Image'],$row2['Hyperlink']);
        $contentLimiter=$contentLimiter+1;
      }
      else {
        //don't make a content pane
      }
    }
    $htmlSTR.="<br/>";
  }
  mysqli_close($conn);
  return $htmlSTR;
}
/* NEEDS DOCUMENTATION
 *
*/
function spacer()
{
  return "<img src='spacer.png' class='spacer'>";
}
?>
