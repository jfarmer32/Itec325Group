<?php
/*
Group: require_once(teamname.php);
Last edited: 03/27/2019 (V1.4)
Last edited by: Justin Farmer
Purpose: This is file contains the test cases for the functions found in
  project-functions.php
*/
error_reporting(E_ALL);
require_once("project-functions.php");

$testing = array(
  "DWND 0.0" => test( divWithNestedDivs("wrapper", array()),
                                        false),
  "DWND 1.0" => test( divWithNestedDivs("someClass",
                                        array("newClass" => "Content")),
                            "<div class='someClass'>\n"
                          . "  <div class='newClass'>Content</div>\n"
                          . "</div>"),
  "DWND 2.0" => test( divWithNestedDivs("parentClass",
                                        array("class1" => "Content",
                                              "class2" => "Image",
                                              "class3" => "Unordered List")),
                        "<div class='parentClass'>\n"
                      . "  <div class='class1'>Content</div>\n"
                      . "  <div class='class2'>Image</div>\n"
                      . "  <div class='class3'>Unordered List</div>\n"
                      . "</div>"),

  "MH 0.0" => test( makeHeader(array()), false),
  "MH 1.0" => test( makeHeader(array("class1" => "Content")),
                            "<div class='header'>\n"
                          . "  <div class='class1'>Content</div>\n"
                          . "</div>"),
  "MH 2.0" => test( makeHeader(array("class1" => "Content",
                                     "class2" => "Image",
                                     "class3" => "Unordered List")),
                            "<div class='header'>\n"
                          . "  <div class='class1'>Content</div>\n"
                          . "  <div class='class2'>Image</div>\n"
                          . "  <div class='class3'>Unordered List</div>\n"
                          . "</div>"),

  "asUL 0.0" => test( asUL(array()), "<ul>\n</ul>"),
  "asUL 1.0" => test( asUL(array("SPARTA")), "<ul>\n  <li>SPARTA</li>\n</ul>"),
  "asUL 2.0" => test( asUL(array("THIS", "IS", "AN", "UNORDERED LIST")),
                          "<ul>\n"
                          . "  <li>THIS</li>\n"
                          . "  <li>IS</li>\n"
                          . "  <li>AN</li>\n"
                          . "  <li>UNORDERED LIST</li>\n"
                          . "</ul>"),

  "SWS 0.0" => test( stripWhitespace(""), ""),
  "SWS 1.0" => test( stripWhitespace("A"), "A"),
  "SWS 1.1" => test( stripWhitespace("\nApple\n"), "Apple"),
  "SWS 1.2" => test( stripWhitespace("\rApple\t"), "Apple"),
  "SWS 1.3" => test( stripWhitespace("  Apple  "), "Apple"),
  "SWS 1.4" => test( stripWhitespace("  Apple\n\n"), "Apple"),
  "SWS 1.5" => test( stripWhitespace("\tApple\r"), "Apple"),
  "SWS 2.0" => test( stripWhitespace("0 1  2       7    4"),
                                     "0 1 2 7 4"),
  "SWS 2.1" => test( stripWhitespace("\n0 1  2       7    4\n 50"),
                                     "0 1 2 7 4 50"),
  "SWS 2.2" => test( stripWhitespace("\t0 1  2       7    4\r 7"),
                                     "0 1 2 7 4 7"),
  "SWS 2.3" => test( stripWhitespace("        0 1  2       7    4     "),
                                     "0 1 2 7 4"),

  "IWK 0.0" => test( implodeWithKeys(array()), false),
  "IWK 1.0" => test( implodeWithKeys(array("Key" => "Value")), "\nKey: Value"),
  "IWK 2.0" => test( implodeWithKeys(array("Can't" => "Stop",
                                           "Won't" => "Stop,",
                                           "Should" => "Quit")),
                                         "\nCan't: Stop\nWon't: Stop,\nShould: Quit"),

  "MIG 0.0" => test( makeImgGrid("square.jpeg", 0, 0), false),
  "MIG 0.1" => test( makeImgGrid("square.jpeg", 1, 0), false),
  "MIG 0.2" => test( makeImgGrid("square.jpeg", 0, 1), false),

                    );
testResults($testing, false);
?>
