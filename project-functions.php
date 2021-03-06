<?php
/*
Group: require_once(teamname.php);
Last edited: 05/05/2019 (V1.7)
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
function hyperlink($url, $linkTxt, $class, $addAttrs = array()) {
  if ($linkTxt === false) //If no link text specified, then default to URL
  $linkTxt = $url;

  if(sizeof($addAttrs) !== 0)
    $attrs = asAttrs($addAttrs);
  else
    $attrs = "";

  return "<a class='$class' href='$url' $attrs>$linkTxt</a>";
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
  $openSelect = "<select name='$name' id='$name'>";
  $closeSelect = "</select>";

  if(is_string($selectOne)) {
    $dropdownOptions = "<option value =0>$selectOne</option>\n";
  }
  else if($selectOne === true) {
    $dropdownOptions = "<option value =0>Select One</option>\n";
  }
  else
  $dropdownOptions = "";

  foreach($options AS $option) {
    $dropdownOptions .= "<option value ='$option'>$option</option>\n";
  }

  return "$openSelect\n$dropdownOptions" . "$closeSelect\n";
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
function asUL($class = "", $listItems)
{
  if($class === "") {
    $openUL = "<ul>";
  } else {
    $openUL = "<ul class='$class'>";
  }

  $liSoFar = "";
  foreach($listItems AS $listItem)
  $liSoFar .= "  <li>$listItem</li>\n";

  return "$openUL\n$liSoFar</ul>";
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
      if ($contentLimiter < 6 && $row2['isContentRestricted']!=1 )
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

function userContent($links=false, $images=false, $debug=false)
{
  $htmlSTR="";
  $conn=mysqli_connect('localhost','unknown','security1#','social-site');
  if ($debug)
  {
    echo "Connection ", ($conn ? "" : "NOT "), "established.<br />\n";
    if (mysqli_connect_error()) { echo "Error details: ", mysqli_connect_error(), "\n"; }
  }
  //GET USER PROFILE PICS
  $username = $_SESSION['login_user'];
  $query="SELECT * FROM Content WHERE User='$username'";
  $userQuery="SELECT * FROM Users WHERE User='$username'";

  $results=mysqli_query($conn,$query);
  $userResult=mysqli_query($conn,$userQuery);
  
  if ($debug)
  {
    echo "query was a ", ($results ? "success (though it might still have only 0 rows)" : "failure"), ".<br />\n";
  }
  while ($row=mysqli_fetch_assoc($results))
  {
    $htmlSTR.=makeGridElement($userQuery['profilePicture']);

    $contentLimiter=0;
    while ($row2=mysqli_fetch_assoc($results2))
    {
      if ($contentLimiter < 6 && $row2['isContentRestricted']!=1 )
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

/**
* grabUserRowsAsTable will return a html table containing the rows
*   from the Users table that meet the given SELECT statement
* @param  [string] $query: the SQL SELECT statement being sent to the DB
* @return [string] the html table containing the SELECTed rows from the Users table
*/
/******************* NEEDS TO BE TESTED *******************/
function grabUserRowsAsTable($query) {

  $tableRows=tableHeader(array("Username", "Password", "profilePicture", "isAdmin", "isUserRestricted"));
  $conn=mysqli_connect('localhost','unknown','security1#','social-site');

  if ($debug)
  {
    echo "Connection ", ($conn ? "" : "NOT "), "established.<br />\n";
    if (mysqli_connect_error()) { echo "Error details: ", mysqli_connect_error(), "\n"; }
  }

  $results=mysqli_query($conn, $query);

  if ($debug)
  {
    echo "query was a ", ($results ? "success (though it might still have only 0 rows)" : "failure"), ".<br />\n";
  }

  while ($row=mysqli_fetch_assoc($results))
  {
    $tableRows.= "<tr>\n";

    $tableRows.= "<td><input type='checkbox' name='toDelete[]' value=" . $row['Username'] . "></td>\n";
    $tableRows.= "<td>" . $row['Username'] . "</td>\n";
    $tableRows.= "<td>" . $row['Password'] . "</td>\n";
    $tableRows.= "<td>" . $row['profilePicture'] . "</td>\n";
    $tableRows.= "<td>" . $row['isAdmin'] . "</td>\n";
    $tableRows.= "<td>" . $row['isUserRestricted'] . "</td>\n";

    $tableRows.= "</tr>\n";
  }

  mysqli_close($conn);

  return "<table class='adminTable'>\n$tableRows\n</table>";
}

