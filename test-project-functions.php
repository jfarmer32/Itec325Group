<?php
error_reporting(E_ALL);
require_once("project-functions.php");

$testing = array(
  "SWS 1.0" => test( stripWhitespace("0 1  2       7    4"),
                                     "0 1 2 7 4"),
  "SWS 1.1" => test( stripWhitespace("\n0 1  2       7    4\n 50"),
                                     "0 1 2 7 4 50"),
  "SWS 1.2" => test( stripWhitespace("\t0 1  2       7    4\r 7"),
                                     "0 1 2 7 4 7"),
  "SWS 1.3" => test( stripWhitespace("        0 1  2       7    4     "),
                                     "0 1 2 7 4"),

  "IWK 0.0" => test( implodeWithKeys(array()), false),
  "IWK 1.0" => test( implodeWithKeys(array("Key" => "Value")), "\nKey: Value"),
  "IWK 2.0" => test( implodeWithKeys(array("Can't" => "Stop",
                                           "Won't" => "Stop,",
                                           "Should" => "Quit")),
                                         "\nCan't: Stop\nWon't: Stop,\nShould: Quit"),

  "asUL => 0.0" => test( asUL(array()), "\n<ul>\n</ul>"),
  "asUL => 1.0" => test( asUL(array("SPARTA")), "\n<ul>\n  <li>SPARTA</li>\n</ul>"),
  "asUL => 2.0" => test( asUL(array("THIS", "IS", "AN", "UNORDERED LIST")),
                          "\n<ul>\n"
                          . "  <li>THIS</li>\n"
                          . "  <li>IS</li>\n"
                          . "  <li>AN</li>\n"
                          . "  <li>UNORDERED LIST</li>\n"
                          . "</ul>")
                    );
testResults($testing, false);
?>
