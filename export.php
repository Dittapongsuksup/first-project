<?php
// Load the database configuration file 
require_once('config/connect.php');

// Filter the excel data 
function filterData(&$str)
{
  $str = preg_replace("/\t/", "\\t", $str);
  $str = preg_replace("/\r?\n/", "\\n", $str);
  if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}
//bom UTF-8
//$bom = chr(239) . chr(187) . chr(191);

// Excel file name for download 
$fileName = "students-data_" . date('Y-m-d') . ".xls";

// Column names 
$fields = array(
  'ID',
  'STUDENT ID',
  'FIRST NAME',
  'LAST NAME',
  'PERSONAL ID',
  'BIRTH DATE',
  'PHONE',
  'ADDRESS',
  'SCHOLARSHIP',
  'STATUS',
  'AWARDS',
  'STUDY',
  'CLASS',
  'FACULTY',
  'MAJOR',
  'FATHER NAME',
  'FATHER PHONE',
  'MOTHER NAME',
  'MOTHER PHONE',
  'CLUB NAME',
  'POSITION',
  'SIZE BODY',
  'NUMBER',
  'USER ROLE',
  'ROLES TYPE',
  'PASSWORD'
);

// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n";

// Fetch records from database 
$query = $conn->query("SELECT s.*, f.facultyName, m.majorName,st.status,sch.schType,r.roleType 
                        FROM students as s 
                        INNER JOIN faculties as f ON s.facultyId=f.facultyId
                        INNER JOIN major as m ON s.majorId=m.majorId 
                        INNER JOIN st_status as st ON s.statusId=st.statusId 
                        INNER JOIN scholarship as sch ON s.scholarshipId=sch.scholarshipId 
                        INNER JOIN roles as r ON s.roleId=r.roleId 
                        WHERE userRole != 'admin'
                        ORDER BY s.stId ASC");
if ($query->rowCount() > 0) {
  // Output each row of the data 
  while ($row = $query->fetch()) {
    $lineData = array(
      $row['stId'],
      $row['studentId'],
      $row['firstName'],
      $row['lastName'],
      $row['personId'],
      $row['birthDate'],
      $row['phone'],
      $row['address'],
      $row['schType'],
      $row['status'],
      $row['awards'],
      $row['study'],
      $row['class'],
      $row['facultyName'],
      $row['majorName'],
      $row['fatherName'],
      $row['fPhone'],
      $row['motherName'],
      $row['mPhone'],
      $row['clubName'],
      $row['position'],
      $row['size'],
      $row['number'],
      $row['userRole'],
      $row['roleType'],
      $row['password']
    );

    array_walk($lineData, 'filterData');

    $excelData .= implode("\t", array_values($lineData)) . "\n";
  }
} else {
  $excelData .= 'No records found...' . "\n";
}

// Headers for download 
header("content-type:application/vnd.ms-excel");
header('Content-Encoding: UTF-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");


// Render excel data 
echo $excelData;

exit;
