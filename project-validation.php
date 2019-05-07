<?php
/*
Group: require_once(teamname.php);
Last edited: 05/06/2019 (V1.2)
Last edited by: Justin Farmer
Purpose: provide validation functions for the grid-link project
*/
error_reporting(E_ALL);
require_once('admin-constants.php');
/** stringInvalidMsg : string, int, int, boolean -> string-or-false
  * Return an error-message (cannot contain html markup),
  * if $str longer than $maxAllowedLen
  * or if $str is empty and $fieldRequired===false.
  * Returns false, if there is no error-message to report.
  */
function stringInvalidMsg($str, $maxAllowedLength, $fieldRequired = true) {
  $problemsSoFar = "";
  $excessLen = (strlen($str) - $maxAllowedLength);

  if (strlen($str) === 0 && $fieldRequired) {
       $problemsSoFar .= "Field is empty. ";
  }
  if ($excessLen > 0) {
       $problemsSoFar .= "Can't be more than $maxAllowedLength characters long (it is "
                        . $excessLen . " character(s) too long).  ";
  }
  return ($problemsSoFar==="")  ?  false  :  $problemsSoFar;
}

/** dropDownInvalidMsg : string -> string-or-false
  * Returns an error message if dropdown has not been selected
  * ($msg === "Select One" || $msg === "")
  * Returns false if there is no error
  */
function dropDownInvalidMsg($msg, $fieldRequired = true) {
  return ($fieldRequired===true && $msg==="0" || $msg==="")
    ? "Must make a selection from dropdown menu.  "
    : false;
}

/** checkboxInvalidMsg : string[], string -> string-or-false
  * Returns an error message if checkbox is required, but not selected
  *  or if it is selected, but contains malicious input
  * Returns false if there is no error
  */
function checkboxInvalidMsg( $array, $key ) {
  $problemsSoFar = "";

  if (array_key_exists($key, $array) && $array[$key] !== "checked") {
     $problemsSoFar .= "Malicious input. (Go away, form tamperer!)";
   }

  return ($problemsSoFar !== "")
          ? $problemsSoFar
          : false;
}


/** addStringInvalidMsgToArray : string[], string, string[] -> string[]
* Returns $theMsgArray containing any string errors
*/
function addStringInvalidMsgToArray( $formInfo, $key, $theMsgArray ) {
  global $maxLengths;
  global $fieldRequired;

  $errMsg = stringInvalidMsg($formInfo[$key],
                             $maxLengths[$key],
                             $fieldRequired[$key]
                             );

  if ($errMsg !== false)
      $theMsgArray[$key] = $errMsg;

  return $theMsgArray;
}

/** addDropdownInvalidMsgToArray : string[], string, string[] -> string[]
  * Returns $theMsgArray containing any dropdown errors
  */
function addDropdownInvalidMsgToArray( $formInfo, $key, $theMsgArray) {
  global $fieldRequired;

  $errMsg = dropDownInvalidMsg( $formInfo[$key], $fieldRequired[$key]);
  if ($errMsg !== false)
   $theMsgArray[$key] = $errMsg;
  return $theMsgArray;
}

/** addCheckboxInvalidMessageToArray : string[], string, string[] -> string[]
  * Returns $theMsgArray containing any checkbox errors
  */
function addCheckboxInvalidMessageToArray( $formInfo, $key, $theMsgArray ) {

    $errMsg = checkboxInvalidMsg( $formInfo, $key );

    if ($errMsg !== false)
      $theMsgArray[$key] = $errMsg;

  return $theMsgArray;
}

/* validatePullRows : string[] -> string[]
 * Given form information for `admin-show-table.php -> tableForm',
 * return an array of all the error-messages,
 * indexed by the offending field.
 */
function validatePullRows( $formInfo ) {
    $allErrors = array();

    $allErrors = addDropdownInvalidMsgToArray( $formInfo, 'table', $allErrors);
    $allErrors = addDropdownInvalidMsgToArray( $formInfo, 'showOnly', $allErrors);
    $allErrors = addDropdownInvalidMsgToArray( $formInfo, 'filterByAge', $allErrors);
    $allErrors = addStringInvalidMsgToArray( $formInfo, 'userEntered', $allErrors);

    return (sizeof($allErrors) === 0)
     ? false
     : $allErrors;
  }

/* validateModify : string[] -> string[]
 * Given form information for `admin-show-table.php -> deleteForm',
 * return an array of all the error-messages,
 * indexed by the offending field.
 */
