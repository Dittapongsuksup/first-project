<?php

session_start();
require_once 'config/connect.php';

if (isset($_POST['update'])) {
  $registerId = $_POST['registerId'];
  $actId = $_POST['actId'];
  $stId = $_POST['stId'];
  $registerDate = $_POST['registerDate'];
  $result = $_POST['result'];


  $stmt = $conn->prepare("UPDATE act_register SET actId=:actId, stId=:stId, registerDate=:registerDate, result=:result 
                                            WHERE registerId=:registerId");
  $stmt->bindParam(":registerId", $registerId);
  $stmt->bindParam(":actId", $actId);
  $stmt->bindParam(":stId", $stId);
  $stmt->bindParam(":registerDate", $registerDate);
  $stmt->bindParam(":result", $result);

  $stmt->execute();

  if ($stmt) {
    $_SESSION['success'] = "Data has been updated successfully";
    header('location: viewRegister.php');
  } else {
    $_SESSION['error'] = "Data has not been updated successfully !!";
    header('location: viewRegister.php');
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registered Result</title>
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

  <div class="container mb-5 mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">
        <h1>แก้ไขผลลัพท์</h1>
        <hr>
        <form action="editRegister.php" method="POST">
          <?php
          if (isset($_GET['registerId'])) {
            $registerId = $_GET['registerId'];
            $stmt = $conn->query("SELECT a.*, act.title, s.studentId, s.firstName, s.lastName
            FROM act_register as a 
            INNER JOIN activities as act ON a.actId=act.actId
            INNER JOIN students as s ON a.stId=s.stId 
            WHERE registerId = $registerId");
            $stmt->execute();
            $data = $stmt->fetch();
          }
          ?>
          <div class="mb-3">
            <input type="text" hidden value="<?= $data['registerId']; ?>" class="form-control" name="registerId">
            <input type="text" hidden value="<?= $data['actId']; ?>" class="form-control" name="actId">
            <label for="title" class="col-form-label">ชื่อจิตอาสา</label>
            <input type="text" readonly value="<?= $data['title']; ?>" class="form-control">
          </div>
          <div class="mb-3">
            <input type="text" hidden value="<?= $data['stId']; ?>" class="form-control" name="stId">
            <label for="studentId" class="col-form-label">รหัสนักศึกษา</label>
            <input type="text" readonly value="<?= $data['studentId']; ?>" class="form-control">
            <div class="mb-3">
              <label for="firstName" class="col-form-label">ชื่อ นามสกุล</label>
              <input type="text" readonly value="<?= $data['firstName'] . "  " . $data['lastName']; ?>" class="form-control">
            </div>
          </div>
          <div class="mb-3">
            <label for="registerDate" class="col-form-label">วันที่ลงทะเบียน</label>
            <input type="text" readonly value="<?= $data['registerDate']; ?>" class="form-control" name="registerDate">
          </div>
          <div class="mb-3">
            <label for="result" class="col-form-label">ผลลัพท์</label>
            <select class="form-select" aria-label="Default select example" name="result">
              <option value="<?= $data['result']; ?>"><?= $data['result']; ?></option>
              <option value="ผ่าน">ผ่าน</option>
              <option value="ไม่ผ่าน">ไม่ผ่าน</option>
              <option value="รอแก้ไข">รอแก้ไข</option>
              <option value="ยกเลิก">ยกเลิก</option>
            </select>
          </div>
          <div class="modal-footer">
            <a class="btn btn-secondary" href="viewRegister.php">Go Back</a>
            <button type="submit" name="update" class="btn btn-success" onclick="return confirm('Are you sure you want to update data!!');">Update</button>
          </div>
        </form>
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