<?php
    session_start();
    if(isset($_SESSION['userType']))
    {
      if( $_SESSION['userType'] == "admin"){
        $accessType = 1;
      }
      else if( $_SESSION['userType'] == "employee"){
        $accessType = 0;
      }
    }
    else
    {
      header("Location: /HRMS/index.html");
    }
    include "../controller/db_connect.php";
?>

<?php

  function readTable()
  {
    if(isset($_GET['searchbar']) && !empty($_GET['searchbar']))
    {
      $category = $_GET['category'];
      global $connection;

      if($category=="jobId")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM job WHERE job_id LIKE '%$id%'";
      }
      elseif($category=="position")
      {
        $pos = $_GET['searchbar'];
        $query = "SELECT * FROM job WHERE position LIKE '%$pos%'";
      }
      elseif($category=="department")
      {
        $dept = $_GET['searchbar'];
        $query = "SELECT * FROM job WHERE department LIKE '%$dept%'";
      }

      $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result))
        {
          $jobId = $row['job_id'];
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

          echo "<tr>";
          if($accessType == 1)
          {
          echo "<td>{$jobId}</td>";
          }
          echo "<td>{$type}</td>";
          echo "<td>{$position}</td>";
          echo "<td>{$hourlyRate}</td>";
          echo "<td>{$overTimeRate}</td>";
          echo "<td>{$workHour}</td>";
          echo "<td>{$department}</td>";
          echo "<td>{$status}</td>";
          echo "</tr>";
        }
    }
    else
    {
      global $connection, $accessType;
      $query = "SELECT * FROM job";
      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $jobId = $row['job_id'];
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

          if($status==0) {
            $buttonStatus = "Activate";
            $status = "Deactive";

          }
          else {
            $buttonStatus = "Deactivate";
            $status = "Active";
          }

          echo "<tr>";
          if($accessType == 1)
          {
          echo "<td>{$jobId}</td>";
          }
          echo "<td>{$type}</td>";
          echo "<td>{$position}</td>";
          echo "<td>{$hourlyRate}</td>";
          echo "<td>{$overTimeRate}</td>";
          echo "<td>{$workHour}</td>";
          echo "<td>{$department}</td>";
          echo "<td>{$status}</td>";
          if($accessType == 1)
          {
            echo "<td><a class='btn btn-primary' style='color:white' href='JobModify.php?update={$jobId}'>Update</a></td>";
            echo "<td><a class='btn btn-primary' style='color:white' href='JobManagement.php?access={$jobId}&stat={$buttonStatus}'>$buttonStatus</a></td>";
            echo "<td><a class='btn btn-primary' style='color:white' href='JobManagement.php?delete={$jobId}'>Delete</a></td>";
          }
          echo "</tr>";
        }
      }
  }

  if(isset($_GET['delete']))
  {
    $id = $_GET['delete'];
    delete($id);
  }

  if(isset($_GET['access']))
  {
    $id = $_GET['access'];
    $stat = $_GET['stat'];
    modifyAccess($id, $stat);
  }

  if(isset($_GET['create']))
  {
    //header("Location: http://localhost/HRMS/");
  }

  function modifyAccess($id, $stat)
  {
    if($stat=="Activate")
    {
      $val = 1;
    }
    else
    {
      $val = 0;
    }
    global $connection;
    $query1 = "UPDATE job SET status = '$val' WHERE job_id = '$id'";
    $result1 = mysqli_query($connection, $query1);
    if(!$result1)
    {
      die("Querry Failed".mysqli_error($connection));
    }
    else {
      if($val==0)
      {
        $query1 = "UPDATE employee SET status = '$val' WHERE job_id = '$id'";
        $result1 = mysqli_query($connection, $query1);
        if(!$result1)
        {
          die("Querry Failed".mysqli_error($connection));
        }
        else {
          //echo "Updated";
        }
      }
    }
  }

  function delete($id)
  {
    global $connection;
    $query2 = "DELETE FROM job WHERE job_id = '$id'";
    $result2 = mysqli_query($connection, $query2);
    if(!$result2)
    {
      die("Querry Failed".mysqli_error($connection));
    }
    else {
      //echo "Delete";
    }
  }

?>


<html lang="en">

<?php
  if($_SESSION['userType'] == "admin"){
      include "header-admin.php";
  }
  else{
    include "header.php";
  }
   ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b>Offered Job List</b></span>
            </h3>
        </div>
        <div class="row-12">
          <form action"">
            <h5>
              <div class=".col-9">
                <input class="form-control" type="text" name="searchbar" value="" placeholder="Select the search category">
              </div>
              <div class=".col-3">
                <select class="form-control" id="category" name="category">
                  <option value="jobId">Job ID</option>
                  <option value="position">Position</option>
                  <option value="department">Department</option>
                </select>
                <input class="btn btn-primary" type="submit" name="submit" value="Search">
              </div>
              <br>
              <div class="col-xs-6">
                <table style="color:white" class="table table-bordered">
                  </thread>
                    <tr>
                      <?php
                      if($accessType == 1)
                      {
                        echo '<th>Job ID</th>';
                      }
                      ?>
                      <th>Type</th>
                      <th>Position</th>
                      <th>Hourly Rate</th>
                      <th>Over Time Rate</th>
                      <th>Work Hour (Per Week)</th>
                      <th>Department</th>
                      <th>Status</th>
                    </tr>
                  </thread>
                  <tbody>
                    <?php readTable(); ?>
                  </tbody>
                </table>
                <?php
                if($accessType == 1)
                {
                  echo '<button type="submit" class="btn btn-primary" name="create" formaction="JobModify.php">Create</button>';
                }
                ?>
              </div>
            </h5>
          </form>
        </div>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
