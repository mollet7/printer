<?php
$date1 = '2023-03-10'; // first date in yyyy-mm-dd format
$date2 = '2023-03-15'; // second date in yyyy-mm-dd format

$seconds_diff = strtotime($date2) - strtotime($date1);
$days_diff = floor($seconds_diff / (60 * 60 * 24));

echo 'Date 1: '.$date1.'<br>';
echo 'Date 2: '.$date2.'<br>';
echo 'Days Difference: '.$days_diff;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tester!</title>
</head>
<body>
  
</body>
</html>