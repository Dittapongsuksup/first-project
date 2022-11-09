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
    <title>Profile Student</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Html2Pdf  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js" integrity="sha512vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A==" crossorigin="anonymous"></script>
</head>
<style>
    body {
        color: #797979;
        background: #f1f2f7;
        font-family: 'Open Sans', sans-serif;
        padding: 0px !important;
        margin: 0px !important;
        font-size: 13px;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        -moz-font-smoothing: antialiased;
    }

    .profile-nav,
    .profile-info {
        margin-top: 30px;
    }

    .profile-nav .user-heading {
        background: #198754;
        color: #fff;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
        padding: 30px;
        text-align: center;
    }

    .profile-nav .user-heading.round a {
        border-radius: 50%;
        -webkit-border-radius: 50%;
        border: 10px solid rgba(255, 255, 255, 0.3);
        display: inline-block;
    }

    .profile-nav .user-heading a img {
        width: 112px;
        height: 112px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
    }

    .profile-nav .user-heading h1 {
        font-size: 22px;
        font-weight: 300;
        margin-bottom: 5px;
    }

    .profile-nav .user-heading p {
        font-size: 12px;
    }

    .profile-nav ul {
        margin-top: 1px;
    }

    .profile-nav ul>li {
        border-bottom: 1px solid #ebeae6;
        margin-top: 0;
        line-height: 30px;
    }

    .profile-nav ul>li:last-child {
        border-bottom: none;
    }

    .profile-nav ul>li>a {
        border-radius: 0;
        -webkit-border-radius: 0;
        color: #89817f;
        border-left: 5px solid #fff;
    }

    .profile-nav ul>li>a:hover,
    .profile-nav ul>li>a:focus,
    .profile-nav ul li.active a {
        background: #f8f7f5 !important;
        border-left: 5px solid #198754;
        color: #89817f !important;
    }

    .profile-nav ul>li:last-child>a:last-child {
        border-radius: 0 0 4px 4px;
        -webkit-border-radius: 0 0 4px 4px;
    }

    .profile-nav ul>li>a>i {
        font-size: 16px;
        padding-right: 10px;
        color: #bcb3aa;
    }

    .r-activity {
        margin: 6px 0 0;
        font-size: 12px;
    }


    .p-text-area,
    .p-text-area:focus {
        border: none;
        font-weight: 300;
        box-shadow: none;
        color: #c3c3c3;
        font-size: 16px;
    }

    .profile-info .panel-footer {
        background-color: #f8f7f5;
        border-top: 1px solid #e7ebee;
    }

    .profile-info .panel-footer ul li a {
        color: #7a7a7a;
    }

    .bio-graph-heading {
        background: #198754;
        color: #fff;
        text-align: center;
        font-style: italic;
        padding: 40px 110px;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
        font-size: 16px;
        font-weight: 300;
    }

    .bio-graph-info {
        color: #89817e;
    }

    .bio-graph-info h1 {
        font-size: 22px;
        font-weight: 300;
        margin: 0 0 20px;
    }

    .bio-row {
        width: 50%;
        float: left;
        margin-bottom: 10px;
        padding: 0 15px;
    }

    .bio-row p span {
        width: 100px;
        display: inline-block;
    }

    .bio-chart,
    .bio-desk {
        float: left;
    }

    .bio-chart {
        width: 40%;
    }

    .bio-desk {
        width: 60%;
    }

    .bio-desk h4 {
        font-size: 15px;
        font-weight: 400;
    }

    .bio-desk h4.terques {
        color: #4CC5CD;
    }

    .bio-desk h4.red {
        color: #e26b7f;
    }

    .bio-desk h4.green {
        color: #97be4b;
    }

    .bio-desk h4.purple {
        color: #caa3da;
    }

    .file-pos {
        margin: 6px 0 10px 0;
    }

    .profile-activity h5 {
        font-weight: 300;
        margin-top: 0;
        color: #c3c3c3;
    }

    .summary-head {
        background: #ee7272;
        color: #fff;
        text-align: center;
        border-bottom: 1px solid #ee7272;
    }

    .summary-head h4 {
        font-weight: 300;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .summary-head p {
        color: rgba(255, 255, 255, 0.6);
    }

    ul.summary-list {
        display: inline-block;
        padding-left: 0;
        width: 100%;
        margin-bottom: 0;
    }

    ul.summary-list>li {
        display: inline-block;
        width: 19.5%;
        text-align: center;
    }

    ul.summary-list>li>a>i {
        display: block;
        font-size: 18px;
        padding-bottom: 5px;
    }

    ul.summary-list>li>a {
        padding: 10px 0;
        display: inline-block;
        color: #818181;
    }

    ul.summary-list>li {
        border-right: 1px solid #eaeaea;
    }

    ul.summary-list>li:last-child {
        border-right: none;
    }

    .activity {
        width: 100%;
        float: left;
        margin-bottom: 10px;
    }

    .activity.alt {
        width: 100%;
        float: right;
        margin-bottom: 10px;
    }

    .activity span {
        float: left;
    }

    .activity.alt span {
        float: right;
    }

    .activity span,
    .activity.alt span {
        width: 45px;
        height: 45px;
        line-height: 45px;
        border-radius: 50%;
        -webkit-border-radius: 50%;
        background: #eee;
        text-align: center;
        color: #fff;
        font-size: 16px;
    }

    .activity.terques span {
        background: #8dd7d6;
    }

    .activity.terques h4 {
        color: #8dd7d6;
    }

    .activity.purple span {
        background: #b984dc;
    }

    .activity.purple h4 {
        color: #b984dc;
    }

    .activity.blue span {
        background: #90b4e6;
    }

    .activity.blue h4 {
        color: #90b4e6;
    }

    .activity.green span {
        background: #aec785;
    }

    .activity.green h4 {
        color: #aec785;
    }

    .activity h4 {
        margin-top: 0;
        font-size: 16px;
    }

    .activity p {
        margin-bottom: 0;
        font-size: 13px;
    }

    .activity .activity-desk i,
    .activity.alt .activity-desk i {
        float: left;
        font-size: 18px;
        margin-right: 10px;
        color: #bebebe;
    }

    .activity .activity-desk {
        margin-left: 70px;
        position: relative;
    }

    .activity.alt .activity-desk {
        margin-right: 70px;
        position: relative;
    }

    .activity.alt .activity-desk .panel {
        float: right;
        position: relative;
    }

    .activity-desk .panel {
        background: #F4F4F4;
        display: inline-block;

    }


    .activity .activity-desk .arrow {
        border-right: 8px solid #F4F4F4 !important;
    }

    .activity .activity-desk .arrow {
        border-bottom: 8px solid transparent;
        border-top: 8px solid transparent;
        display: block;
        height: 0;
        left: -7px;
        position: absolute;
        top: 13px;
        width: 0;
    }

    .activity-desk .arrow-alt {
        border-left: 8px solid #F4F4F4 !important;
    }

    .activity-desk .arrow-alt {
        border-bottom: 8px solid transparent;
        border-top: 8px solid transparent;
        display: block;
        height: 0;
        right: -7px;
        position: absolute;
        top: 13px;
        width: 0;
    }

    .activity-desk .album {
        display: inline-block;
        margin-top: 10px;
    }

    .activity-desk .album a {
        margin-right: 10px;
    }

    .activity-desk .album a:last-child {
        margin-right: 0px;
    }
</style>

<body>
    <div class="container bootstrap snippets bootdey">
        <!--enctype="multipart/form-data"-->
        <?php
        if (isset($_GET['stId'])) {
            $stId = $_GET['stId'];
            $sql = $conn->query("SELECT s.*, f.facultyName, m.majorName,st.status,sch.schType,r.roleType
                    FROM students as s
                    INNER JOIN faculties as f ON s.facultyId=f.facultyId 
                    INNER JOIN major as m ON s.majorId=m.majorId
                    INNER JOIN st_status as st ON s.statusId=st.statusId
                    INNER JOIN scholarship as sch ON s.scholarshipId=sch.scholarshipId
                    INNER JOIN roles as r ON s.roleId=r.roleId
                    WHERE stId=$stId");
            $sql->execute();
            $data = $sql->fetchAll();
        }
        ?>

        <div class="row">
            <div class="profile-nav col-md-3">
                <div class="panel">
                    <?php foreach ($data as $rows) { ?>
                        <div class="user-heading round">
                            <a href="#">
                                <img width="50%" src="upload/<?= $rows['image']; ?>" id="previewImg" alt="">
                            </a>
                            <h1><?= $rows['firstName']; ?>&nbsp;<?= $rows['lastName']; ?></h1>
                            <h4>
                                <p><?= $rows['studentId']; ?></p>
                            </h4>

                        </div>
                        <ul class="nav nav-pills nav-stacked">
                            <li class="active"><a href="#"> <i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="changeRole.php?stId=<?= $rows['stId']; ?>"> <i class="fa fa-wrench"></i> Manage Account &nbsp;<span class="label  pull-right r-wrench">&nbsp;</span></a></li>
                            <li><a href="exportPDF.php"><i class="fa fa-download"></i>Download to PDF</a></li>
                            <li><a href="studentPage.php"> <i class="fa fa-home"></i> Go Back </a></li>
                        </ul>

                </div>
            </div>
            <div class="profile-info  col-md-9">
                <div class="panel">
                    <div class="bio-graph-heading Success">
                        <h4>ข้อมูลส่วนตัวนักศึกษา</h4>
                    </div></br>
                    <p class="text-end uppercase fw-bold col-md-11 $red-400" style="color:red;"><span>ประเภททุนการศึกษา :</span>&nbsp;<?= $rows['schType']; ?></p>
                    </br>
                    <div class="user col-md-11">
                        <img src="upload/<?= $rows['image']; ?>" width="180" height="220" id="previewImg" class="rounded float-end">
                        <img src="./assets/LogoTRU5_1.png" width="100" height="100" style="display: block; margin-left: auto; margin-right: auto;" class="rounded float-start">
                        </br>
                        <h4>&nbsp;แบบฟอร์มประวัตินักกีฬาทุนการศึกษา</h4>
                        <h4>&nbsp;ศูนย์กีฬาพัฒนาสู่ความเป็นเลิศ มหาวิทยาลัยธนบุรี</h4>
                    </div>
                    <div class="text ml-5">
                        <h2>
                            <p style="color:#6495ED">&nbsp;&nbsp;&nbsp;ข้อมูลส่วนตัว</p>
                        </h2>
                    </div>
                    <div class="panel-body ">
                        <div class="row col-md-14">
                            <div class="bio-row text ml-5">
                                <p>&nbsp;&nbsp;&nbsp;<span>ชื่อ </span>:&nbsp;<?= $rows['firstName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>นามสกุล </span>:&nbsp;<?= $rows['lastName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>หมายเลขบัตรประชาชน</span>:&nbsp;<?= $rows['personId']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>วัน/เดือน/ปีเกิด</span>:&nbsp;<?= $rows['birthDate']; ?></p>
                            </div>
                            <div class="bio-row ml-5">
                                <p>&nbsp;&nbsp;&nbsp;<span>ที่อยู่ </span>:&nbsp;<?= $rows['address']; ?></p>
                            </div>

                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ทุนการศึกษา</span>:&nbsp;<?= $rows['schType']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>สถานะการศึกษา </span>:&nbsp;<?= $rows['status']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>รางวัล </span>:&nbsp;<?= $rows['awards']; ?></p>
                            </div></br>
                            <h2>
                                <p style="color:#6495ED">&nbsp;&nbsp;ข้อมูลด้านการศึกษา</p>
                            </h2></br>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ระดับการศึกษา</span>:&nbsp;<?= $rows['study']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ระดับชั้น</span>:&nbsp;<?= $rows['class']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>คณะ</span>:&nbsp;<?= $rows['facultyName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>สาขา</span>:&nbsp;<?= $rows['majorName']; ?></p>
                            </div>
                            <h2>
                                <p style="color:#6495ED">&nbsp;&nbsp;ข้อมูลครอบครัว</p>
                            </h2></br>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ชื่อ/สกุล บิดา</span>:&nbsp;<?= $rows['fatherName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>เบอร์โทรศัพท์</span>:&nbsp;<?= $rows['fPhone']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ชื่อ/สกุล มารดา</span>:&nbsp;<?= $rows['motherName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>เบอร์โทรศัพท์</span>:&nbsp;<?= $rows['mPhone']; ?></p>
                            </div>
                            <h2>
                                <p style="color:#6495ED">&nbsp;&nbsp;ข้อมูลประวัติการเล่นฟุตซอล</p>
                            </h2></br>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ชื่อทีมหรือสโมสร</span>:&nbsp;<?= $rows['clubName']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>ตำแหน่ง</span>:&nbsp;<?= $rows['position']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>SIZE ชุดกีฬา</span>:&nbsp;<?= $rows['size']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>หมายเลขเสื้อ</span>:&nbsp;<?= $rows['number']; ?></p>
                            </div>
                            <div class="bio-row">
                                <p>&nbsp;&nbsp;&nbsp;<span>สถานะผู้เล่น</span>:&nbsp;<?= $rows['roleType']; ?></p>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div></br>
            </div>
        </div>
    </div>

    <script>
        scr = "https://code.jquery.com/jquery-3.6.0.min.js"
    </script>
    <script>
        src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</body>

</html>