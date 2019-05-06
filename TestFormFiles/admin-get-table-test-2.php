<?php
error_reporting(E_ALL);
$_GET = array("table" => "Users",
              "showOnly" => "Only Admin",
              "filterByAge" => "5 year",
              "userEntered" => "",
              "adminSubmit" => "true");

require('admin-show-table.php');
?>
