<?php
/*
Group: require_once(teamname.php);
Last edited: 05/05/2019 (V1.2)
Last edited by: Justin Farmer
Purpose: provide test cases for validation functions for the grid-link project
*/
error_reporting(E_ALL);
require_once("project-validation.php");
require_once("project-functions.php");

$emptyArray = array();

$tbErrorForm = array("table" => "[Select Table]",
                     "showOnly" => "Show which data?",
                     "filterByAge" => "All content from the past:",
                     "userEntered" => "ThisNameIsAlmostTooLongOk",
                   );
$tbErrorArray = array("table" => "Must make a selection from dropdown menu.  ",
                      "userEntered" => "Can't be more than 20 characters long (it is 5 character(s) too long).  "
                   );

$dlRsErrorForm = array("deleteID1" => "checked",
                       "deleteID2" => "EVILCODE",
                       "deleteID3" => "EVILCODE",
                       "deleteID4" => "checked",
                  );
$dlRsErrorArray = array("deleteID2" => "Malicious input. (Go away, form tamperer!)",
                        "deleteID3" => "Malicious input. (Go away, form tamperer!)"
                  );

$dbMErrorForm = array("reset" => "reset-table",
                      "table" => "[Select Table]");
$dbMErrorArray = array("table" => "Must make a selection from dropdown menu.  ");

$testing = array(
  "SIM T0.1" => test( stringInvalidMsg("", 20, false), false),
  "SIM T0.2" => test( stringInvalidMsg("", 20, true),
                      "Field is empty. "),
  "SIM T1.0" => test( stringInvalidMsg("123456", 5, true),
                      "Can't be more than 5 characters long (it is 1 character(s) too long).  "),

  "DDIM T0.1" => test( dropDownInvalidMsg(""),
                       "Must make a selection from dropdown menu.  "),
  "DDIM T0.2" => test( dropDownInvalidMsg("[Select Table]"),
                       "Must make a selection from dropdown menu.  "),
  "DDIM T1.1" => test( dropDownInvalidMsg("Selected which data?"), false),
  "DDIM T1.2" => test( dropDownInvalidMsg("All content from the past:"), false),
  "DDIM T1.3" => test( dropDownInvalidMsg("some-selection"), false),

  "CBIM T0.1" => test( checkboxInvalidMsg(array(),
                                          "keyToFind"),
                       false),

  "CBIM T1.1" => test( checkboxInvalidMsg(array("deleteID1" => "checked"),
                                          "deleteID1",
                                          true),
                      false),

  "CBIM T1.2" => test( checkboxInvalidMsg(array("deleteID1" => "checked"),
                                          "deleteID1",
                                          true),
                       false),

  "CBIM T2.1" => test( checkboxInvalidMsg(array("deleteID1" => "checked",
                                                "deleteID2" => "checked"),
                                       "deleteID2",
                                       true),
                       false),
  "CBIM T2.2" => test( checkboxInvalidMsg(array("deleteID1" => "checked",
                                                "deleteID2" => "EVILCODE"),
                                      "deleteID1",
                                      true),
                      false),
  "CBIM T2.3" => test( checkboxInvalidMsg(array("deleteID1" => "EVILCODE",
                                                "deleteID2" => "checked"),
                                      "deleteID1",
                                      true),
                      "Malicious input. (Go away, form tamperer!)"),

 "addDDEr T0.1" => test( addDropdownInvalidMsgToArray(array("table" => "[Select Table]"),
                                                    "table",
                                                    array()),
                       array("table" => "Must make a selection from dropdown menu.  ") ),

 "addDDEr T1.1" => test( addDropdownInvalidMsgToArray(array("table" => "Users"),
                                                    "table",
                                                    array()),
                       array() ),
 "addDDEr T1.2" => test( addDropdownInvalidMsgToArray(array("showOnly" => "Select which data?"),
                                                    "showOnly",
                                                    array()),
                       array() ),
"addDDEr T1.3" => test( addDropdownInvalidMsgToArray(array("filterByAge" => "All content from the past:"),
                                                    "filterByAge",
                                                    array()),
                       array() ),

 "addSEr T0.1" => test( addStringInvalidMsgToArray(array("userEntered" => ""),
                                                 "userEntered",
                                                 array()),
                       array() ),

 "addSEr T1.1" => test( addStringInvalidMsgToArray(array("userEntered" => "NamesBob"),
                                                 "userEntered",
                                                 array()),
                       array() ),
 "addSEr T1.2" => test( addStringInvalidMsgToArray(array("userEntered" => "NamesBob,SpongeBobSquare"),
                                                 "userEntered",
                                                 array()),
                       array("userEntered" => "Can't be more than 20 characters long (it is "
                                            . "4 character(s) too long).  ") ),

 "addCBEr T1.1" => test( addCheckboxInvalidMessageToArray(array("deleteID1" => "EVILCODE"),
                                                          "deleteID1",
                                                          array()),
                         array("deleteID1" => "Malicious input. (Go away, form tamperer!)")),
 "addCBEr T1.1" => test( addCheckboxInvalidMessageToArray(array("deleteID1" => "checked"),
                                                          "deleteID1",
                                                          array()),
                         array() ),

 "allErs T0.1" => test( validatePullRows( $emptyArray ), false),
 "allErs T0.2" => test( validateDelete( $emptyArray ), false),
 "allErs T0.3" => test( validateDBM( $emptyArray ), false),

 "allErs T0.4" => test( valid( $emptyArray, "tableForm" ), false),
 "allErs T0.5" => test( valid( $emptyArray, "deleteForm" ), false),
 "allErs T0.6" => test( valid( $emptyArray, "dbMForm" ), false),

 "allErs T1.1" => test( validatePullRows( $tbErrorForm ), $tbErrorArray),
 "allErs T1.2" => test( validateDelete( $dlRsErrorForm ), $dlRsErrorArray),
 "allErs T1.3" => test( validateDBM( $dbMErrorForm ), $dbMErrorArray),

 "allErs T2.1" => test( valid( $tbErrorForm, "tableForm" ), $tbErrorArray),
 "allErs T2.2" => test( valid( $dlRsErrorForm, "deleteForm" ), $dlRsErrorArray),
 "allErs T2.3" => test( valid( $dbMErrorForm, "dbMForm" ), $dbMErrorArray),

 "allErs T3.1" => test( valid( $dbMErrorForm, "unknownForm" ),
                        array("FORM-ERROR" => "Unrecongnized form.")),

 "EAL T0.0" => test( errorsAsList($emptyArray), false),

 "EAL T1.1" => test( errorsAsList($tbErrorArray),
                     "\n<ul class='error'>\n"
                  .  "   <li>Table must be selected!</li>\n"
                  .  "   <li>Username is too long, must be 20 characters or less</li>\n"
                  .  "</ul>\n"),
 "EAL T1.2" => test( errorsAsList($dlRsErrorArray),
                     "\n<ul class='error'>\n"
                  .  "   <li>Unknown error at <deleteID2> : Malicious input. (Go away, form tamperer!) </li>\n"
                  .  "   <li>Unknown error at <deleteID3> : Malicious input. (Go away, form tamperer!) </li>\n"
                  .  "</ul>\n"),
 "EAL T1.3" => test( errorsAsList($dbMErrorArray),
                     "\n<ul class='error'>\n"
                  .  "   <li>Table must be selected!</li>\n"
                  .  "</ul>\n"),
);

testResults($testing, false);

?>
