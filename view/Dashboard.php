<?php
  session_start();
  if( $_SESSION['userType'] != "admin"){
    header("Location:  /HRMS/index.html");
  }
?>
<html lang="en">
<?php include "header-dash-admin.php"; ?>

<div class="container" >
    <div class="row" >
      <div class="col-sm">
        <a href="EmployeeManagement.php">
          <img src="../Resource/Employees.png" alt="Employees" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="JobManagement.php">
          <img src="../Resource/Jobs.png" alt="Jobs" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="AttendanceManagement.php">
          <img src="../Resource/Attendance.png" alt="Attendance" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a href="SalaryManagement.php">
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
        <a href="LeaveManagement.php">
          <img src="../Resource/Leave.png" alt="Leave" width="200" height="200">
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
    </div>

    <div class="row">
      <div class="col-sm">
        <a href="JobManagement.php">
          <img src="../Resource/active jobs.png" alt="active jobs" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a target="../Resource/Recruitement.png" href="Recruitement.png">
          <img src="../Resource/Recruitement.png" alt="Recruitement" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a target="../Resource/training.png" href="training.png">
          <img src="../Resource/training.png" alt="training" width="200" height="200">
        </a>
      </div>
      <div class="col-sm">
        <a target="../Resource/Surveys.png" href="Surveys.png">
          <img src="../Resource/Surveys.png" alt="Surveys" width="200" height="200">
        </a>
      </div>
    </div>

</div>

<?php include "footer.php"; ?>

</html>
