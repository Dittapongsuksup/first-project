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
  <title>Awards</title>
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
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="text-align:center;" id="exampleModalLabel">เพิ่มรายการรางวัล</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

          </div>
          <div class="modal-body">
            <form action="insert.php" method="post" enctype="multipart/form-data">
              <!--enctype="multipart/form-data"-->
              <div class="mb-3">
                <label for="awardName" class="col-form-label">ชื่อรางวัล</label>
                <input type="text" required class="form-control" name="awardName">
              </div>
              <div class="mb-3">
                <label for="league" class="col-form-label">ลีก</label>
                <input type="text" required class="form-control" name="league">
              </div>
              <div class="mb-3">
                <label for="rank" class="col-form-label">อันดับ</label>
                <input type="text" required class="form-control" name="rank">
              </div>
              <div class="mb-3">
                <label for="awardDate" class="col-form-label">วันที่รับรางวัล</label>
                <input type="date" required class="form-control" name="awardDate">
              </div>
              <div class="mb-3">
                <label for="coach" class="col-form-label">ชื่อ/สกุล โค้ช</label>
                <input type="text" required class="form-control" name="coach">
              </div>
              <div class="mb-3">
                <label for="player" class="col-form-label">ชื่อ/สกุล นักเตะยอดเยี่ยม</label>
                <input type="text" required class="form-control" name="player">
              </div>
              <div class="mb-3">
                <label for="img" class="col-form-label">รูปภาพ</label>
                <input type="file" id="imgInput" class="form-control" name="img">
                <img width="100%" id="previewImg" alt="">
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="addAward" class="btn btn-success" onclick="return confirm('Are you sure you want to insert data!!');">Save</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6">
          <h1>Data Awards</h1>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add Awards</button>
        </div>
      </div>

      <br>
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
            <th>#</th>
            <th>Award Name</th>
            <th>League</th>
            <th>Rank</th>
            <th>Award Date</th>
            <th>Coach</th>
            <th>The Best Player</th>
            <th style="text-align: center;">Image</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = $conn->query("SELECT * FROM all_awards");
          $sql->execute();
          $data = $sql->fetchAll();

          if (!$data) {
            echo "<tr><td colspan='6' class='text-center'>No Data found</td></tr>";
          } else {
            foreach ($data as $awards) {

          ?>
              <tr>
                <th scope="row"><?= $awards['awardId']; ?></th>
                <th><?= $awards['awardName']; ?></th>
                <td><?= $awards['league']; ?></td>
                <td><?= $awards['rank']; ?></td>
                <td><?= $awards['awardDate']; ?></td>
                <td><?= $awards['coach']; ?></td>
                <td><?= $awards['player']; ?></td>
                <td width="200px"><img width="80%" src="awards/<?= $awards['img']; ?>" alt=""></td>
                <td>
                  <a href="editAwards.php?awardId=<?= $awards['awardId']; ?>" class="btn btn-warning">Edit</a>
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
  <script>
    let imgInput = document.getElementById('imgInput');
    let previewImg = document.getElementById('previewImg');

    imgInput.onchange = evt => {
      const [file] = imgInput.files;
      if (file) {
        previewImg.src = URL.createObjectURL(file);
      }
    }
  </script>
</body>

</html>