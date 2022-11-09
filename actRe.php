<?php

  session_start();
  require_once 'config/connect.php';

  if (isset($_POST['register'])) {
    $actId = $_POST['actId'];
    $stId = $_POST['stId'];
    $result = "ลงทะเบียนเรียบร้อยแล้ว";


    $stmt = $conn->prepare("INSERT INTO act_register (actId, stId, result) VALUE (:actId, :stId, :result)");
    $stmt->bindParam(":actId", $actId);
    $stmt->bindParam(":stId", $stId);
    $stmt->bindParam(":result", $result);

    $stmt->execute();

    if ($stmt) {
        $_SESSION['success'] = "You have registered successfully";
        header('location: actRegister.php');
    } else {
        $_SESSION['error'] = "You have not registered successfully !!";
        header('location: actRegister.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirm Register</title>
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
    <h1>ยืนยันการลงทะเบียน</h1>
    <hr>
    <form action="actRe.php" method="POST">
      <?php
      if (isset($_GET['actId'])) {
        $actId = $_GET['actId'];
        $stmt = $conn->query("SELECT * FROM activities WHERE actId = $actId");
        $stmt->execute();
        $data = $stmt->fetch();
      }
      ?>
      <div class="mb-3">
        <input type="text" hidden value="<?= $data['actId']; ?>" class="form-control" name="actId">
        <input type="text" hidden value="<?php echo $_SESSION['user_login'] ?>" class="form-control" name="stId">
        <label for="title" class="col-form-label">หัวข้อกิจกรรม</label>
        <input type="text" readonly value="<?= $data['title']; ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label for="actDatetime" class="col-form-label">วัน/เวลา</label>
        <input type="text" readonly value="<?= $data['actDatetime']; ?>" class="form-control">
      </div>
      <div class="mb-3">
        <label for="description" class="col-form-label">หมายเหตุ</label>
        <input type="text" readonly value="<?= $data['description']; ?>" class="form-control">
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" href="actRegister.php">Cancel</a>
        <button type="submit" name="register" class="btn btn-success" onclick="return confirm('Are you sure you want to Register!!');">register</button>
      </div>
    </form>
  </div>


  <script>
    scr = "https://code.jquery.com/jquery-3.6.0.min.js"
  </script>
  <script>
    src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
  </script>
</body>

</html>