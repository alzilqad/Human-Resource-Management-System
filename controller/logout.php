<?php
  session_start();
  include "attendance.php";

  if($_SESSION['userType'] == "employee")
  {
    setCheckOut();
  }

  $_SESSION['username'] = "";
  $_SESSION['userType'] = "";
  $_SESSION['emp_id'] = "";
  $_SESSION['att_id'] = "";

  header("Location: /HRMS/index.html");
?>
