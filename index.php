<?php
    require_once "includes/config.php";

?>
<?php
// Initialize the session
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Printer | Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Printer Toner Records</h2>
  <p>Printers toner tracking database!</p>            
  <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Toner Details</h2>
                        <a href="submit-data.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add another Toner</a>
                    </div>
                   
                    
                <?php   // Attempt select query execution
                    $column_to_sort = "model , buy_date";
                    $limit = 100; // Number of results per page
                    $page = $_GET['page'] ?? 1; // Current page number
                    $offset = ($page - 1) * $limit; // Offset for SQL query
                    $sql = "SELECT * FROM usage_data ORDER BY $column_to_sort ASC ";
                    
                    if($result = mysqli_query($link, $sql)){
                        $rows = mysqli_num_rows($result);
                        if(mysqli_num_rows($result) > 0){ ?>
                        
                           <table class="table table-bordered table-striped table-hover" id="dataTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Model</th>
                                        <th>Buying Date</th>
                                        <th>Use Date</th>
                                        <th>Alert Date</th>
                                        <th>Replace Date</th>
                                        <th>Buy Status</th>
                                        <th>Toner Status</th>
                                        <th>Action</th>
                                   </tr>
                                </thead>
                                <tbody> 
                           <?php 
                            $counter = 1;
                           ?>
                            <?php  while($row = mysqli_fetch_array($result)){ ?>
                                   <tr>
                                        <td> <? echo  $counter;?></td>
                                        <td> <? echo $row['model']; ?></td>
                                        <td id="buyDate<? echo $row['id']; ?>" ><? echo $row['buy_date']; ?></td>
                                        <td id="useDate<? echo $row['id']; ?>" ><? echo $row['use_date']; ?></td>
                                        <td id="alertDate<? echo $row['id']; ?>" ><? echo $row['alert_date']; ?></td>
                                        <td id="replaceDate<? echo $row['id']; ?>" ><? echo $row['replace_date']; ?></td>
                                        <td id="buyStatus"> <? echo $row['buy_status']; ?></td>
                                        <td id="toner_status><? echo $row['id']; ?>" name="toner_status">no status</td>
                                        <td>
                                            <a href="view.php?id=<? echo $row['id']; ?>" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>
                                            <a href="update.php?id=<? echo $row['id'];?>" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>
                                            <a href="delete.php?id=<? echo $row['id'];?>" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>
                                        </td>
                                    </tr>
                                    <? $counter++; ?>
                               <? } ?>
                               
                                </tbody>                          
                           </table>
                        <?php
                            
                            // Free result set
                            mysqli_free_result($result); ?>
                         <?   } else { ?>
                                <div class="alert alert-danger"><em>No records were found.</em></div>
                       <? }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
  <a href="submit-data.php"><button type="button" class="btn btn-primary btn-block"><i class="fa fa-plus"></i>Add Toner</button> </a>
</div>

</body>

<script>
window.addEventListener('load',function() {
    //Get the number of table rows
    const table = document.getElementById('dataTable');
    const numRows = table.rows.length;
    console.log(numRows);

    //Get webpage element tag 
    for (let i = 0; i < numRows; i++) {
        console.log(numRows);
        console.log(`This is paragraph ${i}`);

        
    }
});
</script>
</html>

