<?php
require_once('config/connect.php');
function filterData(&$str)
{
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
$fileName = "registered-data_" . date('Y-m-d') . ".xls";
// Column names 
$fields = array(
  'STUDENT ID',
  'FIRST NAME',
  'LAST NAME',
  'TITLE',
  'ACTIVITY DATE',
  'REGISTER DATE',
  'RESULT'
);
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";
$query = $conn->query("SELECT a.*, act.title, act.actDatetime, s.studentId, s.firstName, s.lastName
                        FROM act_register as a 
                        INNER JOIN activities as act ON a.actId=act.actId
                        INNER JOIN students as s ON a.stId=s.stId
                        ORDER BY registerId ASC");
if ($query->rowCount() > 0) {
  while ($row = $query->fetch()) {
    $lineData = array(
      $row['studentId'],
      $row['firstName'],
      $row['lastName'],
      $row['title'],
      $row['actDatetime'],
      $row['registerDate'],
      $row['result']
    );
    array_walk($lineData, 'filterData');
    $excelData .= implode("\t", array_values($lineData)) . "\n";
  }
} else {
  $excelData .= 'No records found...' . "\n";
}
//echo "\xEF\xBB\xBF";
header("content-type:application/vnd.ms-excel");
header('Content-Encoding: UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");

echo $excelData;
exit;
