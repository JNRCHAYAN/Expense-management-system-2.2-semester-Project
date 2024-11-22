<?php
// Assuming the selected month is passed, for example, '03' for March
$selectedMonth = $_POST['month'] ?? '03'; // Defaulting to '03' if no selection is made

// Create a DateTime object using the selected month
$date = DateTime::createFromFormat('m', $selectedMonth);

// Get the full month name (e.g., March)
$monthName = $date->format('F');

// Print the month name
echo $monthName;
?>
