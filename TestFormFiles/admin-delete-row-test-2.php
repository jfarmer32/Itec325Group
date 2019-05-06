<?php
error_reporting(E_ALL);
$_POST = array("table" => "Content",
               "deleteID1" => "EVILCODE",
               "deleteID2" => "EVILCODE",
               "delete" => "true");

require('admin-show-table.php');
?>
