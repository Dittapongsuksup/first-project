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
  <title>Register Activity</title>
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
            <a class="nav-link" aria-current="page" href="user.php">Dashboard</a>
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

  <!-- registered table-->
  <div class="container-sm">
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h3>จิตอาสาที่ลงทะเบียนแล้ว</h3>
        </div>
      </div>
      <hr>

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">หัวข้อกิจกรรม</th>
            <th scope="col">กำหนดการจิตอาสา</th>
            <th scope="col">รหัสนักศึกษา</th>
            <th scope="col">ชื่อนักศึกษา</th>
            <th scope="col">นามสกุล</th>
            <th scope="col">วันที่ลงทะเบียน</th>
            <th scope="col">ผลลัพท์</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $stId = $_SESSION['user_login'];

          $register = $conn->query("SELECT a.*, act.title, act.actDatetime, s.studentId, s.firstName, s.lastName
                                    FROM act_register as a 
                                    INNER JOIN activities as act ON a.actId=act.actId
                                    INNER JOIN students as s ON a.stId=s.stId
                                    WHERE a.stId=$stId");

          $register->execute();
          $stmt = $register->fetchAll();

          if (!$stmt) {
            echo "<tr><td colspan='7' class='text-center'>No Data found</td></tr>";
          } else {
            foreach ($stmt as $row) {
          ?>
              <tr>
                <td><?= $row['title']; ?></td>
                <td><?= $row['actDatetime']; ?></td>
                <td><?= $row['studentId']; ?></td>
                <td><?= $row['firstName']; ?></td>
                <td><?= $row['lastName']; ?></td>
                <td><?= $row['registerDate']; ?></td>
                <td>
                  <?php
                  if ($row['result'] == 'ไม่ผ่าน') {
                    echo '<font color="red">';
                    echo $row['result'];
                    echo '</font>';
                  } elseif ($row['result'] == 'ผ่าน') {
                    echo '<font color="#03fc5a">';
                    echo $row['result'];
                    echo '</font>';
                  } elseif ($row['result'] == 'ยกเลิก') {
                    echo '<font color="#1c1b18">';
                    echo $row['result'];
                    echo '</font>';
                  } elseif ($row['result'] == 'รอแก้ไข') {
                    echo '<font color="#f2cf07">';
                    echo $row['result'];
                    echo '</font>';
                  } else {
                    echo '<font color="#1a38c7">';
                    echo $registered['result'];
                    echo '</font>';
                  }
                  ?>
                </td>
              </tr>
          <?php }
          } ?>
        </tbody>
      </table>
    </div>
  </div>
  <hr>

  <!--from add data-->
  <div class="container-sm">

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1>ลงทะเบียนกิจกรรมจิตอาสา</h1>
        </div>
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
            <th scope="col">หัวข้อกิจกรรม</th>
            <th scope="col">วัน/เวลา</th>
            <th scope="col">หมายเหตุ</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = $conn->query("SELECT * FROM activities ORDER BY actId DESC");
          $sql->execute();
          $data = $sql->fetchAll();

          if (!$data) {
            echo "<tr><td colspan='6' class='text-center'>No Data found</td></tr>";
          } else {
            foreach ($data as $activity) {

          ?>
              <tr>
                <!--<th scope="row"><?= $activity['actId']; ?></th>-->
                <td><?= $activity['title']; ?></td>
                <td><?= $activity['actDatetime']; ?></td>
                <td><?= $activity['description']; ?></td>
                <td>
                  <a href="actRe.php?actId=<?= $activity['actId']; ?>" class="btn btn-primary">Register</a>
                </td>
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