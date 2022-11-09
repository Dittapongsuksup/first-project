<?php
require_once('config/connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Awards</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <!-- bootstrap link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
  <!-- swiper css link -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
  * {
    padding: 0;
    margin: 0;
    font-family: sans-serif;
    box-sizing: border-box;
  }

  body {
    display: grid;
    place-items: center;
    height: 100vh;
    width: 100%;
    background: #ebf2fa;
    ;
  }

  /*#container {
    height: 500px;
    width: 1200px;
    display: flex;
    flex-direction: row;
    overflow: hidden;
  }*/

  .sliders {
    /*height: 500px;*/
    width: 1200px;
    display: flex;
    flex-direction: row;
  }

  .cards {
    height: 450px;
    width: 350px;
    margin: 25px 25px;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: inset 3px 3px 3px rgba(187, 143, 206, 0.8), inset -3px -3px 4px rgba(108, 52, 131, 0.2);
    display: flex;
    justify-content: center;
  }

  .profile {
    height: 150px;
    width: 150px;
    border-radius: 50%;
    /*box-shadow: 3px 3px 3px rgba(255,255,255,0.8),-3px -3px 4px rgba(0,0,0,0.2);*/
    position: absolute;
    top: 30;
    left: calc(50% - 75px);
    display: grid;
    place-items: center;
  }

  .images {
    height: 130px;
    width: 130px;
    border-radius: 50%;
    border: 6px solid #198754;
    overflow: hidden;
  }

  .images img {
    width: 100%;
  }

  h2 {
    position: absolute;
    top: 200px;
  }

  p {
    position: absolute;
    top: 240px;
  }

  .messages {
    position: absolute;
    bottom: 70px;
    display: flex;
    flex-direction: row;
  }

  .btns {
    height: 60px;
    width: 140px;
    display: grid;
    place-items: center;
    box-shadow: inset 3px 3px 1px rgba(255, 255, 255, 1), inset -3px -3px 2px rgba(0, 0, 0, 0.2);
    border-radius: 30px;
    margin: 0 10px;
  }

  .btns button {
    font-size: 17px;
    height: 50px;
    width: 130px;
    border: none;
    outline: none;
    background: #198754;
    border-radius: 30px;
    color: #fff;
    cursor: pointer;
  }

  .owl-nav {
    display: none;
  }

  .owl-dot {
    display: none;
  }

  .owl-stage {
    display: flex;
    flex-direction: row;
  }
</style>
<style>
  body {
    font-family: tahoma;
    /*height: 100vh;
    background-image: url(https://picsum.photos/g/3000/2000);
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;*/
  }

  .our-team {
    padding: 30px 0 40px;
    margin-bottom: 30px;
    background-color: #ebf2fa;
    box-shadow: inset 3px 3px 3px rgba(255, 255, 255, 0.8), inset -3px -3px 4px rgba(0, 128, 0, 0.2);
    text-align: center;
    overflow: hidden;
    position: relative;
  }

  .our-team .picture {
    display: inline-block;
    height: 130px;
    width: 130px;
    margin-bottom: 50px;
    z-index: 1;
    position: relative;
  }

  .our-team .picture::before {
    content: "";
    width: 100%;
    height: 0;
    border-radius: 50%;
    background-color: #1369ce;
    position: none;
    bottom: 135%;
    right: 0;
    left: 0;
    opacity: 0.9;
    transform: scale(3);
    transition: all 0.3s linear 0s;
  }

  .our-team:hover .picture::before {
    height: 100%;
  }

  .our-team .picture::after {
    content: "";
    width: 100%;
    height: 100%;
    border-radius: 50%;
    background-color: #1369ce;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
  }

  .our-team .picture img {
    width: 100%;
    height: auto;
    border-radius: 50%;
    transform: scale(1);
    transition: all 0.9s ease 0s;
  }

  .our-team:hover .picture img {
    box-shadow: 0 0 0 10px #ebf2fa;
    transform: scale(0.7);
  }

  .our-team .title {
    display: block;
    font-size: 15px;
    color: #4e5052;
    text-transform: capitalize;
  }

  .our-team .social {
    width: 100%;
    padding: 0;
    margin: 0;
    background-color: #1369ce;
    position: absolute;
    bottom: -100px;
    left: 0;
    transition: all 0.5s ease 0s;
  }

  .our-team:hover .social {
    bottom: 0;
  }

  .our-team .social li {
    display: inline-block;
  }

  .our-team .social li a {
    display: block;
    padding: 10px;
    font-size: 17px;
    color: white;
    transition: all 0.3s ease 0s;
    text-decoration: none;
  }

  .our-team .social li a:hover {
    color: #1369ce;
    background-color: #ebf2fa;
  }
</style>

<body>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <div class="container-fluid">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link active" aria-current="page" href="#">Awards</a>
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
    <hr>
  </div>

  <div class="container-xl">
    <br>
    <h1 align="center">Hall Of Fame</h1>
    <br>
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="our-team">
            <div class="picture">
              <img class="img-fluid" src="assets/img/team/T01.png">
            </div>
            <div class="team-content">
              <h3 class="name">เจนณรงค์ มากกำเนิด</h3>
              <h4 class="title">Head Coach</h4>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="our-team">
            <div class="picture">
              <img class="img-fluid" src="assets/img/team/T02.png">
            </div>
            <div class="team-content">
              <h3 class="name">สุภกิจ แช่มโชติ</h3>
              <h4 class="title">Coach</h4>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="our-team">
            <div class="picture">
              <img class="img-fluid" src="assets/img/team/T03.png">
            </div>
            <div class="team-content">
              <h3 class="name">กริช ไชยโย</h3>
              <h4 class="title">Coach</h4>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="our-team">
            <div class="picture">
              <img class="img-fluid" src="https://picsum.photos/130/130?image=836">
            </div>
            <div class="team-content">
              <h3 class="name">Mary Huntley</h3>
              <h4 class="title">Staff</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Slide card automatic -->
    <div id="container">
      <div class="sliders">

        <!-- card no 1 -->
        <div class="cards">
          <?php
          $stmt = $conn->query("SELECT * FROM all_awards ORDER BY awardId DESC");
          $stmt->execute();
          $data = $stmt->fetch();
          ?>
          
          <!-- cards Buttons -->
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>

        <!-- duplicate card according to your need -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image2.jpg" alt="">
            </div>
          </div>
          <h2>ALEXA</h2>
          <p>GAMES DEVELOPER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 3 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image3.jpg" alt="">
            </div>
          </div>
          <h2>RACHEl</h2>
          <p>UX DESIGNER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 4 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image4.jpg" alt="">
            </div>
          </div>
          <h2>HALE</h2>
          <p>WEB DEVELOPER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 5 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image5.jpg" alt="">
            </div>
          </div>
          <h2>CRISS</h2>
          <p>UI DESIGNER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 6 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image6.jpg" alt="">
            </div>
          </div>
          <h2>AHSAN</h2>
          <p>GAMES DEVELOPER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 7 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image7.jpg" alt="">
            </div>
          </div>
          <h2>HANIA</h2>
          <p>FASHION DESIGNER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
        <!-- card no 8 -->
        <div class="cards">
          <div class="profile">
            <div class="images">
              <img src="assets/image8.jpg" alt="">
            </div>
          </div>
          <h2>ROOH</h2>
          <p>APP DEVELOPER</p>
          <div class="messages">
            <div class="btns">
              <button>Profile</button>
            </div>
            <div class="btns">
              <button>Messages</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery CDN -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <!-- owl carousel cdn -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

  <script>
    $(document).ready(function() {
      $(".sliders").owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true
      });
    })
  </script>
</body>

</html>