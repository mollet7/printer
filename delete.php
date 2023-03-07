<?php
// Connection establishment!
require_once "includes/config.php";

// check if the id parameter is set in the URL
if(isset($_GET["id"])){
    // retrieve the record that you want to delete from the database
    $id = $_GET["id"];

    $sql = "SELECT * FROM usage_data WHERE id = ?";

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        // store the retrieved data in variables
        $model = $row["model"];
        $buy_date = $row["buy_date"];
        $use_date = $row["use_date"];
        $alert_date = $row["alert_date"];
        $replace_date = $row["replace_date"];
        $buy_status = $row["buy_status"];

    mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($link);
    }

        $sql = "DELETE FROM usage_data WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);

            // show a success message
            echo "<script>";
            echo "alert('Record deleted successfully!');";
            echo "window.location.href='index.php';";
            echo "</script>";
        } else {
            echo "Error: " . mysqli_error($link);
        }

        mysqli_stmt_close($stmt);
    
} else {
    echo "Error: id parameter not set.";
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>   
  <title>Printer | Delete </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<form method="post">
    <h2>Are you sure you want to delete this record?</h2>
    <p>Model: <?php echo $model; ?></p>
    <p>Buy Date: <?php echo $buy_date; ?></p>
    <p>Use Date: <?php echo $use_date; ?></p>
    <p>Alert Date: <?php echo $alert_date; ?></p>
    <p>Replace Date: <?php echo $replace_date; ?></p>
    <p>Buy Status: <?php echo $buy_status; ?></p>
    <input type="submit" value="Yes" onclick="return confirm('Are you sure you want to delete this record?')">
    <button type="button" onclick="window.location.href='index.php'">No</button>
</form>
</body>
</html>
