<?php


require_once "config/connect.php";

if (isset($_POST["id"])) {
  $query = "UPDATE schedule 
            SET title=:title, start=:start, end=:end
            WHERE id=:id";
  $statement = $conn->prepare($query);
  $statement->execute(
    array(
      ':title'  => $_POST['title'],
      ':start' => $_POST['start'],
      ':end' => $_POST['end'],
      ':id'   => $_POST['id']
    )
  );
}
