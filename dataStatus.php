<?php

session_start();
require_once 'config/connect.php';
$status = $conn->query("SELECT * FROM st_status ORDER BY statusId ASC");
$status->execute();
$stmtStatus = $status->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Major</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

  <div class="container mt-4 mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <div class="container-fluid">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" href="facultyPage.php">จัดการข้อมูลคณะ</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" href="majorPage.php">จัดการข้อมูลสาขา</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" href="statusPage.php">จัดการสถานภาพนักศึกษา</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" href="rolePage.php">จัดการบทบาทผู้เล่น</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-success" type="submit">Search</button>
          </form>
        </ul>
      </div>
    </nav>
    <br>
  </div>

  <!--from add data-->
  <div class="container-sm">

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1>Data Status</h1>
        </div>
      </div>
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                รายการสถานะนักศึกษา
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <?php foreach ($stmtStatus as $row) { ?>
                  <li><a class="dropdown-item" href="dataStatus.php?statusId=<?= $row['statusId']; ?>"><?php echo $row['status']; ?></a></li>
                <?php } ?>
              </ul>
            </div>
          </div>
          <div class="col-md-2 mt-2 text-left" style="color:blueviolet;">
            <h5>สถานะนักศึกษา</h5>
          </div>
        </div>
      </div>
      <br>
      <hr>
      <!--table data -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">สถานภาพนักศึกษา</th>
            <th scope="col">รหัสนักศึกษา</th>
            <th scope="col">ชื่อ</th>
            <th scope="col">นามสกุล</th>
            <th scope="col">ระดับการศึกษา</th>
            <th scope="col">ระดับชั้น</th>
            <th scope="col">ตำแหน่ง</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_GET['statusId'])) {
            $statusId = $_GET['statusId'];

            $sql = $conn->query("SELECT students.*, st_status.status
                                    FROM students 
                                    INNER JOIN st_status ON students.statusId=st_status.statusId
                                    WHERE students.statusId=$statusId
                                    AND students.userRole!='admin'");

            $sql->execute();
            $data = $sql->fetchAll();
          }

          if (!$data) {
            echo "<tr><td colspan='7' class='text-center'>No Data found</td></tr>";
          } else {
            foreach ($data as $stat) {

          ?>
              <tr>
                <td><?= $stat['status']; ?></td>
                <td><?= $stat['studentId']; ?></td>
                <td><?= $stat['firstName']; ?></td>
                <td><?= $stat['lastName']; ?></td>
                <td><?= $stat['study']; ?></td>
                <td><?= $stat['class']; ?></td>
                <td><?= $stat['position']; ?></td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
  </div>

  <script>
    scr = "https://code.jquery.com/jquery-3.6.0.min.js"
  </script>
  <script>
    src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
  </script>
</body>

</html>