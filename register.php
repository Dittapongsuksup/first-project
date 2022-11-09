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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Register</Table>
    </title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <style>
        .container {
            max-width: 600px;
        }
    </style>
</head>

<body>
    <!--from add data-->
    <div class="container">
        <h1>FROM REGISTER</h1>
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
        <form action="registerDB.php" method="post" enctype="multipart/form-data">
            <!--enctype="multipart/form-data"-->
            <div class="mb-3">
                <label for="studentId" class="col-form-label">เลขประจำตัวนักศึกษา</label>
                <input type="text" required class="form-control" name="studentId">
            </div>
            <div class="mb-3">
                <label for="password" class="col-form-label">รหัสผ่าน</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-3">
                <label for="firstName" class="col-form-label">ชื่อ</label>
                <input type="text" required class="form-control" name="firstName">
            </div>
            <div class="mb-3">
                <label for="lastName" class="col-form-label">นามสกุล</label>
                <input type="text" required class="form-control" name="lastName">
            </div>
            <div class="mb-3">
                <label for="personId" class="col-form-label">หมายเลขบัตรประชาชน</label>
                <input type="text" required class="form-control" name="personId">
            </div>
            <div class="mb-3">
                <label for="birthDate" class="col-form-label">วัน/เดือน/ปีเกิด</label>
                <input type="date" class="form-control" name="birthDate">
            </div>

            <div class="mb-3">
                <label for="phone" class="col-form-label">หมายเลขโทรศัพท์</label>
                <input type="text" class="form-control" name="phone">
            </div>
            <div class="mb-3">
                <label for="address" class="col-form-label">ที่อยู่</label>
                <input type="text" class="form-control" name="address">
            </div>

            <div class="mb-3">
                <label for="scholarshipId" class="col-form-label">ทุนการศึกษา</label>
                <select name="scholarshipId" required class="form-select" aria-label="Default select example">
                    <option value="">--กรุณาเลือกประเภททุนการศึกษา--</option>
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
                    <option value="">--กรุณาเลือกสถานภาพ--</option>
                    <?php foreach ($stmtStatus as $stat) { ?>
                        <option value="<?php echo $stat['statusId']; ?>">
                            <?php echo $stat['status']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="awards" class="col-form-label">รางวัล</label>
                <input type="text" class="form-control" name="awards">
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">ข้อมูลด้านการศึกษา</h5>
            </div>
            <div class="mb-3">
                <label for="study" class="col-form-label">ระดับการศึกษา</label>
                <select required class="form-select" name="study" aria-label="Default select example">
                    <option value="">--กรุณาเลือกระดับการศึกษา--</option>
                    <option value="ปริญญาตรี 4 ปี">ปริญญาตรี 4 ปี</option>
                    <option value="ปริญญาตรี 2 ปี">ปริญญาตรี 2 ปี</option>
                    <option value="ปริญญาโท">ปริญญาโท</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="class" class="col-form-label">ระดับชั้น</label>
                <select class="form-select" required name="class" aria-label="Default select example">
                    <option value="">-เลือกชั้นปี-</option>
                    <option value="ปี 4">ปี 4</option>
                    <option value="ปี 3">ปี 3</option>
                    <option value="ปี 2">ปี 2</option>
                    <option value="ปี 1">ปี 1</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="facultyId" class="col-form-label">คณะ</label>
                <select required class="form-select" name="facultyId" aria-label="Default select example">
                    <option value="">--กรุณาเลือกคณะ--</option>
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
                    <option value="">--กรุณาเลือกสาขา--</option>
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
                <input type="text" class="form-control" name="fatherName">
            </div>
            <div class="mb-3">
                <label for="fPhone" class="col-form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="fPhone">
            </div>
            <div class="mb-3">
                <label for="motherName" class="col-form-label">ชื่อ/นามสกุล มารดา</label>
                <input type="text" class="form-control" name="motherName">
            </div>
            <div class="mb-3">
                <label for="mPhone" class="col-form-label">เบอร์โทรศัพท์</label>
                <input type="text" class="form-control" name="mPhone">
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">ข้อมูลประวัติการเล่นฟุตซอล</h5>
            </div>
            <div class="mb-3">
                <label for="clubName" class="col-form-label">ชื่อทีมหรือสโมสร</label>
                <input type="text" class="form-control" name="clubName">
            </div>
            <div class="mb-3">
                <label for="position" class="col-form-label">ตำแหน่ง</label>
                <input type="text" class="form-control" name="position">
            </div>
            <div class="mb-3">
                <label for="size" class="col-form-label">SIZE ชุดกีฬา</label>
                <select class="form-select" required name="size" aria-label="Default select example">
                    <option selected>-เลือกขนาด-</option>
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
                <input type="text" class="form-control" name="number">
            </div>
            <div class="mb-0">
                <label for="roleId" class="col-form-label">สถานะผู้เล่น</label>
                <select required class="form-select" name="roleId" aria-label="Default select example">
                    <option value="">--กรุณาเลือกสถานะ--</option>
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
                <img width="100%" id="previewImg" alt="">
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning"><a href="index.php">Cancel</a></button>
                <button type="submit" class="btn btn-success" name="register">Register</button>
            </div>
        </form>
    </div>


    <script>
        scr = "https://code.jquery.com/jquery-3.6.0.min.js"
    </script>
    <script>
        src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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