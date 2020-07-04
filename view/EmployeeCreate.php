<?php
  session_start();
  if( $_SESSION['userType'] != "admin"){
    header("Location: /HRMS/index.html");
  }
  include "../controller/db_connect.php";

  $func = "Create";
  $userId = "";
  $userName = $password = $fname = $lname = $fatherName = $dob = $address = $postCode = $email = $phone = $maritalStatus = $nationality = $nId = $religion = $status = $jobId = "";

  if(isset($_GET['read']))
  {
    $userId = $_GET['read'];
    $func = "Read";
    readData($userId);
  }
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
    $query = "SELECT * FROM job";
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result))
    {
      $id = $row['job_id'];
      $position = $row['position'];
      $status = $row['status'];
      if($jobId==$id)
      {
        echo "<option selected value='{$id}'>{$position}</option>";
      }
      else
      {
        if($func=="Read" or $status==0)
        {
          echo "<option value='{$id}' disabled hidden>{$position}</option>";
        }
        else
        {
          echo "<option value='{$id}'>{$position}</option>";
        }
      }
    }
  }

  if(isset($_POST['submit']))
  {
    $userName = $_POST['username'];
    $password = md5($password);
    $password = $_POST['password'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $fatherName = $_POST['fatherName'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $postCode = $_POST['postCode'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $maritalStatus = $_POST['maritalStatus'];
    $nationality = $_POST['nationality'];
    $nId = $_POST['nId'];
    $religion = $_POST['religion'];
    $status = $_POST['status'];
    $jobId = $_POST['jobId'];

    if(strtolower($status)=="active" || $status=='1')
    {
      $status = 1;
    }
    else
    {
      $status = 0;
    }

    if($func=="Create")
    {
      global $connection;
      $userId = $_POST['userId'];
      $password = md5($password);
      $query = "INSERT INTO employee (emp_id, Username, Password, first_name, last_name, father_name, dob, address, postcode, email, phone, marital_status, nationality, nid, religion, status, job_id)";
      $query.= " VALUES ('$userId', '$userName', '$password', '$fname', '$lname', '$fatherName', '$dob', '$address', '$postCode', '$email', '$phone', '$maritalStatus', '$nationality', '$nId', '$religion', '$status', '$jobId')";
      $result = mysqli_query($connection, $query);

      if(!$result)
      {
        die("Failed to insert". mysqli_error($connection));
      }
      else {
        //echo "Data Inserted";
      }
    }
    elseif($func=="Update")
    {
      global $connection;
      $query = "SELECT job.status FROM job INNER JOIN employee ON job.job_id = employee.job_id WHERE employee.emp_id = '$userId' ";
      $result = mysqli_query($connection, $query);
      while($row = mysqli_fetch_assoc($result))
      {
        if($row['status']==0)
        {
            $status = 0;
        }
      }


      $query = "UPDATE employee SET Username = '$userName', Password = '$password', first_name = '$fname', last_name = '$lname', father_name = '$fatherName', dob = '$dob', address = '$address', postcode = '$postCode', email = '$email', phone = '$phone', ";
      $query.= "marital_status = '$maritalStatus', nationality = '$nationality', nid = '$nId', religion = '$religion', status = '$status', job_id = '$jobId' WHERE emp_id = '$userId'";
      $result = mysqli_query($connection, $query);
      if(!$result)
      {
        die("Querry Failed".mysqli_error($connection));
      }
      else {
        //echo "Updated";
      }
    }
  }

?>


<html lang="en">

<?php include "header-admin.php"; ?>

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
              color:#6ddad3;
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
          <td><input class="form-control" name="userId" type="text" value="<?php echo $userId; ?>"  /></td>

          <td class="label" style="color:#6ddad3">Status:</td>
          <td><input class="form-control" name="status" type="text" value="<?php echo $status; ?>" <?php if($func=="Read"){echo "disabled";} ?>/></td>
        </tr>

        <tr>
          <td class="label" style="color:#6ddad3">Username:</td>
          <td><input class="form-control" name="username" type="text" value="<?php echo $userName; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>

        <td class="label" style="color:#6ddad3">Password:</td>
          <td><input class="form-control" name="password" type="password" value="<?php echo $password; ?>" <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td> 
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
          <td><input class="form-control" name="dob" type="date" value="<?php echo $dob; ?>" else{echo required;} <?php if($func=="Read"){echo "disabled";} else{echo "required";} ?>/></td>
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
          <td class="label" style="color:#6ddad3">Job:</td>
          <td>
            <select class="form-control" id="category" name="jobId">
              <?php getJob(); ?>
            </select>
          </td>
        </tr>

      </table>
      <?php
      if($func!="Read")
      {
        echo '<input class="btn btn-primary" type="submit" name="submit" value="'.$func.'">';
      }
      ?>
      <input class="btn btn-primary" type="submit" name="back" value="Back" formaction="EmployeeManagement.php">
    </div>
  </form>
    <!-- /#page-content-wrapper -->

<?php include "footer.php"; ?>

</html>
