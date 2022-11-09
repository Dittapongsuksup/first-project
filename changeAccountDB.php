<?php
session_start();
require_once('config/connect.php');

if (isset($_GET['stId'])) {
  $stId = $_GET['stId'];

  $sql = $conn->query("SELECT userRole FROM students WHERE stId = $stId");
  $sql->execute();
  $check = $sql->fetch();

  if ($check['userRole'] == 'user') {
    $userRole = 'admin';
  } else {
    $userRole = 'user';
  }

  $changeData = $conn->prepare("UPDATE students SET userRole=:userRole WHERE stId=:stId");
  $changeData->bindParam(":stId", $stId);
  $changeData->bindParam(":userRole", $userRole);
  $changeData->execute();

  if ($changeData) {
    $_SESSION['success'] = "Data has been updated successfully";
    header('location: changeAccount.php');
  } else {
    $_SESSION['error'] = "Data has not been updated successfully !!";
    header('location: changeAccount.php');
  }
}
