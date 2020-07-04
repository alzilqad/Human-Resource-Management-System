<?php
  session_start();
  if( $_SESSION['userType'] != "employee"){
    header("Location: /HRMS/index.html");
  }
  include "../controller/db_connect.php";

  $func = "Read";
  $userId = $_SESSION['emp_id'];
  $userName = $password = $fname = $lname = $fatherName = $dob = $address = $postCode = $email = $phone = $maritalStatus = $nationality = $nId = $religion = $status = $jobId = $jobStatus = "";
  readData($userId);

  if(isset($_GET['update']))
  {
    $userId = $_GET['update'];
    $func = "Update";
    readData($userId);
  }

  function readData($id)
  {
    global $connection, $userName, $password, $fname, $lname, $fatherName, $dob, $address, $postCode, $email, $phone, $maritalStatus, $nationality, $nId, $religion, $status, $jobId;
    $query = "SELECT * FROM employee WHERE emp_id = '$id'";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $userName = $row['Username'];
      $password = $row['Password'];
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $fatherName = $row['father_name'];
      $dob = $row['dob'];
      $address = $row['address'];
      $postCode = $row['postcode'];
      $email = $row['email'];
      $phone = $row['phone'];
      $maritalStatus = $row['marital_status'];
      $nationality = $row['nationality'];
      $nId = $row['nid'];
      $religion = $row['religion'];
      $status = $row['status'];
      $jobId = $row['job_id'];
    }

    if($status==0) {
      $status = "Deactive";
    }
    else {
      $status = "Active";
    }
  }

  function getJob()
  {
    global $connection, $jobId, $func;
    $query = "SELECT * FROM job WHERE job_id = '$jobId'";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $id = $row['job_id'];
      $position = $row['position'];
      $status = $row['status'];
      if($status==0)
      {
        $status = "Inactive";
      }
      else
      {
        $status = "Active";
      }
      echo "$position";
    }
  }


?>


<html lang="en">

<?php include "header.php"; ?>

      <div class="container" >
        <div class="row" >
            <h3 class="page-header">
              <span style="color:turquoise"><b>Employee Profile</b></span>
            </h3>
        </div>

        <style>
            input[type=text] {
              border: none;
              outline: none;
              background-color:#2a3f5b;
              color:black;
            }

            textarea{
              border: none;
              outline: none;
              background-color:#2a3f5b;
              color:#6ddad3;
              width: 300px;
              height: 100px;
              resize: none;
            }

        </style>
      <form action"" method="post" >
      <div>
      <table border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td class="label" style="color:#6ddad3">Employee ID:</td>
          <td><input class="form-control" name="userId" type="text" value="<?php echo $userId; ?>" <?php if($func=="Read"){echo "disabled";} ?>/></td>

          <td class="label" style="color:#6ddad3">Status:</td>
          <td><input class="form-control" name="status" type="text" value="<?php echo $status; ?>" <?php if($func=="Read"){echo "disabled";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Username:</td>
          <td><input class="form-control" name="username" type="text" value="<?php echo $userName; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

         
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">First Name:</td>
          <td><input class="form-control" name="firstName" type="text" value="<?php echo $fname; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">Last Name:</td>
          <td><input class="form-control" name="lastName" type="text" value="<?php echo $lname; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Father Name:</td>
          <td><input class="form-control" name="fatherName" type="text" value="<?php echo $fatherName; ?>"  <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">Date of Birth:</td>
          <td><input class="form-control" name="dob" type="text" value="<?php echo $dob; ?>" else{echo required;} <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Address:</td>
          <td><textarea name="address" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>><?php echo $address; ?></textarea></td>

          <td class="label" style="color:#6ddad3">Post Code:</td>
          <td><input class="form-control" name="postCode" type="text" value="<?php echo $postCode; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

        <tr>

          <td class="label" style="color:#6ddad3">Email:</td>
          <td><input class="form-control" name="email" type="text" value="<?php echo $email; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">Phone:</td>
          <td><input class="form-control" name="phone" type="text" value="<?php echo $phone; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">NID:</td>
          <td><input class="form-control" name="nId" type="text" value="<?php echo $nId; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Marital Status:</td>
          <td><input class="form-control" name="maritalStatus" type="text" value="<?php echo $maritalStatus; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">Religion:</td>
          <td><input class="form-control" name="religion" type="text" value="<?php echo $religion; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

          <td class="label" style="color:#6ddad3">Nationality:</td>
          <td><input class="form-control" name="nationality" type="text" value="<?php echo $nationality; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Job Position:</td>
          <td><input class="form-control" name="jobId" type="text" value="<?php getJob(); ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
          <td class="label" style="color:#6ddad3">Job Status:</td>
          <td><input class="form-control" name="jobId" type="text" value="<?php echo $status; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
        </tr>

      </table>
      <?php
      if($func!="Read")
      {
        echo '<input class="btn btn-primary" type="submit" name="submit" value="'.$func.'">';
      }
      ?>
    </div>
  </form>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
