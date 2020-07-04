<?php
include "db_connect.php";
date_default_timezone_set('Asia/Dhaka');

function setCheckIn()
{
  global $connection;
  $empId = $_SESSION['emp_id'];
  $currentDate = date("Y-m-d");
  $currentTime = date("Y-m-d H:i:s");
  //$_SESSION['check_in'] = date("Y-m-d h:i:s");
  //$currentTime = $_SESSION['check_in'];

  //checking whether the employee logged into the current date
  $query = "SELECT * FROM `attendance` WHERE `emp_id` = '$empId' AND `check_in` LIKE '$currentDate%'";
  $result = mysqli_query($connection, $query);
  $row = mysqli_num_rows($result);
  $rowValue = mysqli_fetch_assoc($result);


  if($row>0)
  {
    $_SESSION['att_id'] = $rowValue['attendance_id'];
  }
  else
  {
    $query = "INSERT INTO `attendance` (`attendance_id`, `check_in`, `emp_id`)";
    $query.= " VALUES (NULL, '$currentTime', '$empId')";
    $result = mysqli_query($connection, $query);

    if(!$result)
    {
      die("Failed to insert". mysqli_error($connection));
    }
    else {
      $query = "SELECT * FROM `attendance` WHERE `emp_id` = '$empId' AND `check_in` LIKE '$currentDate%'";
      $result = mysqli_query($connection, $query);
      $rowValue = mysqli_fetch_assoc($result);

      $_SESSION['att_id'] = $rowValue['attendance_id'];
    }
  }

}

function setCheckOut()
{
  global $connection;
  $currentTime = date("Y-m-d H:i:s");
  //$currentTime = $_SESSION['check_in'];
  $attId = $_SESSION['att_id'];
  $workHour = calculateWorkHour($attId, $currentTime);
  $query = "UPDATE attendance SET check_out = '$currentTime', work_hour = '$workHour' WHERE attendance_id = '$attId';";
  $result = mysqli_query($connection, $query);
  if(!$result)
  {
    die("Querry Failed".mysqli_error($connection));
  }
}

function calculateWorkHour($attId, $currentTime)
{
  global $connection;
  $empId = $_SESSION['emp_id'];
  $query = "SELECT * FROM `attendance` WHERE `attendance_id` = '$attId' AND `emp_id` = '$empId'";
  $result = mysqli_query($connection, $query);
  $rowValue = mysqli_fetch_assoc($result);

  $checkOut = strtotime($currentTime);
  //$checkOut = date('H', $checkOut);
  $checkOut = (date('H', $checkOut)*60) + date('i', $checkOut);


  $checkIn = strtotime($rowValue['check_in']);
  //$checkIn = date('H', $checkIn);
  $checkIn = (date('H', $checkIn)*60) + date('i', $checkIn);

  $workHour = $rowValue['work_hour'];
  //$workHour = $workHour + $checkOut-$checkIn;
  $workHour = (($checkOut-$checkIn)/60);

  return $workHour;
}

?>
