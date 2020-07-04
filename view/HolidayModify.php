<?php
  session_start();
  if( $_SESSION['userType'] != "admin"){
    header("Location: /HRMS/index.html");
  }
  include "../controller/db_connect.php";

  $func="Create";
  $holidayId = $holidayName = $date = $bonus = "";
  if(isset($_GET['update']))
  {
    $Id = $_GET['update'];
    $func = "Update";
    readData($Id);
  }

  function readData($id)
  {
    global $connection, $holidayId, $holidayName, $date, $bonus;
    $query = "SELECT * FROM holiday WHERE holiday_id = '$id'";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $holidayId = $row['holiday_id'];
      $holidayName = $row['holiday_name'];
      $date = $row['day'];
      $bonus = $row['bonus'];
    }
  }

  if(isset($_POST['submit']))
  {
    $holidayId = $_POST['holidayId'];
    $holidayName = $_POST['holiday'];
    $date = $_POST['date'];
    $bonus = $_POST['bonus'];

    if($func=="Create")
    {
      global $connection;
      $query = "INSERT INTO holiday (holiday_id, holiday_name, day, bonus)";
      $query.= " VALUES ('$holidayId', '$holidayName', '$date', '$bonus')";
      $result = mysqli_query($connection, $query);

      if(!$result)
      {
        die("Failed to insert". mysqli_error($connection));
      }
      else {
        //echo "Data Inserted";
      }
    }
    elseif($func=="Update")
    {
      global $connection;
      $query = "UPDATE holiday SET holiday_id = '$holidayId', holiday_name = '$holidayName', day = '$date', bonus = '$bonus' WHERE holiday_id = '$Id';";
      $result = mysqli_query($connection, $query);
      if(!$result)
      {
        die("Querry Failed".mysqli_error($connection));
      }
      else {
        //echo "Updated";
      }
    }
  }

?>

<html lang="en">

<?php include "header-admin.php"; ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b><?php echo $func; ?> Holiday</b></span>
            </h3>
        </div>

        <style>
            input[type=text] {
              border: none;
              outline: none;
              background-color:#2a3f5b;
              color:#6ddad3;
            }
        </style>

      <form action"HolidayManagement.php" method="post">
      <div class="form-group">
      <table border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td class="label" style="color:#6ddad3">ID:</td>
          <th><input class="form-control" name="holidayId" type="text" value="<?php echo $holidayId; ?>" required/></th>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Holiday</td>
          <th><input class="form-control" name="holiday" type="text" value="<?php echo $holidayName; ?>" required/></th>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Date</td>
          <th><input class="form-control" name="date" type="text" value="<?php echo $date; ?>" required/></th>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Bonus (%)</td>
          <th><input class="form-control" name="bonus" type="text" value="<?php echo $bonus; ?>" required/></th>
        </tr>

      </table>
      <br>
      <input class="btn btn-primary" type="submit" name="submit" value="<?php echo $func; ?>">
      <input class="btn btn-primary" type="submit" name="back" value="Back" formaction="HolidayManagement.php">
    </div>
  </form>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