/**
* grabContentRowsAsTable will return a html table containing the rows
*   from the Content table that meet the given SELECT statement
* @param  [string] $query: the SQL SELECT statement being sent to the DB
* @return [string] the html table containing the SELECTed rows from the Content table
*/
/******************* NEEDS TO BE TESTED *******************/
function grabContentRowsAsTable($query) {

  $tableRows=tableHeader(array("ContentID", "User", "Image", "isAdmin", "Hyperlink", "isContentRestricted", "ContentDate", "ContentTime"));
  $conn=mysqli_connect('localhost','unknown','security1#','social-site');

  if ($debug)
  {
    echo "Connection ", ($conn ? "" : "NOT "), "established.<br />\n";
    if (mysqli_connect_error()) { echo "Error details: ", mysqli_connect_error(), "\n"; }
  }

  $results=mysqli_query($conn, $query);

  if ($debug)
  {
    echo "query was a ", ($results ? "success (though it might still have only 0 rows)" : "failure"), ".<br />\n";
  }

  while ($row=mysqli_fetch_assoc($results))
  {
    $tableRows.= "<tr>\n";

    $tableRows.= "<td><input type='checkbox' name='toDelete[]' value=" . $row['ContentID'] . "></td>\n";
    $tableRows.= "<td>" . $row['ContentID'] . "</td>\n";
    $tableRows.= "<td>" . $row['User'] . "</td>\n";
    $tableRows.= "<td>" . $row['Image'] . "</td>\n";
    $tableRows.= "<td>" . $row['Hyperlink'] . "</td>\n";
    $tableRows.= "<td>" . $row['isContentRestricted'] . "</td>\n";
    $tableRows.= "<td>" . $row['ContentDate'] . "</td>\n";
    $tableRows.= "<td>" . $row['ContentTime'] . "</td>\n";

    $tableRows.= "</tr>\n";
  }

  mysqli_close($conn);

  return "\n$tableRows\n";
}

/**
* formUserQuery forms the SELECT query for the Users table from
*   the given form information.
* @param  [String] $show: the data to be shown
* @param  [String] $userEntered: the user entered
* @return [String] $query: the formed query including filters
*/
function formUserQuery($show, $userEntered) {
  $pullOnly = "";
  $user = "";
  $query = "SELECT * FROM Users";

  if($show === "Only Admin") {
    $pullOnly = " WHERE isAdmin = 1";
  } else if($show === "Only Admin") {
    $pullOnly = " WHERE isUserRestricted = 1";
  } else {
    $pullOnly = "";
  }

  if($userEntered != "" && $pullOnly ===  "") {
    $user = " WHERE User = $userEntered";
  } else if($userEntered != "" && $pullOnly != "") {
    $user = " AND User = $userEntered";
  } else {
    $user = "";
  }

  $query .= $pullOnly . $user;

  return $query;
}

/**
 * formContentQuery forms the SELECT query for the Content table from
 *   the given form information.
 * @param  [String] $show: the data to be shown
 * @param  [String] $filter: the age filter selected
 * @param  [String] $userEntered: the user entered
 * @return [String] $query: the formed query including filters
 */
