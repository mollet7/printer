<?php
    require_once "includes/config.php";
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
                    <label for="status">Toner Status</label> : <span id="toner_status"></span>
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

<script>
    // inputs from webpages and new assigned
    const default_date = '2023-01-01';
    const buy_date = document.getElementById('buy_date').textContent;
    console.log(buy_date);
    const use_date = document.getElementById('use_date').textContent;
    const replace_date = document.getElementById('replace_date').textContent;
    const toner_status = document.getElementById('toner_status');

    //processing the inputed data

    function checkStatus(){
        if (buy_date > default_date){
            console.log('NOT USED')
            let  result = 'NOT USED';
            toner_status.textContent = result;
        } else if (use_date > default_date){
            console.log('IN USE')
            let result = 'IN USE';
            toner_status.textContent = result;
        } else if (replace_date > default_date){
            console.log('REPLACED')
            let result = 'REPLACED';
            toner_status.textContent = result;
        } else {
            console.log('Your Logic Error!')
        }   
    }
    checkStatus()

  
    



</script>


<script>
    /* var notUsed = localStorage.getItem('notUsed');
    document.getElementById('toner_status<?php echo $row['id']; ?>').innerText = notUsed;
    console.log(notUsed);

    var inUse = localStorage.getItem('inUse');
    document.getElementById('toner_status').innerText = inUse;
    console.log(inUse);

    var replace = localStorage.getItem('replace');
    document.getElementById('toner_status').innerText = replace;
    console.log(replace); */

    /* var notUsed = localStorage.getItem('notUsed');
    document.getElementById('toner_status<?php echo $row['id']; ?>').innerText = notUsed;
    console.log(notUsed);

    var inUse = localStorage.getItem('inUse');
    document.getElementById('toner_status<?php echo $row['id']; ?>').innerText = inUse;
    console.log(inUse);

    var replace = localStorage.getItem('replace');
    document.getElementById('toner_status<?php echo $row['id']; ?>').innerText = replace;
    console.log(replace); */
</script>