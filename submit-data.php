<?php
    require_once "includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Printer | Records</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Fill the required data</h2>
  <form action="action_page.php" method="get">
    <div class="form-group">
    <label for="model">Model:</label>
      <input type="text" class="form-control" id="model" placeholder="Enter Model Number" name="model">

      <label for="buy_date">Buy Date:</label>
      <input type="date" class="form-control" id="buy_date" placeholder="Enter Date of buying" name="buy_date">

      <label for="use_date">Use Date:</label>
      <input type="date" class="form-control" id="use_date" placeholder="Enter Date of using" name="use_date" value="2023-01-01" >

      <label for="alert_date">Alert Date:</label>
      <input type="date" class="form-control" id="buy_date" placeholder="Enter Date of alert" name="alert_date" value="2023-01-01" >

      <label for="replace_date">Replace Date:</label>
      <input type="date" class="form-control" id="replace_date" placeholder="Enter Date of breplace" name="replace_date" value="2023-01-01" >

      <label for="buy_status">Buy status</label>
      <select name="buy_status" id="buy_status" class="form-control" >
        <option value="brand-new">Brand New</option>
        <option value="compatible">Compatible</option>
     </select>

     <label for="toner_status">Replace Date:</label>
      <input type="text" class="form-control" id="toner_status" name="toner_status" value="NEW">


    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
