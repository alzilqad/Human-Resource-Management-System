<?php
    session_start();
    if( $_SESSION['userType'] != "admin"){
      $_SESSION['userType'] != "admin";
      header("Location: /HRMS/emp-dashboard.html");
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

      if($category=="id")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM employee WHERE emp_id LIKE '$id%'";
      }
      elseif($category=="name")
      {
        $name = $_GET['searchbar'];
        $query = "SELECT * FROM employee WHERE Username LIKE '%$name%'";
      }

      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $userId = $row['emp_id'];
          $userName = $row['Username'];
          $password = $row['Password'];
          $status = $row['status'];

          if($status==0) {
            $status = "Deactive";
          }
          else {
            $status = "Active";
          }
          echo "<tr>";
          echo "<td>{$userId}</td>";
          echo "<td>{$userName}</td>";
          echo "<td>{$password}</td>";
          echo "<td>{$status}</td>";
          echo "</tr>";
        }
    }
    else
    {
      global $connection;
      $query = "SELECT * FROM employee";
      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $userId = $row['emp_id'];
          $userName = $row['Username'];
          $password = $row['Password'];
          $status = $row['status'];

          if($status==0) {
            $buttonStatus = "Activate";
            $status = "Deactive";
          }
          else {
            $buttonStatus = "Deactivate";
            $status = "Active";
          }
          echo "<tr>";
          echo "<td>{$userId}</td>";
          echo "<td>{$userName}</td>";
          echo "<td>{$password}</td>";
          echo "<td>{$status}</td>";
          echo "<td><a class='btn btn-primary' style='color:white' href='EmployeeProfile.php?read={$userId}'>Details</a></td>";
          echo "<td><a class='btn btn-primary' style='color:white' href='EmployeeProfile.php?update={$userId}'>Update</a></td>";
          echo "<td><a class='btn btn-primary' style='color:white' href='EmployeeManagement.php?access={$userId}&stat={$buttonStatus}'>$buttonStatus</a></td>";
          echo "<td><a class='btn btn-primary' style='color:white' href='EmployeeManagement.php?delete={$userId}'>Delete</a></td>";
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
    global $connection;
    $id = $_GET['access'];
    $stat = $_GET['stat'];
    $query = "SELECT job.status FROM job INNER JOIN employee ON job.job_id = employee.job_id WHERE employee.emp_id = '$id' ";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      if($row['status']==1)
      {
          modifyAccess($id, $stat);
      }
    }
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
    $query1 = "UPDATE employee SET status = '$val' WHERE emp_id = '$id'";
    $result1 = mysqli_query($connection, $query1);
    if(!$result1)
    {
      die("Querry Failed".mysqli_error($connection));
    }
    else {
      //echo "Updated";
    }
  }

  function delete($id)
  {
    global $connection;
    $query2 = "DELETE FROM employee WHERE emp_id = '$id'";
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

<?php include "header-admin.php"; ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b>Employee List</b></span>
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
                  <option value="id">Employee ID</option>
                  <option value="name">Employee Username</option>
                </select>
                <input class="btn btn-primary" type="submit" name="submit" value="Search">
              </div>
              <br>
              <div class="col-xs-6">
                <table style="color:white" class="table table-bordered">
                  </thread>
                    <tr>
                      <th>Employee ID</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Status</th>
                    </tr>
                  </thread>
                  <tbody>
                    <?php readTable(); ?>
                  </tbody>
                </table>
                <button type="submit" class="btn btn-primary" name="create" formaction="EmployeeCreate.php">Create</button>
              </div>
            </h5>
          </form>
        </div>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
