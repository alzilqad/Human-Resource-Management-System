<?php
    session_start();
    if( $_SESSION['userType'] != "employee"){
      header("Location: /HRMS/index.html");
    }
    include "../controller/db_connect.php";
?>

<?php

  function readTable()
  {
    global $connection;
    $empId = $_SESSION['emp_id'];
    $updateFlag = false;

    //filtering from salaryhistory table onclick Search Button
    if(isset($_GET['searchbar']) && !empty($_GET['searchbar']))
    {
      $category = $_GET['category'];
      if($category=="date")
      {
        $date = $_GET['searchbar'];
        $query = "SELECT * FROM salaryhistory WHERE month LIKE '$date%' AND empid = '$empId'";
      }
      $result = mysqli_query($connection, $query);
    }
    //read from salaryhistory table onclick Search Button
    else
    {
      $query = "SELECT * FROM salaryhistory WHERE empid = '$empId'";
      $result = mysqli_query($connection, $query);
    }

    //view
    while($row = mysqli_fetch_assoc($result))
    {
      $histId = $row['histid'];
      $totalWorkHour = $row['work_hour'];
      $totalOverTimeHour = $row['over_time_hour'];
      $totalSalary = $row['salary'];
      $date = $row['month'];
      //sorting date to Month, Year
      $date = strtotime($date);
      $viewDate = date('M, Y', $date);
      $date = date('Y-m', $date);

      $query1 = "SELECT * FROM employee WHERE emp_id = '$empId'";
      $result1 = mysqli_query($connection, $query1);
      $row1 = mysqli_fetch_assoc($result1);
      $jobId = $row1['job_id'];

      $query2 = "SELECT * FROM job WHERE job_id = '$jobId'";
      $result2 = mysqli_query($connection, $query2);
      $row2 = mysqli_fetch_assoc($result2);
      $department = $row2['department'];
      $position = $row2['position'];

      echo "<tr>";
      echo "<td>{$department}</td>";
      echo "<td>{$position}</td>";
      echo "<td>{$viewDate}</td>";
      echo "<td>{$totalWorkHour}</td>";
      echo "<td>{$totalOverTimeHour}</td>";
      echo "<td>{$totalSalary}</td>";
      echo "</tr>";
    }
  }

?>


<html lang="en">

<?php include "header.php"; ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b>Salary Report</b></span>
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
                  <option value="date">Date</option>
                </select>
                <input class="btn btn-primary" type="submit" name="submit" value="Search">
              </div>
              <br>
              <div class="col-xs-6">
                <table style="color:white" class="table table-bordered">
                  </thread>
                    <tr>
                      <th>Department</th>
                      <th>Position</th>
                      <th>Date</th>
                      <th>Total Work Hour</th>
                      <th>Total Over Time Hour</th>
                      <th>Total Salary</th>
                    </tr>
                  </thread>
                  <tbody>
                    <?php readTable(); ?>
                  </tbody>
                </table>
              </div>
            </h5>
          </form>
        </div>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
