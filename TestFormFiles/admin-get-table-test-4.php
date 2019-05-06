<?php
error_reporting(E_ALL);
$_GET = array("table" => "[Select Table]",
              "showOnly" => "Include which data?",
              "filterByAge" => "All content from the past:",
              "userEntered" => "",
              "adminSubmit" => "true");

require('admin-show-table.php');
?>
