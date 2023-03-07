<?php
require_once "includes/config.php";

// Define variables and initialize with empty values
$buy_date = $use_date = $alert_date = $replace_date = $buy_status = $model =  "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "GET"){

    // Prepare an insert statement
    $sql = "INSERT INTO usage_data (model, buy_date, use_date, alert_date, replace_date, buy_status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($link, $sql);
    if (!$stmt) {
        die("Error: " . mysqli_error($link));
    }

    // Bind variables to the prepared statement
    mysqli_stmt_bind_param($stmt, "ssssss", $model, $buy_date, $use_date, $alert_date, $replace_date, $buy_status);

    // Set parameters
    $buy_date = trim($_GET["buy_date"]);
    $use_date = trim($_GET["use_date"]);
    $alert_date = trim($_GET["alert_date"]);
    $replace_date = trim($_GET["replace_date"]);
    $buy_status = trim($_GET["buy_status"]);
    $model = trim($_GET["model"]);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)){
        header("location: index.php");
        exit();
    } else {
        die("Error: " . mysqli_error($link));
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
