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
    if(isset($_GET['searchbar']) && !empty($_GET['searchbar']))
    {
      $category = $_GET['category'];

      if($category=="attId")
      {
        $id = $_GET['searchbar'];
        $query = "SELECT * FROM attendance WHERE attendance_id LIKE '%$id%' and emp_id = '$empId'";
      }
      elseif($category=="date")
      {
        $date = $_GET['searchbar'];
        $query = "SELECT * FROM attendance WHERE check_in LIKE '$date%'  and emp_id = '$empId'";
      }

      $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result))
        {
          $attId = $row['attendance_id'];
          $workHour = $row['work_hour'];

          $checkIn = $row['check_in'];
          $checkIn = strtotime($checkIn);
          $date = date('d M, Y', $checkIn);
          $checkIn = date('h:i', $checkIn);
          $checkOut = $row['check_out'];
          $checkOut = strtotime($checkOut);
          $checkOut = date('h:i', $checkOut);

          echo "<tr>";
          echo "<td>{$date}</td>";
          echo "<td>{$checkIn}</td>";
          echo "<td>{$checkOut}</td>";
          echo "<td>{$workHour}</td>";
          echo "</tr>";
        }
    }
    else
    {
      $query = "SELECT * FROM attendance  WHERE emp_id = '$empId'";
      $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result))
        {
          $workHour = $row['work_hour'];

          $checkIn = $row['check_in'];
          $checkIn = strtotime($checkIn);
          $date = date('d M, Y', $checkIn);
          $checkIn = date('h:i', $checkIn);
          $checkOut = $row['check_out'];
          $checkOut = strtotime($checkOut);
          $checkOut = date('h:i', $checkOut);

          echo "<tr>";
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

<?php include "header.php"; ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b>Applications</b></span>
            </h3>
        </div>
        <div class="row-12">
          <form action"">
            <h5>
              <div class=".col-9">
                <input type="file" id="myFile" multiple size="5" onchange="myFunction()">
              </div>
              <div class=".col-3">
                <input class="btn btn-primary" type="submit" name="submit" value="Search">
              </div>
              <br>
              <div class="col-xs-6">
                <table style="color:white" class="table table-bordered">
                  </thread>
                    <tr>
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

<script>
function myFunction(){
  var x = document.getElementById("myFile");
  var txt = "";
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" + (i+1) + ". file</strong><br>";
        var file = x.files[i];
        if ('name' in file) {
          txt += "name: " + file.name + "<br>";
        }
        if ('size' in file) {
          txt += "size: " + file.size + " bytes <br>";
        }
      }
    }
  }
  else {
    if (x.value == "") {
      txt += "Select one or more files.";
    } else {
      txt += "The files property is not supported by your browser!";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead.
    }
  }
  document.getElementById("demo").innerHTML = txt;
}
</script>

<?php include "footer.php"; ?>

</html>
