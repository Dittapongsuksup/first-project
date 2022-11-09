<?php


require_once "config/connect.php";

if (isset($_POST["title"])) {
  $query = "INSERT INTO schedule (title, start, end) 
            VALUES (:title, :start, :end)";
  $statement = $conn->prepare($query);
  $statement->execute(
    array(
      ':title'  => $_POST['title'],
      ':start' => $_POST['start'],
      ':end' => $_POST['end'] 
    )
  );
}
