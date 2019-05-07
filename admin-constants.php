<?php
/*
Group: require_once(teamname.php);
Last edited: 05/06/2019 (V1.2)
Last edited by: Justin Farmer
Purpose: This file contains all constants for admin validation
*/
$fieldRequired = array( 'userEntered' => false
                      , 'table' => true
                      , 'showOnly' => false
                      , 'filterByAge' => false );

$maxLengths = array( 'userEntered' => 20 );

$errorsList = array( 'table' => "Table must be selected!",
                     'userEntered' => "Username is too long, must be 20 characters or less.",
                     'deleteCB' => "Rows must first be pulled and selected.");
?>
