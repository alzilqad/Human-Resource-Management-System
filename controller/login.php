<?php
  session_start();
  include "db_connect.php";
  include "attendance.php";

    $userName = $password_web =$password = "";

    if(!empty($_POST['uname']))
    {
      $userName = $_POST['uname'];
    }

    if(!empty($_POST['pass']))
    {
      $password_web = $_POST['pass'];
    }

    $password = md5($password_web);

   validate($userName, $password);

  function validate($userName, $password)
  {
    global $connection;

    $query = "SELECT * FROM `manager` WHERE `Username` LIKE '$userName' AND `Password` LIKE '$password'";
    $result = mysqli_query($connection, $query);
    $rowAdmin = mysqli_num_rows($result);

    $query1 = "SELECT * FROM `employee` WHERE `Username` LIKE '$userName' AND `Password` LIKE '$password' AND `status` = '1'";
    $result1 = mysqli_query($connection, $query1);
    $rowEmp = mysqli_num_rows($result1);
    $rowEmpValue = mysqli_fetch_assoc($result1);

    if($rowAdmin==1)
    {
      $_SESSION['username'] = $userName;
      //$_SESSION['password'] = $password;
      $_SESSION['userType'] = "admin";
      header("Location: /HRMS/view/Dashboard.php");
    }
    elseif($rowEmp==1)
    {
      $_SESSION['username'] = $userName;
      //$_SESSION['password'] = $password;
      $_SESSION['userType'] = "employee";
      $_SESSION['emp_id'] = $rowEmpValue['emp_id'];
      setCheckIn();
      header("Location: /HRMS/view/emp-dashboard.php");
    }
    else
    {
      header("Location: /HRMS/index.html");
    }

  }

?>
