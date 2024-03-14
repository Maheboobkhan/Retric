<?php

// Retrieve task data from form
$taskNames = $_POST['task_name'];
$startDates = $_POST['start_date'];
$endDates = $_POST['end_date'];
$dependencies = $_POST['dependency'];

// Include Gantt chart generation script
include 'gantt_chart.php';

// Generate Gantt chart
generateGanttChart($taskNames, $startDates, $endDates, $dependencies);

?>