function validateModify( $checkboxIDs ) {
      if(sizeof($checkboxIDs) < 3) {
        $allErrors = array("deleteCB"=>"No rows selected.");
      } else {

        $allErrors = array();
        foreach($checkboxIDs AS $checkboxID => $deleteCB) {
          if($checkboxID !== 'table' && $checkboxID !== 'delete') {
            $allErrors = addCheckboxInvalidMessageToArray( $checkboxIDs, $checkboxID, $allErrors);
          }
        }
      }

    return (sizeof($allErrors) === 0)
     ? false
     : $allErrors;
}

/* validateDBM : string[] -> string[]
 * Given form information for `admin-show-table.php -> deleteForm',
 * return an array of all the error-messages,
 * indexed by the offending field.
 */
function validateDBM( $formInfo ) {
    $allErrors = array();

    if($formInfo['reset']==="Reset Table")
      $allErrors = addDropdownInvalidMsgToArray( $formInfo, 'table', $allErrors);

    return (sizeof($allErrors) === 0)
     ? false
     : $allErrors;
  }

/**
 * isInvalid will call the correct validation function for thr given form
 * @param  [String] $formInfo The form provided
 * @param  [String] $formID   The type of form
 * @return [String[]-or-false] Return String[] containing errors
 *  Return false if there are no errors
 */
function isInvalid( $formInfo, $formID ) {
  $allErrors = array();

  if($formID === "tableForm") {
    $allErrors = validatePullRows($formInfo);
  } else if($formID === "deleteForm") {
    $allErrors = validateModify($formInfo);
  } else if($formID === "dbMForm") {
    $allErrors = validateDBM($formInfo);
  } else {
    $allErrors = array("FORM-ERROR" => "Unrecongnized form.");
  }

  return (sizeof($allErrors) === 0)
   ? false
   : $allErrors;
}

/**
 * errorsAsList will return all of the errors as an unordered list
 * @param  [String[]] $errors: the array of errors encountered
 * @return [String-or-false] Returns a string containing the unordered list
 * Returns false if there are no errors.
 */
function errorsAsList($errors) {
  global $errorsList;

  $openUL = "\n<ul class='error'>\n";
  $lisSoFar = "<li>Errors encountered:</li>\n";
  $closeUL = "</ul>\n";

  foreach($errors AS $loc => $error) {
    if(array_key_exists($loc, $errorsList)) {
      $lisSoFar .= "   <li>" . $errorsList[$loc] . "</li>\n";
    } else {
      $lisSoFar .= "   <li>Unknown error at $loc : $error </li>\n";
    }
  }

  return ($lisSoFar === "")
    ? false
    : "$openUL$lisSoFar$closeUL";
  }

/**
 * errorContainer will return the errors wrapped in a container
 * @param  [String] $errorList: the errors as an unordered list
 * @return [String] the $errorList wrapped in an error container,
 *  if any errors are present.
 */
function errorContainer($errorList) {
  return ($errorList === "")
           ? false
           : "<div class = 'error'>\n$errorList</div>\n";
}

/**
 * handleSubmit, given a form array and a formID will check for errors existing
 *  in the form on submission, and return those errors in an errorContainer.
 * @param  [String[]] $formArray: the submitted form array
 * @param  [String] $formID: the type of form
 * @return [String] $errorDiv: the errors wrapped in a div
 */
function handleSubmit($formArray, $formID) {
  $errorList = "";

  if (isInvalid($formArray, $formID)) {
    $errorsArray = isInvalid($formArray, $formID);
    $errorList = errorsAsList($errorsArray);
    $errorDiv = errorContainer($errorList);
  } else {
    $errorDiv = errorContainer($errorList);
  }

  return $errorDiv;
}

/**
 * addErrorToPage, upon submission, will check which form was submitted and
 *  report any errors by returning the errors wrapped in a div. The div
 *  will be displayed at the bottom of the page and is displayed based on it's
 *  style (.error )
 * Returns the errorDiv if an error occurs
 * Returns false if no error has occured
 */
function addErrorToPage() {
$errorDiv = "";
$errorList = "";

  if(isset($_GET['adminSubmit'])) {
    $errorDiv = handleSubmit($_GET, "tableForm");
  } else if(isset($_POST['modify'])) {
    $errorDiv = handleSubmit($_POST, "deleteForm");
  } else if(isset($_POST['reset'])) {
    $errorDiv = handleSubmit($_POST, "dbMForm");
  } else {
    $errorDiv = false;
  }

  return $errorDiv;
}
?>
