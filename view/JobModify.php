<?php
  session_start();
  if( $_SESSION['userType'] != "admin"){
    header("Location: /HRMS/index.html");
  }
  include "../controller/db_connect.php";

  $func="Create";
  $jobId = $type = $status = $position = $hourlyRate = $overTimeRate = $workHour = $department = "";
  if(isset($_GET['update']))
  {
    $jobId = $_GET['update'];
    $func = "Update";
    readData($jobId);
  }

  function readData($id)
  {
    global $connection, $type, $status, $position, $hourlyRate, $overTimeRate, $workHour, $department;
    $query = "SELECT * FROM job WHERE job_id = '$id'";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $type = $row['type'];
      $status = $row['status'];
      $position = $row['position'];
      $hourlyRate = $row['hourly_rate'];
      $overTimeRate = $row['over_time_rate'];
      $workHour = $row['work_hour'];
      $department = $row['department'];

      if($type==1) {
        $type = "Full Time";
      }
      else {
        $type = "Part Time";
      }

      if($status==1) {
        $status = "Active";

      }
      else {
        $status = "Deactive";
      }
    }
  }

  if(isset($_POST['submit']))
  {
    $type = $_POST['type'];
    $status = $_POST['status'];
    $position = $_POST['position'];
    $hourlyRate = $_POST['hourly_rate'];
    $overTimeRate = $_POST['over_time_rate'];
    $workHour = $_POST['work_hour'];
    $department = $_POST['department'];

    if(strtolower($status)=="active" || $status == '1')
    {
      $status = 1;
    }
    else
    {
      $status = 0;
    }

    if(strtolower($type)=="full time" || $type == '1') {
      $type = 1;
    }
    else {
      $type = 0;
    }


    if($func=="Create")
    {
      global $connection;
      $query = "INSERT INTO job (job_id, type, status, position, hourly_rate, over_time_rate, work_hour, department)";
      $query.= " VALUES ('$jobId', '$type', '$status', '$position', '$hourlyRate', '$overTimeRate', '$workHour', '$department')";
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
      $query = "UPDATE job SET type = '$type', status = '$status', position = '$position', hourly_rate = '$hourlyRate', over_time_rate = '$overTimeRate', work_hour = '$workHour', department = '$department' WHERE job_id = '$jobId';";
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
              <span style="color:turquoise"><b><?php echo $func; ?> Job</b></span>
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

      <form action"JobManagement.php" method="post">
      <div class="form-group">
      <table border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td class="label" style="color:#6ddad3">Job ID:</td>
          <td><input name="job_id" type="text" value="<?php echo $jobId; ?>" disabled/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Status</td>
          <td><input class="form-control" name="status" type="text" value="<?php echo $status; ?>" required/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Type</td>
          <td><input class="form-control" name="type" type="text" value="<?php echo $type; ?>" required/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Position</td>
          <td><input class="form-control" name="position" type="text" value="<?php echo $position; ?>" required/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Department</td>
          <td><input class="form-control" name="department" type="text" value="<?php echo $department; ?>" required/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Work Hour</td>
          <td><input class="form-control" name="work_hour" type="text" value="<?php echo $workHour; ?>" required/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Hourly Rate</td>
          <td><input class="form-control" name="hourly_rate" type="text" value="<?php echo $hourlyRate; ?>"  required/></td>
       </tr>

       <tr>
         <td class="label" style="color:#6ddad3">Over Time Rate</td>
         <td><input class="form-control" name="over_time_rate" type="text" value="<?php echo $overTimeRate; ?>"  required/></td>
      </tr>

      </table>
      <br>
      <input class="btn btn-primary" type="submit" name="submit" value="<?php echo $func; ?>">
      <input class="btn btn-primary" type="submit" name="back" value="Back" formaction="JobManagement.php">
    </div>
  </form>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
