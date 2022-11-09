<?php

  session_start();
  require_once 'config/connect.php';

  if (isset($_POST['register'])) {
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
    $userRole = "user";
    $roleId = $_POST['roleId'];
    $password = $_POST['password'];
    $image = $_FILES['image'];

    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode(".", $image['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;
    $filePath = "upload/" . $fileNew;

    $sql = $conn->prepare("SELECT * FROM students WHERE studentId= :studentId");
    $sql->bindParam(":studentId",$studentId);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if ($row['studentId'] == $studentId) {
      $_SESSION['error'] = "รหัสนักศึกษาของคุณ มีการลงทะเบียนเรียบร้อยแล้ว กรุณา Login !!";
      header('location: register.php');
    }
    else {

      if (in_array($fileActExt, $allow)) {

        if ($image['size'] > 0 && $image['error'] == 0) {
  
          if (move_uploaded_file($image['tmp_name'], $filePath)) {
            $stmt = $conn->prepare("INSERT INTO students (studentId, firstName, lastName, personId, birthDate, phone, address, scholarshipId, statusId, awards, study, class, facultyId, majorId, fatherName, fPhone, motherName, mPhone, clubName, position, size, number, userRole, roleId, password, image )
                                    VALUES (:studentId, :firstName, :lastName, :personId, :birthDate, :phone, :address, :scholarshipId, :statusId, :awards, :study, :class, :facultyId, :majorId, :fatherName, :fPhone, :motherName, :mPhone, :clubName, :position, :size, :number, :userRole, :roleId, :password, :image)");
  
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
              $_SESSION['success'] = "Data has been registered successfully";
              header('location:register.php');
            } else {
              $_SESSION['error'] = "Data has not been registered successfully !!";
              header('location:register.php');
            }
          }
        }
      }
    }

    
  }
