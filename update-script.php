<?php
// Connection establishment!
    require_once "includes/config.php";
?>
<?php
// When the user submits the form, validate the input data and update the record in the database:
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        // Validate inputed data
        $model = trim($_GET["model"]);
        $buy_date = trim($_GET["buy_date"]);
        $use_date = trim($_GET["use_date"]);
        $alert_date = trim($_GET["alert_date"]);
        $replace_date = trim($_GET["replace_date"]);
        $buy_status = trim($_GET["buy_status"]);
        
        // Update the record in the database
        $sql = "UPDATE usage_data SET model=?, buy_date=?, use_date=?, alert_date=?, replace_date=?, buy_status=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "ssssssi",$model, $buy_date, $use_date, $alert_date, $replace_date, $buy_status, $id);
            if (mysqli_stmt_execute($stmt)){
                  // show success modal if update was successful
                // Redirect to the index page 
                echo '<script>
                   
                    document.body.alert = "SUCCESS!";
                
                    </script> ';

                header("location: index.php");
                exit();
                
                
            }else {
                echo ("Error:".mysqli_error($link));
            }
            
        }
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <h1 id="result"></h1>
</body>
</html>