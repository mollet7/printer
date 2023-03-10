<?php
    require_once "includes/config.php";
?>
<?php
function toner_status($buy_date, $use_date, $replace_date){
                                $buy_date_object = new DateTime($buy_date);
                                $buy_date = $buy_date_object -> format ('Y-m-d');

                                $use_date_object = new DateTime($use_date);
                                $use_date = $use_date_object -> format ('Y-m-d');

                                $replace_date_object = new DateTime($replace_date);
                                $replace_date = $replace_date_object -> format ('Y-m-d');

                                $default_date = '2023-01-01';
                                $default_date_object = new DateTime($default_date);
                                $default_date = $default_date_object -> format ('Y-m-d');

                                // logic
                                if ($replace_date == '2023-01-01') {
                                    echo "<b class='status-one'>NOT USED</b>";
                                }elseif ($use_date > $default_date) {
                                    echo "<b class='status-two'>IN USE</b>";
                                }elseif($replace_date >= $use_date && $replace_date != $default_date) {
                                    echo "<b class='status-three'>REPLACED</b>";
                                }
                           }

    function day_used($buy_date,$replace_date){
        $buy_date_object = new DateTime($buy_date);
        //$buy_date = $buy_date_object -> format ('Y-m-d');

        $replace_date_object = new DateTime($replace_date);
        //$replace_date = $replace_date_object -> format ('Y-m-d');

        $interval = $buy_date_object ->diff($replace_date_object);
        echo $interval->format('%a days');
    }
?>

<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
  
    // Prepare a select statement
    $sql = "SELECT * FROM usage_data WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $id = $row["id"];
                $model = $row["model"];
                $buy_date = $row["buy_date"];
                $use_date = $row["use_date"];
                $alert_date = $row["alert_date"];
                $replace_date = $row["replace_date"];
                $buy_status = $row["buy_status"];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Printer | Views </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1> 
                    <div class="form-group">
                        
                     <p>
                     <label>Model</label>: <b><?php echo $row["model"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                        <p><label>Buy Date</label>: <b id="buy_date"><?php echo $row["buy_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                        <p><label>Use Date</label>: <b id="use_date"><?php echo $row["use_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                        <p><label>Alert Date</label>: <b><?php echo $row["alert_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                        <p><label>Replace Date</label>: <b id="replace_date"><?php echo $row["replace_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        
                        <p><label>Buy status</label>: <b><?php echo $row["buy_status"]; ?></b></p>
                    </div>
                    <label for="status">Toner Status</label> : <span id="toner_status"><?php toner_status($row['buy_date'],$row['use_date'],$row['replace_date']);?></span>
                    <label for="day_used">Day Used</label> : <span><?php day_used($row['buy_date'],$row['replace_date']);?></span>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</div>

<pre>
    <code>
        console.log("Hello");
        console.log("Name");
    </code>
</pre>

</body>
</html>

