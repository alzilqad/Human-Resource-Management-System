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

  $holidayId = $holidayName = $date = $bonus = "";

  function readTable()
  {
    if(isset($_GET['searchbar']) && !empty($_GET['searchbar']))
    {
      $category = $_GET['category'];
      global $connection;

      if($category=="id")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM holiday WHERE holiday_id LIKE '%$id%'";
      }
      elseif($category=="day")
      {
        $day = $_GET['searchbar'];
        $query = "SELECT * FROM holiday WHERE holiday_name LIKE '%$day%'";
      }
      elseif($category=="date")
      {
        $date = $_GET['searchbar'];
        $query = "SELECT * FROM holiday WHERE day LIKE '%$date%'";
      }


      $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result))
        {
          $holidayId = $row['holiday_id'];
          $holidayName = $row['holiday_name'];
          $date = $row['day'];
          $bonus = $row['bonus'];

          echo "<tr>";
          if($accessType == 1)
          {
            echo "<td>{$holidayId}</td>";
          }
          echo "<td>{$holidayName}</td>";
          echo "<td>{$date}</td>";
          echo "<td>{$bonus}</td>";
          echo "</tr>";
        }
    }
    else
    {
      global $connection, $accessType;
      $query = "SELECT * FROM holiday";
      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $holidayId = $row['holiday_id'];
          $holidayName = $row['holiday_name'];
          $date = $row['day'];
          $bonus = $row['bonus'];

          echo "<tr>";
          if($accessType == 1)
          {
            echo "<td>{$holidayId}</td>";
          }
          echo "<td>{$holidayName}</td>";
          echo "<td>{$date}</td>";
          echo "<td>{$bonus}</td>";
          if($accessType == 1)
          {
            echo "<td><a class='btn btn-primary' style='color:white' href='HolidayModify.php?update={$holidayId}'>Update</a></td>";
            echo "<td><a class='btn btn-primary' style='color:white' href='HolidayManagement.php?delete={$holidayId}'>Delete</a></td>";
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

  function delete($id)
  {
    global $connection;
    $query2 = "DELETE FROM holiday WHERE holiday_id = '$id'";
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
              <span style="color:turquoise"><b>Offered Holiday List</b></span>
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
                  <option value="id">Holiday ID</option>
                  <option value="day">Holiday</option>
                  <option value="date">Date</option>
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
                        echo '<th>ID</th>';
                      }
                      ?>
                      <th>Holiday</th>
                      <th>Date</th>
                      <th>Bonus (%)</th>
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
