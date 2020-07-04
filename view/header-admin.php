<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <style>
    .row {
      display: grid;
      grid-template-columns: auto auto auto auto;
      grid-row-gap: 50px;
      grid-column-gap: 10px;
      padding: 10px;
    }

    .row > div {
      text-align: center;
      padding: 20px 0;
      font-size: 30px;
    }
  </style>

  <title>Nexus Solutions</title>
  <link rel = "icon" href = "/HRMS/Resource/logo.png" type = "image/x-icon">

  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="../css/simple-sidebar.css" rel="stylesheet">

</head>


<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="" id="sidebar-wrapper">
      <div class="sidebar-heading">
        <a class="navbar-brand" href="<?php
                    if($_SESSION['userType'] == "admin") echo "Dashboard.php";
                    elseif($_SESSION['userType'] == "employee") echo "emp-dashboard.php";
              ?>">
          <img src="../Resource/NexasLogo.png" alt="nexas solutions logo" style="width:141px;height:54px;">
        </a>
      </div>
      <div class="list-group list-group-flush" id="list">

        <a href="/HRMS/view/EmployeeManagement.php" class="list-group-item list-group-item-action"style="background-color: #2a3f5b;">Employee Management</a>
        <a href="/HRMS/view/JobManagement.php" class="list-group-item list-group-item-action"style="background-color: #2a3f5b;">Jobs</a>
        <a href="/HRMS/view/AttendanceManagement.php" class="list-group-item list-group-item-action"style="background-color: #2a3f5b;">Attendance</a>
        <a href="/HRMS/view/SalaryManagement.php" class="list-group-item list-group-item-action"style="background-color: #2a3f5b;">Salary</a>
        <a href="/HRMS/view/HolidayManagement.php" class="list-group-item list-group-item-action"style="background-color: #2a3f5b;">Holidays</a>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light">
        <button class="btn" id="menu-toggle"><i class="fas fa-bars" style="color:#6ddad3"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" style="color:#6ddad3" aria-haspopup="true" aria-expanded="false">
                <?php echo $_SESSION['username']; ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="passwordChange.php">Change Password</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="" href="/HRMS/controller/logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
