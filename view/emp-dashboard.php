<?php
  session_start();
  if( $_SESSION['userType'] != "employee"){
    header("Location: /HRMS/index.html");
  }

?>
<html lang="en">

<?php include "header-dash-emp.php"; ?>

<div class="container" >
    <div class="row" >
      <div class="col-sm">
        <a href="emp-profile.php">
          <img src="../Resource/Employees.png" alt="Employees" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="JobManagement.php">
          <img src="../Resource/Jobs.png" alt="Jobs" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="emp-attendance.php">
          <img src="../Resource/Attendance.png" alt="Attendance" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="emp-salary.php">
          <img src="../Resource/Reports.png" alt="Reports" width="200" height="200">
        </a>
      </div>
    </div>


    <div class="row">
      <div class="col-sm">
        <a href="HolidayManagement.php">
          <img src="../Resource/holidays.png" alt="holidays" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a target="../Resource/Application.png" href="Application.png">
          <img src="../Resource/Application.png" alt="Application.png" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="NoticeBoard.php">
          <img src="../Resource/news.png" alt="news" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
      </div>
    </div>

</div>

<?php include "footer.php"; ?>

</html>
