<?php
error_reporting(E_ALL);
$_GET = array("table" => "Users",
              "showOnly" => "All data",
              "filterByAge" => "1 year",
              "userEntered" => "bobOver9000",
              "adminSubmit" => "true");

require('admin-show-table.php');
?>
