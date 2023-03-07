
<?php
// Connection establishment!
    require_once "includes/config.php";
?>

<?php 
//retriview the record that you want to update from the database:
$id = $_GET["id"];

$sql = "SELECT * FROM usage_data WHERE id = ?";

if($stmt = mysqli_prepare($link, $sql)){
    mysqli_stmt_bind_param($stmt, 'i',$id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        // store the retvieved data in variables
        $model = $row["model"];
        $buy_date = $row["buy_date"];
        $use_date = $row["use_date"];
        $alert_date = $row["alert_date"];
        $replace_date = $row["replace_date"];
        $buy_status = $row["buy_status"];
    } else {
        echo "Error: No record found with the provided ID";
        exit();
    }
    mysqli_stmt_close($stmt);
}else {
    die("Error:" . mysqli_error($link));
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>   
  <title>Printer | Updates </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form method="get" action="update-script.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <label>Model:</label>
    <input type="text" name="model" value="<?php echo $model; ?>"><br>
    <label>Buy Date:</label>
    <input type="date" name="buy_date" value="<?php echo $buy_date; ?>"><br>
    <label>Use Date:</label>
    <input type="date" name="use_date" value="<?php echo $use_date; ?>"><br>
    <label>Alert Date:</label>
    <input type="date" name="alert_date" value="<?php echo $alert_date; ?>"><br>
    <label>Replace Date:</label>
    <input type="date" name="replace_date" value="<?php echo $replace_date; ?>"><br>
    <label>Buy Status:</label>
    <input type="text" name="buy_status" value="<?php echo $buy_status; ?>"><br>
    <input type="submit" value="Update">
</form>



</body>
</html>

