<?php

session_start();
require_once 'config/connect.php';

$scholarship = $conn->query("SELECT * FROM scholarship ORDER BY scholarshipId ASC");
$scholarship->execute();
$stmtSch = $scholarship->fetchAll();

$faculty = $conn->query("SELECT * FROM faculties ORDER BY facultyId ASC");
$faculty->execute();
$stmtFac = $faculty->fetchAll();

$major = $conn->query("SELECT * FROM major ORDER BY majorId ASC");
$major->execute();
$stmtMajor = $major->fetchAll();

$status = $conn->query("SELECT * FROM st_status ORDER BY statusId ASC");
$status->execute();
$stmtStatus = $status->fetchAll();

$roles = $conn->query("SELECT * FROM roles ORDER BY roleId ASC");
$roles->execute();
$stmtRoles = $roles->fetchAll();

if (isset($_POST['update'])) {
    $stId = $_POST['stId'];
    $studentId = $_POST['studentId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $personId = $_POST['personId'];
    $birthDate = $_POST['birthDate'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $scholarshipId = $_POST['scholarshipId'];
    $statusId = $_POST['statusId'];
    $awards = $_POST['awards'];
    $study = $_POST['study'];
    $class = $_POST['class'];
    $facultyId = $_POST['facultyId'];
    $majorId = $_POST['majorId'];
    $fatherName = $_POST['fatherName'];
    $fPhone = $_POST['fPhone'];
    $motherName = $_POST['motherName'];
    $mPhone = $_POST['mPhone'];
    $clubName = $_POST['clubName'];
    $position = $_POST['position'];
    $size = $_POST['size'];
    $number = $_POST['number'];
    $userRole = $_POST['userRole'];
    $roleId = $_POST['roleId'];
    $password = $_POST['password'];
    $image = $_FILES['image'];

    $image2 = $_POST['image2'];
    $upload = $_FILES['image']['name'];

    if ($upload != '') {

        $allow = array('jpg', 'jpeg', 'png');
        $extension = explode(".", $image['name']);
        $fileActExt = strtolower(end($extension));
        $fileNew = rand() . "." . $fileActExt;
        $filePath = "upload/" . $fileNew;

        if (in_array($fileActExt, $allow)) {
            if ($image['size'] > 0 && $image['error'] == 0) {
                move_uploaded_file($image['tmp_name'], $filePath);
            }
        }
    } 
    else {
        $fileNew = $image2;
    }

    $stmt = $conn->prepare("UPDATE students SET studentId=:studentId, firstName=:firstName, lastName=:lastName,
        personId=:personId, birthDate=:birthDate, phone=:phone, address=:address, scholarshipId=:scholarshipId, 
        statusId=:statusId, awards=:awards, study=:study, class=:class, facultyId=:facultyId, majorId=:majorId, 
        fatherName=:fatherName, fPhone=:fPhone, motherName=:motherName, mPhone=:mPhone, clubName=:clubName, 
        position=:position, size=:size, number=:number, userRole=:userRole, roleId=:roleId, password=:password, image=:image WHERE stId=:stId");

    $stmt->bindParam(":stId", $stId);
    $stmt->bindParam(":studentId", $studentId);
    $stmt->bindParam(":firstName", $firstName);
    $stmt->bindParam(":lastName", $lastName);
    $stmt->bindParam(":personId", $personId);
    $stmt->bindParam(":birthDate", $birthDate);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":address", $address);
    $stmt->bindParam(":scholarshipId", $scholarshipId);
    $stmt->bindParam(":statusId", $statusId);
    $stmt->bindParam(":awards", $awards);
    $stmt->bindParam(":study", $study);
    $stmt->bindParam(":class", $class);
    $stmt->bindParam(":facultyId", $facultyId);
    $stmt->bindParam(":majorId", $majorId);
    $stmt->bindParam(":fatherName", $fatherName);
    $stmt->bindParam(":fPhone", $fPhone);
    $stmt->bindParam(":motherName", $motherName);
    $stmt->bindParam(":mPhone", $mPhone);
    $stmt->bindParam(":clubName", $clubName);
    $stmt->bindParam(":position", $position);
    $stmt->bindParam(":size", $size);
    $stmt->bindParam(":number", $number);
    $stmt->bindParam(":userRole", $userRole);
    $stmt->bindParam(":roleId", $roleId);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":image", $fileNew);

    $stmt->execute();
    if ($stmt) {
        $_SESSION['success'] = "Data has been updated successfully";
        header('location: studentPage.php');
    } else {
        $_SESSION['error'] = "Data has not been updated successfully !!";
        header('location: studentPage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
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
        <form action="editStudent.php" method="post" enctype="multipart/form-data" class="row g-1">
            <!--enctype="multipart/form-data"-->
            <?php
            if (isset($_GET['stId'])) {
                $stId = $_GET['stId'];
                $stmt = $conn->query("SELECT * FROM students WHERE stId = $stId");
                $stmt->execute();
                $data = $stmt->fetch();
            }
            ?>
            <div class="mb-3">
                <input type="text" hidden value="<?= $data['stId']; ?>" class="form-control" name="stId">
                <label for="studentId" class="col-form-label">เลขประจำตัวนักศึกษา</label>
                <input type="text"readonly value="<?= $data['studentId']; ?>" required class="form-control" name="studentId">
            </div>
            <div class="mb-3">
                <label for="password" class="col-form-label">รหัสผ่าน</label>
                <input type="text" value="<?= $data['password']; ?>" required class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="firstName" class="col-form-label">ชื่อ</label>
                <input type="text" value="<?= $data['firstName']; ?>" required class="form-control" name="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="col-form-label">นามสกุล</label>
                <input type="text" value="<?= $data['lastName']; ?>" required class="form-control" name="lastName">
            </div>
            <div class="mb-3">
                <label for="personId" class="col-form-label">หมายเลขบัตรประชาชน</label>
                <input type="text"readonly value="<?= $data['personId']; ?>" required class="form-control" name="personId">
            </div>
            <div class="mb-3">
                <label for="birthDate" class="col-form-label">วัน/เดือน/ปีเกิด</label>
                <input type="date"readonly value="<?= $data['birthDate']; ?>" class="form-control" name="birthDate">
            </div>

            <div class="mb-3">
                <label for="phone" class="col-form-label">หมายเลขโทรศัพท์</label>
                <input type="text" value="<?= $data['phone']; ?>" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <label for="address" class="col-form-label">ที่อยู่</label>
                <input type="text" value="<?= $data['address']; ?>" class="form-control" name="address">
            </div>

            <div class="mb-3">
                <label for="scholarshipId" class="col-form-label">ทุนการศึกษา</label>
                <select name="scholarshipId" required class="form-select" aria-label="Default select example">
                    <option value="<?= $data['scholarshipId']; ?>">--กรุณาเลือกทุนการศึกษา--</option>
                    <?php foreach ($stmtSch as $sch) { ?>
                        <option value="<?php echo $sch['scholarshipId']; ?>">
                            <?php echo $sch['schType']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="statusId" class="col-form-label">สถานะการศึกษา</label>
                <select required class="form-select" name="statusId" aria-label="Default select example">
                    <option value="<?= $data['statusId']; ?>">--กรุณาเลือกสถานะการศึกษา--</option>
                    <?php foreach ($stmtStatus as $stat) { ?>
                        <option value="<?php echo $stat['statusId']; ?>">
                            <?php echo $stat['status']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="awards" class="col-form-label">รางวัล</label>
                <input type="text" value="<?= $data['awards']; ?>" class="form-control" name="awards">
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">ข้อมูลด้านการศึกษา</h5>
            </div>
            <div class="mb-3">
                <label for="study" class="col-form-label">ระดับการศึกษา</label>
                <select required class="form-select" name="study" aria-label="Default select example">
                    <option value="<?= $data['study']; ?>">--กรุณาเลือกระดับการศึกษา--</option>
                    <option value="ปริญญาตรี 4 ปี">ปริญญาตรี 4 ปี</option>
                    <option value="ปริญญาตรี 2 ปี">ปริญญาตรี 2 ปี</option>
                    <option value="ปริญญาโท">ปริญญาโท</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="class" class="col-form-label">ระดับชั้น</label>
                <select class="form-select" required name="class" aria-label="Default select example">
                    <option value="<?= $data['class']; ?>"><?= $data['class']; ?></option>
                    <option value="ปี 4">ปี 4</option>
                    <option value="ปี 3">ปี 3</option>
                    <option value="ปี 2">ปี 2</option>
                    <option value="ปี 1">ปี 1</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="facultyId" class="col-form-label">คณะ</label>
                <select required class="form-select" name="facultyId" aria-label="Default select example">
                    <option value="<?= $data['facultyId']; ?>">--กรุณาเลือกคณะ--</option>
                    <?php foreach ($stmtFac as $fac) { ?>
                        <option value="<?php echo $fac['facultyId']; ?>">
                            <?php echo $fac['facultyName']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="majorId" class="col-form-label">สาขา</label>
                <select required class="form-select" name="majorId" aria-label="Default select example">
                    <option value="<?= $data['majorId']; ?>">--กรุณาเลือกสาขา--</option>
                    <?php foreach ($stmtMajor as $maj) { ?>
                        <option value="<?php echo $maj['majorId']; ?>">
                            <?php echo $maj['majorName']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">ข้อมูลครอบครัว</h5>
            </div>
            <div class="mb-3">
                <label for="fatherName" class="col-form-label">ชื่อ/นามสกุล บิดา</label>
                <input type="text" value="<?= $data['fatherName']; ?>" class="form-control" name="fatherName">
            </div>
            <div class="mb-3">
                <label for="fPhone" class="col-form-label">เบอร์โทรศัพท์</label>
                <input type="text" value="<?= $data['fPhone']; ?>" class="form-control" name="fPhone">
            </div>
            <div class="mb-3">
                <label for="motherName" class="col-form-label">ชื่อ/นามสกุล มารดา</label>
                <input type="text" value="<?= $data['motherName']; ?>" class="form-control" name="motherName">
            </div>
            <div class="mb-3">
                <label for="mPhone" class="col-form-label">เบอร์โทรศัพท์</label>
                <input type="text" value="<?= $data['mPhone']; ?>" class="form-control" name="mPhone">
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">ข้อมูลประวัติการเล่นฟุตซอล</h5>
            </div>
            <div class="mb-3">
                <label for="clubName" class="col-form-label">ชื่อทีมหรือสโมสร</label>
                <input type="text" value="<?= $data['clubName']; ?>" class="form-control" name="clubName">
            </div>
            <div class="mb-3">
                <label for="position" class="col-form-label">ตำแหน่ง</label>
                <input type="text" value="<?= $data['position']; ?>" class="form-control" name="position">
            </div>
            <div class="mb-3">
                <label for="size" class="col-form-label">SIZE ชุดกีฬา</label>
                <select class="form-select" required name="size" aria-label="Default select example">
                    <option value="<?= $data['size']; ?>"><?= $data['size']; ?></option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                    <option value="XXL">XXL</option>
                    <option value="XXXL">XXXL</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="number" class="col-form-label">หมายเลขเสื้อ</label>
                <input type="text" value="<?= $data['number']; ?>" class="form-control" name="number">
            </div>
            <input type="text" hidden value="<?= $data['userRole']; ?>" class="form-control" name="userRole">
            <div class="mb-0">
                <label for="roleId" class="col-form-label">สถานะผู้เล่น</label>
                <select required class="form-select" name="roleId" aria-label="Default select example">
                    <option value="<?= $data['roleId']; ?>">--กรุณาเลือกสถานะ--</option>
                    <?php foreach ($stmtRoles as $role) { ?>
                        <option value="<?php echo $role['roleId']; ?>">
                            <?php echo $role['roleType']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="col-form-label">รูปภาพ</label>
                <input type="file" id="imgInput" class="form-control" name="image">
                <img width="100%" src="upload/<?= $data['image']; ?>" id="previewImg" alt="">
                <input type="hidden" value="<?= $data['image']; ?>" class="form-control" name="image2">
            </div>

            <div class="modal-footer">
                <a class="btn btn-secondary" href="studentPage.php">Cancel</a>
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