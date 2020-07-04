<?php
    session_start();
    if( $_SESSION['userType'] != "admin"){
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

      if($category=="attId")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM attendance WHERE attendance_id LIKE '%$id%'";
      }
      elseif($category=="empId")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM attendance WHERE emp_id LIKE '%$id%'";
      }
      elseif($category=="date")
      {
        $date = $_GET['searchbar'];
        $query = "SELECT * FROM attendance WHERE check_in LIKE '$date%'";
      }
      elseif($category=="empName")
      {
        $userName = $_GET['searchbar'];
        $query1 = "SELECT * FROM employee WHERE username LIKE '%$userName%'";
        $result1 = mysqli_query($connection, $query1);
        $row1 = mysqli_fetch_assoc($result1);
        $id = $row1['emp_id'];
        $query = "SELECT * FROM attendance WHERE emp_id = '$id'";
      }

      $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result))
        {
          $attId = $row['attendance_id'];
          $empId = $row['emp_id'];
          $workHour = $row['work_hour'];

          $checkIn = $row['check_in'];
          $checkIn = strtotime($checkIn);
          $date = date('d M, Y', $checkIn);
          $checkIn = date('h:i a', $checkIn);
          $checkOut = $row['check_out'];
          $checkOut = strtotime($checkOut);
          $checkOut = date('h:i a', $checkOut);

          $query1 = "SELECT * FROM employee WHERE emp_id LIKE '$empId'";
          $result1 = mysqli_query($connection, $query1);
          $row1 = mysqli_fetch_assoc($result1);
          $empName = $row1['Username'];

          echo "<tr>";
          echo "<td>{$attId}</td>";
          echo "<td>{$empId}</td>";
          echo "<td>{$empName}</td>";
          echo "<td>{$date}</td>";
          echo "<td>{$checkIn}</td>";
          echo "<td>{$checkOut}</td>";
          echo "<td>{$workHour}</td>";
          echo "</tr>";
        }
    }
    else
    {
      global $connection;
      $query = "SELECT * FROM attendance";
      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $attId = $row['attendance_id'];
          $empId = $row['emp_id'];
          $workHour = $row['work_hour'];

          $checkIn = $row['check_in'];
          $checkIn = strtotime($checkIn);
          $date = date('d M, Y', $checkIn);
          $checkIn = date('h:i a', $checkIn);
          $checkOut = $row['check_out'];
          $checkOut = strtotime($checkOut);
          $checkOut = date('h:i a', $checkOut);

          $query1 = "SELECT * FROM employee WHERE emp_id LIKE '$empId'";
          $result1 = mysqli_query($connection, $query1);
          $row1 = mysqli_fetch_assoc($result1);
          $empName = $row1['Username'];

          echo "<tr>";
          echo "<td>{$attId}</td>";
          echo "<td>{$empId}</td>";
          echo "<td>{$empName}</td>";
          echo "<td>{$date}</td>";
          echo "<td>{$checkIn}</td>";
          echo "<td>{$checkOut}</td>";
          echo "<td>{$workHour}</td>";
          echo "</tr>";
        }
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
              <span style="color:turquoise"><b>Attendance List</b></span>
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
                  <option value="attId">Entry No</option>
                  <option value="empId">Employee ID</option>
                  <option value="empName">Username</option>
                  <option value="date">Date</option>
                </select>
                <input class="btn btn-primary" type="submit" name="submit" value="Search">
              </div>
              <br>
              <div class="col-xs-6">
                <table style="color:white" class="table table-bordered">
                  </thread>
                    <tr>
                      <th>Entry No</th>
                      <th>Employee Id</th>
                      <th>Username</th>
                      <th>Date</th>
                      <th>Check In Time</th>
                      <th>Check Out Time</th>
                      <th>Work Hour</th>
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
