<?php

require_once "config/connect.php";

if (isset($_POST["id"])) {

  $query = "DELETE FROM schedule WHERE id=:id";
  $statement = $conn->prepare($query);
  $statement->execute(
    array(
      ':id' => $_POST['id']
    )
  );
}
