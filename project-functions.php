<?php
/*  @group require_once(teamname.php);
*   @author Justin Farmer, [Add name before pushing back]
*   @course itec325-2019spring
*   @assignment 325 Group Project
*
* This is the Admin Page, where admin can do admin things
*/
error_reporting(E_ALL);

/**
 * asUL takes in an array of strings and returns those stings in a UL
 * @param  [array] $listItems the array containing the list items
 * @return [string] The string containing HTML code for an unordered list
 */
function asUL($listItems) {
  $liSoFar = "";

  foreach($listItems AS $listItem)
    $liSoFar .= "  <li>$listItem</li>\n";

  return "\n<ul>\n$liSoFar</ul>";
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
function testResults($results, $printAllTests) {
  $failed = $total = 0;

  foreach($results AS $test => $result) {
    ++$total;

    if($printAllTests === true) {
       if($result === "Pass")
          echo "\nTest# $total : $test => Pass";
       else {
          echo "\n\nTest# $total : $test => *Fail*\n"
             . "\n > $test failed:\n$result";
          ++$failed;
       }

    } else if($printAllTests === false && $result !== "Pass") {
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
