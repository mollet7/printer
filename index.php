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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/print-styles.css" media="print">
</head>
<style>
    .status-one {
        background-color: blue;
        color: white;
    }
    .status-two {
        background-color: green;
        color: white;
    }

    .status-three {
        background-color: black;
        color: white;
    }
    
</style>
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
                        <a href="submit-data.php" class="btn btn-success pull-right hide-print"><i class="fa fa-plus"></i> Add another Toner</a>
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
                                        <th class="hide-print">Action</th>
                                   </tr>
                                </thead>
                                <tbody> 
                           <?php 
                            $counter = 1;
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

                                // logic ya kuangalia kama imetumika ama laa!
                                if ($use_date == '2023-01-01' && $replace_date == $default_date) {
                                    echo "<b class='status-one'>NOT USED</b>";
                                }elseif ($use_date > $default_date && $replace_date == $default_date) {
                                    echo "<b class='status-two'>IN USE</b>";
                                }elseif($replace_date >= $use_date && $replace_date != $default_date) {
                                    echo "<b class='status-three'>REPLACED</b>";
                                }
                           }
                           ?>
                            <?php  while($row = mysqli_fetch_array($result)){ ?>
                                   <tr> 
                                        <td id="counter"> <? echo  $counter;?></td>
                                        <td> <? echo $row['model']; ?></td>
                                        <td id="buyDate<? echo $row['id']; ?>" ><? echo $row['buy_date']; ?></td>
                                        <td id="useDate<? echo $row['id']; ?>" ><? echo $row['use_date']; ?></td>
                                        <td id="alertDate<? echo $row['id']; ?>" ><? echo $row['alert_date']; ?></td>
                                        <td id="replaceDate<? echo $row['id']; ?>" ><? echo $row['replace_date']; ?></td>
                                        <td id="buy_Status<? echo $row['id']; ?>" ><? echo $row['buy_status']; ?></td>
                                        <td id="toner_status<? echo $row['id']; ?>" name="toner_status"><?php toner_status($row['buy_date'],$row['use_date'],$row['replace_date']); ?></td>
                                        <td class="hide-print">
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
                            <button onclick = "window.print()" class="hide-print">Print</button>
                         <?   } else { ?>
                                <div class="alert alert-danger hide-print"><em>No records were found.</em></div>
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
  <a href="submit-data.php"><button type="button" class="btn btn-primary btn-block hide-print"><i class="fa fa-plus"></i>Add Toner</button> </a>
</div>

</body>

</html>

