<?php
require_once "date_day_difference.php";
$day_compare = new date_day_difference("2009-07-01");
$day_compare_result = $day_compare->init();
echo ($day_compare_result[0]==false)?"PASSED: ":"COMING: ";
echo "DAYS LEFT : ";
echo $day_compare_result[1];
?>