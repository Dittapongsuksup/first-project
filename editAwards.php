<?php
session_start();
require_once 'config/connect.php';

if (isset($_POST['update'])) {
  $awardId = $_POST['awardId'];
  $awardName = $_POST['awardName'];
  $league = $_POST['league'];
  $rank = $_POST['rank'];
  $awardDate = $_POST['awardDate'];
  $coach = $_POST['coach'];
  $player = $_POST['player'];
  $img = $_FILES['img'];

  $img2 = $_POST['img2'];
  $upload = $_FILES['img']['name'];

  if ($upload != '') {

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode(".", $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "awards/" . $fileNew;

    if (in_array($fileActExt, $allow)) {

      if ($img['size'] > 0 && $img['error'] == 0) {
        move_uploaded_file($img['tmp_name'], $filePath);
      }
      
    }

  } 
  else {
    $fileNew = $img2;
  }

  $stmt = $conn->prepare("UPDATE all_awards SET awardName=:awardName, league=:league, rank=:rank, awardDate=:awardDate, coach=:coach, player=:player, img=:img
                          WHERE awardId=:awardId");
  $stmt->bindParam(":awardName", $awardName);
  $stmt->bindParam(":league", $league);
  $stmt->bindParam(":rank", $rank);
  $stmt->bindParam(":awardDate", $awardDate);
  $stmt->bindParam(":coach", $coach);
  $stmt->bindParam(":player", $player);
  $stmt->bindParam(":img",$fileNew);
  $stmt->bindParam(":awardId", $awardId);
  $stmt->execute();

  if ($stmt) {
    $_SESSION['success'] = "Data has been updated successfully";
    header('location: awards.php');
  } else {
    $_SESSION['error'] = "Data has not been updated successfully !!";
    header('location: awards.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Award</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <style>
    .container {
      max-width: 600px;
    }
  </style>
</head>

<body>

  <div class="container mt-5">
    <h1>Edit Data</h1>
    <hr>
    <form action="editAwards.php" method="POST" enctype="multipart/form-data">
      <?php
      if (isset($_GET['awardId'])) {
        $awardId = $_GET['awardId'];
        $stmt = $conn->query("SELECT * FROM all_awards WHERE awardId = $awardId");
        $stmt->execute();
        $data = $stmt->fetch();
      }
      ?>
      <div class="mb-3">
        <input type="text" hidden value="<?= $data['awardId']; ?>" readonly class="form-control" name="awardId">
        <label for="awardName" class="col-form-label">ชื่อรางวัล</label>
        <input type="text" value="<?= $data['awardName']; ?>" required class="form-control" name="awardName">
      </div>
      <div class="mb-3">
        <label for="league" class="col-form-label">ลีก</label>
        <input type="text" value="<?= $data['league']; ?>" required class="form-control" name="league">
      </div>
      <div class="mb-3">
        <label for="rank" class="col-form-label">อันดับ</label>
        <input type="text" value="<?= $data['rank']; ?>" required class="form-control" name="rank">
      </div>
      <div class="mb-3">
        <label for="awardDate" class="col-form-label">วันที่รับรางวัล</label>
        <input type="date" value="<?= $data['awardDate']; ?>" required class="form-control" name="awardDate">
      </div>
      <div class="mb-3">
        <label for="coach" class="col-form-label">ชื่อ/สกุล โค้ช</label>
        <input type="text" value="<?= $data['coach']; ?>" required class="form-control" name="coach">
      </div>
      <div class="mb-3">
        <label for="player" class="col-form-label">ชื่อ/สกุล นักเตะยอดเยี่ยม</label>
        <input type="text" value="<?= $data['player']; ?>" required class="form-control" name="player">
      </div>
      <div class="mb-3">
        <label for="img" class="col-form-label">รูปภาพ</label>
        <input type="file" id="imgInput" class="form-control" name="img">
        <img width="100%" src="awards/<?= $data['img']; ?>" id="previewImg" alt="">
        <input type="hidden" value="<?= $data['img']; ?>" class="form-control" name="img2">
      </div>

      <div class="modal-footer">
        <a class="btn btn-secondary" href="awards.php">Go Back</a>
        <button type="submit" name="update" class="btn btn-success" onclick="return confirm('Are you sure you want to update data!!');">Update</button>
      </div>
    </form>
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