function formContentQuery($show, $filter, $userEntered) {
  $pullOnly = "";
  $user = "";
  $ageFilter = "";

  $query = "SELECT * FROM Content";

  $timeFrame = "";
  $timeAmnt = 0;

  if ($filter === "5 years") {
    $timeFrame = "YEAR";
    $timeAmnt = 5;
  } else if($filter === "1 year") {
    $timeFrame = "YEAR";
    $timeAmnt = 1;
  } else if($filter === "6 months") {
    $timeFrame = "MONTH";
    $timeAmnt = 6;
  } else if($filter === "1 month") {
    $timeFrame = "MONTH";
    $timeAmnt = 1;
  } else if($filter === "1 week") {
    $timeFrame = "DAY";
    $timeAmnt = 7;
  } else if($filter === "24 hours") {
    $timeFrame = "DAY";
    $timeAmnt = 1;
  } else {
    $timeFrame = "YEAR";
    $timeAmnt = 10;
  }

  $ageFilter = " WHERE DATEDIFF($timeFrame, ContentDate, GetDate()) < $timeAmnt ";

  if($show === "Only Admin") {
    $pullOnly = " AND isAdmin = 1";
  } else if($show === "Only Restricted") {
    $pullOnly = " AND isContentRestricted = 1";
  } else {
    $pullOnly = "";
  }

  if($userEntered != "") {
    $user = " AND User=$userEntered";
  } else {
    $user = "";
  }

  $query .= "$ageFilter$pullOnly$user";

  return $query;
}

/**
 * getTableRows will GET table rows from the DB on submit, using the info
 *   provided at tableForm (This function uses $_GET).
 * Instead of returning the rows as a set, this function will call either
 *  grabContentRowsAsTable, or grabUserRowsAsTable, which will return the
 *  desired rows as a table.
 */
function getTableRows() {

  if(!empty($_GET['adminSubmit'])) {
  $table = $_GET['table'];
  $show = $_GET['showOnly'];
  $filter = $_GET['filterByAge'];
  $userEntered = $_GET['userEntered'];
  $pullOnly = "";
  $user = "";

  if($table === "Users") {
    $query = formUserQuery($show, $userEntered);
    grabUserRowsAsTable($query);

  } else if($table === "Content") {
    $query = formContentQuery($show, $filter, $userEntered);
    grabContentRowsAsTable($query);

  } else {
    $error = "Table must be selected.";
  }
} else {

  return "<tr><th>Select table, data, and age filter as applicable, then press 'Pull Rows'</th></tr>";
}
}

/**
 * getIDType will get the IDtype for the given table
 * @param  [String] $table: the selected table
 * @return [String] $IDType: the IDType for the selected table
 */
function getIDType( $table ) {
  $IDType = "";

  if($table === "Users") {
    $IDType = "Username";
  } else if($table === "Content") {
    $IDType = "ContentID";
  } else {
    $error = "Table must be pulled!";
  }

  return $IDType;
}

/**
 * getRestrType will get the IDtype for the given table
 * @param  [String] $table: the selected table
 * @return [String] $restrType: the restrType for the selected table
 */
function getRestrType( $table ) {
  $restrType = "";

  if($table === "Users") {
    $restrType = "isUserRestricted";
  } else if($table === "Content") {
    $restrType = "isContentRestricted";
  } else {
    $error = "Table must be pulled!";
  }

  return $restrType;
}

/**
 * restrictRows will delete the selected rows from the specified table
 * @param  [string[]] $rowsSelected: the array containing the $IDType
 *  of the rows selected
 */
function restrictRows( $rowsSelected ) {
  $table = $_GET['table'];
  $count = 0;

  $IDType = getIDType($table);
  $restrType = getRestrType($table);

  $conn=mysqli_connect('localhost','unknown','security1#','social-site');

  foreach($rowsSelected AS $rowSelected) {
    if($checkboxID !== 'table' && $checkboxID !== 'modify') {
    $sql = "UPDATE $table SET $restrType = 1 WHERE $IDType='$rowSelected'";
    $result = mysqli_query($conn, $sql);
    if ($result) {$count++;}
  }
  }

  mysqli_close($conn);

  return $count;
}

/**
 * deleteRows will delete the selected rows from the specified table
 * @param  [string[]] $rowsSelected: the array containing the $IDType
 *  of the rows selected
 */
