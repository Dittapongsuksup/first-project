<?php

    session_start();
    require_once 'config/connect.php';

    if (isset($_POST['login'])) {
        $studentId = $_POST['studentId'];
        $password = $_POST['password'];

        if (empty($studentId)) {
            $_SESSION['error'] = "กรุณากรอกรหัสนักศึกษา";
            header('Location: loginForm.php');
        }

        
        else if(empty($password)) {
            $_SESSION['error'] = "กรุณากรอกรหัสผ่าน";
            header('Location: loginForm.php');
        }
        else {
            try {

                $check_data = $conn->prepare("SELECT * FROM students WHERE studentId = :studentId");
                $check_data->bindParam(":studentId", $studentId);
                $check_data->execute();

                $row = $check_data->fetch(PDO::FETCH_ASSOC);
    
                if ($check_data->rowCount() > 0) {

                    if($studentId == $row['studentId']) {

                        if($password == $row['password']) {

                            if($row['userRole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['stId'];
                                $_SESSION['name'] = $row['firstName'] . "  " . $row['lastName'];
                                header('Location: dashboard.php');
                            }
                            elseif ($row['userRole'] == 'user') {
                                $_SESSION['user_login'] = $row['stId'];
                                $_SESSION['name'] = $row['firstName'] . "  " . $row['lastName'];
                                header('Location: user.php');
                            }
                            else {
                                header('Location: index.php');
                            }
                        }
                        else {
                            $_SESSION['error'] = "รหัสผ่านไม่ถูกต้อง";
                            header('Location: loginForm.php');
                        }
    
                    }
                    else {
                        $_SESSION['error'] = "รหัสนักศึกษาไม่ถูกต้อง";
                        header('Location: loginForm.php');
                    }
    
                }
                else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ กรุณาลงทะเบียน !!";
                    header('Location: loginForm.php');
                }
            } 
            catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }

?>
