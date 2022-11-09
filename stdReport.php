<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=, initial-scale=1.0">
  <title>Send Report</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  
</head>

<body>
  <div class="container mt-4 mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <div class="container-fluid">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" aria-current="page" href="user.php">Dashboard</a>
          </li>
        </ul>
        <ul class="navbar-nav mb-2 mb-lg-0">
        </ul>
      </div>
    </nav>
    <br>
  </div>

  <!--from add data-->
  <div class="container">
    <div class="text-center">
      <h2 class="title-section mb-3">รายงานปัญหา</h2>
      <p>คุณสามารถส่งอีเมลล์รายงานปัญหาได้ที่ <a href="mailto:thonburi_futsal@gmail.com">thonburi_futsal@gmail.com</a></p>
    </div>
    <br>
    <div class="text-center" style="max-width: 600px;">
      <form action="" method="POST" class="from-contact">
        <div class="mb-3">
          <label for="studentId" class="form-label">Student ID</label>
          <input type="text" class="from-control" required name="studentId" placeholder="Student ID..">
        </div>
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="from-control" required name="name" placeholder="Enter Name..">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="from-control" required name="email" placeholder="Email address..">
        </div>
        <div class="mb-3">
          <label for="subject" class="form-label">Subject</label>
          <input type="text" class="from-control" required name="subject" placeholder="Subject..">
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea name="message" rows="8" class="from-control" required placeholder="Enter Message.."></textarea>
        </div>
        <div class="mt-3">
          <button class="btn btn-primary" type="submit">Submit</button>
        </div>
      </form>

    </div>

  </div>
  <script>
    scr = "https://code.jquery.com/jquery-3.6.0.min.js"
  </script>
  <script>
    src = "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>