function deleteRows( $rowsSelected ) {
  $table = $_GET['table'];

  $IDType = getIDType($table);

  $conn=mysqli_connect('localhost','unknown','security1#','social-site');

  foreach($rowsSelected AS $rowSelected) {
    if($checkboxID !== 'table' && $checkboxID !== 'modify') {
    $sql = "DELETE FROM $table WHERE $IDType='$rowSelected'";
    $result = mysqli_query($conn, $sql);
  }
 }

  mysqli_close($conn);
}

/**
 * [modifyTable description]
 * @return [type] [description]
 */
function modifyTable() {
  if(!empty($_POST['modify'])) {
    if($_POST['modify']==="Delete") {
      $result = deleteRows($_POST);
    } else if($_POST['modify']==="Restrict") {
      $result = restrictRows($_POST);
    } else {
      $result = "Error has occured.";
    }
  } else {
      $result = "Error has occured.";
  }

  return $result;
}

/**
 * truncateTable will delete the data within a table,
 *  but will not delete the table itself.
 * @param  [string] $table: the table being truncated
 */
function truncateTable($table) {
  $conn=mysqli_connect('localhost','unknown','security1#','social-site');

  $sql = "TRUNCATE TABLE $table";
  $result = mysqli_query($conn, $sql);

  mysqli_close($conn);

  return $result;
}

/**
* purgeDB will truncate both tables, returning false if an error has occured
*/
function purgeDB() {
  $tb1result = truncateTable("Users");
  $tb2result = truncateTable("Content");

  return ($tb1result && $tb2result);
}

/**
 * [resetDBorTable description]
 * @return [String-or-boolean]$result:
 * Returns String if top level error occurs.
 * Returns false if error occured with db query
 * Returns true if no error has occured
 */
function resetDBorTable() {
  if(!empty($_POST['reset'])) {
    if($_POST['reset'] === "Reset Table") {
      $table = $_POST['table'];
      $result = truncateTable($table);
    } else if($_POST['reset'] === "Purge DB") {
      $result = purgeDB();
    } else {
      $result = "Unknown input.";
    }
  } else {
    $result = "No input.";
  }

  return $result;
}

/**
 * timeout function will log a user out after 10 minutes of inactivity
 */
 function timeout() {

   session_start();
   if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
     // request 10 minates ago
     session_destroy();
     session_unset();
   }
   $_SESSION['LAST_ACTIVITY'] = time();
 }

/**
 * login is used to log a user into their profile, Users will be redirected to their
 * homepage, admin will be directed to the admin controls homepage.
 * @return [String] $error: the error that has occured.
 */
 function login() {
   session_start();
   $error = "No error";

   if(isset($_POST['login']))
     if (empty($_POST['Username']) || empty($_POST['Password'])) {
       $error = "Username or Password is Blank";
     } else {
       $Username = $_POST['Username'];
       $Password = $_POST['Password'];

       $conn=mysqli_connect('localhost','unknown','security1#','social-site');

       $Username = htmlSpecialChars($Username);
       $Password = htmlSpecialChars($Password);

       $query = "SELECT * from Users where Password='$Password' AND Username='$Username'";
       $result = mysqli_query($conn, $query);

       $row=mysqli_fetch_assoc($result);

       $count=mysqli_num_rows($row);

       $Stored_Password = $row['Password'];
       $isAdmin = $row['isAdmin'];

       if ($rows === 1) {
         $comparePWs = strcmp($Password, $Stored_Password);

         if($comparePWs === 0) {
           $_SESSION['active_session'] = true;
           $_SESSION['login_user']=$_POST['Username'];

           ($isAdmin === 1)
            ? header("location: admin-page.php")
            : header("location: user-page.php");

         } else {
           $error = "Username or Password is invalid";
         }
       } else {
         $error = "Username or Password is invalid";
       }
       mysqli_close($ServerConnection);
     }

     return $error;
 }
?>
