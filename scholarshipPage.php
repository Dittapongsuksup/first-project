<?php

session_start();
require_once 'config/connect.php';

$scholarship = $conn->query("SELECT * FROM scholarship ORDER BY scholarshipId ASC");
$scholarship->execute();
$stmtSch = $scholarship->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarship</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container mt-4 mb-4">
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <div class="container-fluid">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item fw-normal">
                        <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item fw-normal">
                        <a class="nav-link active" aria-current="page" href="scholarshipPage.php">จัดการทุนการศึกษา</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-success" type="submit">Search</button>
                    </form>
                </ul>
            </div>
        </nav>
        <br>
    </div>

    <!--from add data-->
    <div class="container-sm">
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" style="text-align:center;" id="exampleModalLabel">เพิ่มข้อมูลทุนการศึกษา</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    </div>

                    <div class="modal-body">
                        <form action="insert.php" method="post">
                            <!--enctype="multipart/form-data"-->
                            <div class="mb-3">
                                <label for="schType" class="col-form-label">ประเภททุนการศึกษา</label>
                                <select name="schType" required class="form-control" aria-label="Default select example">
                                    <option selected>--เลือกประเภททุนการศึกษา--</option>
                                    <option value="100 %">100 %</option>
                                    <option value="50 %">50 %</option>
                                    <option value="ไม่มีทุนการศึกษา">ไม่มีทุนการศึกษา</option>
                                </select>
                            </div>
                            <!--<div class="mb-3">
                                <label for="semester" class="col-form-label">ภาคการศึกษา</label>
                                <input type="text" required class="form-control" name="semester">
                            </div>-->

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="addScholarship" class="btn btn-success" onclick="return confirm('Are you sure you want to insert data!!');">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h1>Data Scholarships</h1>
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#userModal">Add Scholarship</button>
                </div>
            </div>
            <br>
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                ประเภททุนการศึกษา
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <?php foreach ($stmtSch as $sch) { ?>
                                    <li><a class="dropdown-item" href="scholar.php?scholarshipId=<?= $sch['scholarshipId']; ?>"><?php echo $sch['schType']; ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2 mt-2 text-left" style="color:blueviolet;">
                        <h5>นักศึกษาทุน</h5>
                    </div>
                </div>
            </div>
            <br>
            <hr>
            <?php if (isset($_SESSION['success'])) { ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php } ?>

            <!--table data -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ประเภททุนการศึกษา</th>
                        <!--<th scope="col">ภาคการศึกษา</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = $conn->query("SELECT * FROM scholarship");
                    $sql->execute();
                    $data = $sql->fetchAll();

                    if (!$data) {
                        echo "<tr><td colspan='2' class='text-center'>No Data found</td></tr>";
                    } else {
                        foreach ($data as $scholarship) {

                    ?>
                            <tr>
                                <th scope="row"><?= $scholarship['scholarshipId']; ?></th>
                                <td><?= $scholarship['schType']; ?></td>
                                <td>
                                    <a href="editScholarship.php?scholarshipId=<?= $scholarship['scholarshipId']; ?>" class="btn btn-warning">Edit</a>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>


    <script>
        scr = "https://code.jquery.com/jquery-3.6.0.min.js"
    </script>
    <script>
        src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
    </script>
</body>

</html>