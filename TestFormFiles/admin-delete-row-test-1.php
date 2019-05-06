<?php
error_reporting(E_ALL);
$_POST = array("table" => "Users",
               "deleteID1" => "checked",
               "deleteID2" => "checked",
               "delete" => "true");

require('admin-show-table.php');
?>
