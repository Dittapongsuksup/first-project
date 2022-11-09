<?php

session_start();
require_once 'config/connect.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registered Activities</title>
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

    <div class="container mt-2 mb-5">
      <div class="row">
        <div class="col-md-6">
          <h1>นักศึกษาที่ลงทะเบียน</h1>
        </div>
        <!--<div class="col-md-6 d-flex justify-content-end">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add Activity</button>
        </div>-->
      </div>
      <hr>
      <?php if (isset($_SESSION['success'])) { ?>
        <div class="alert alert-success">
          <?php
          echo $_SESSION['success'];
          unset($_SESSION['success']);
          ?>
        </div>
      <?php } ?>
      <?php if (isset($_SESSION['error'])) { ?>
        <div class="alert alert-danger">
          <?php
          echo $_SESSION['error'];
          unset($_SESSION['error']);
          ?>
        </div>
      <?php } ?>

      <!--table data -->
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">รหัสนักศึกษา</th>
            <th scope="col">ชื่อนักศึกษา</th>
            <th scope="col">นามสกุล</th>
            <th scope="col">หัวข้อกิจกรรม</th>
            <th scope="col">กำหนดการจิตอาสา</th>
            <th scope="col">วันที่ลงทะเบียน</th>
            <th scope="col">ผลลัพท์</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $sql = $conn->query("SELECT a.*, act.title, act.actDatetime, s.studentId, s.firstName, s.lastName
          FROM act_register as a 
          INNER JOIN activities as act ON a.actId=act.actId
          INNER JOIN students as s ON a.stId=s.stId
          ORDER BY registerId DESC");

          $sql->execute();
          $data = $sql->fetchAll();

          if (!$data) {
            echo "<tr><td colspan='7' class='text-center'>No Data found</td></tr>";
          } else {
            foreach ($data as $registered) {
          ?>
              <tr>
                <td><?= $registered['studentId']; ?></td>
                <td><?= $registered['firstName']; ?></td>
                <td><?= $registered['lastName']; ?></td>
                <td><?= $registered['title']; ?></td>
                <td><?= $registered['actDatetime']; ?></td>
                <td><?= $registered['registerDate']; ?></td>
                <td>
                  <?php
                  if ($registered['result'] == 'ไม่ผ่าน') {
                    echo '<font color="red">';
                    echo $registered['result'];
                    echo '</font>';
                  } elseif ($registered['result'] == 'ผ่าน') {
                    echo '<font color="#03fc5a">';
                    echo $registered['result'];
                    echo '</font>';
                  } elseif ($registered['result'] == 'ยกเลิก') {
                    echo '<font color="#1c1b18">';
                    echo $registered['result'];
                    echo '</font>';
                  } elseif ($registered['result'] == 'รอแก้ไข') {
                    echo '<font color="#f2cf07">';
                    echo $registered['result'];
                    echo '</font>';
                  } else {
                    echo '<font color="#1a38c7">';
                    echo $registered['result'];
                    echo '</font>';
                  }
                  ?>
                </td>
                <td>
                  <a href="editRegister.php?registerId=<?= $registered['registerId']; ?>" class="btn btn-success">แก้ไขผลลัพท์</a>
                </td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
      <hr>
      <div>
        <a href="exportAct.php" class="btn btn-success">Export Data</a>
      </div>

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