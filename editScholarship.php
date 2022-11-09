<?php
session_start();
require_once 'config/connect.php';

if (isset($_POST['update'])) {
    $scholarshipId = $_POST['scholarshipId'];
    $schType = $_POST['schType'];

    $stmt = $conn->prepare("UPDATE scholarship SET schType=:schType WHERE scholarshipId=:scholarshipId");
    $stmt->bindParam(":scholarshipId", $scholarshipId);
    $stmt->bindParam(":schType", $schType);
    $stmt->execute();

    if ($stmt) {
        $_SESSION['success'] = "Data has been updated successfully";
        header('location: scholarshipPage.php');
    } else {
        $_SESSION['error'] = "Data has not been updated successfully !!";
        header('location: scholarshipPage.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit scholarship</title>
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
        <form action="editScholarship.php" method="POST">
            <?php
            if (isset($_GET['scholarshipId'])) {
                $scholarshipId = $_GET['scholarshipId'];
                $stmt = $conn->query("SELECT * FROM scholarship WHERE scholarshipId = $scholarshipId");
                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>
            <div class="mb-3">
                <input type="text" readonly value="<?= $data['scholarshipId']; ?>" class="form-control" name="scholarshipId">
                <label for="schType" class="col-form-label">เลขประจำตัวนักศึกษา</label>
                <input type="text" value="<?= $data['schType']; ?>" required class="form-control" name="schType">
            </div>
            <div class="modal-footer">
                <a class="btn btn-secondary" href="scholarshipPage.php">Go Back</a>
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
</body>

</html>