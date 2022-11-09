<?php


require_once "config/connect.php";

$data = array();

$query = "SELECT * FROM schedule ORDER BY id";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach ($result as $row) {
  $data[] = array(
    'id'   => $row["id"],
    'title'   => $row["title"],
    'start'   => $row["start"],
    'end'   => $row["end"]
  );
}

echo json_encode($data);
