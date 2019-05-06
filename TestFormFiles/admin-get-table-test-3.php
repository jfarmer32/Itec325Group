<?php
error_reporting(E_ALL);
$_GET = array("table" => "Content",
              "showOnly" => "Only Restricted",
              "filterByAge" => "5 year",
              "userEntered" => "",
              "adminSubmit" => "true");

require('admin-show-table.php');
?>
