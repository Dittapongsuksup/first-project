<?php
//index.php
?>
<!DOCTYPE html>
<html>

<head>
  <title>Schedule</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script>
    $(document).ready(function() {
      var calendar = $('#calendar').fullCalendar({
        editable: false,
        header: {
          left: 'prev,next today',
          center: 'title',
          right: 'month,agendaWeek,agendaDay'
        },
        events: 'loadEvent.php',
        selectable: false,
        selectHelper: false,


        select: function(start, end, allDay) {
          var title = prompt("Enter Event Title");
          var location = prompt("Enter Event Location");
          if (title) {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            $.ajax({
              url: "insertEvent.php",
              type: "POST",
              data: {
                title: title,
                start: start,
                end: end,
                location: location
              },
              success: function() {
                calendar.fullCalendar('refetchEvents');
                alert("Added Successfully");
              }
            })
          }
        },
        editable: false,
        eventResize: function(event) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          var location = event.location;
          $.ajax({
            url: "updateEvent.php",
            type: "POST",
            data: {
              title: title,
              start: start,
              end: end,
              id: id,
              location: location
            },
            success: function() {
              calendar.fullCalendar('refetchEvents');
              alert('Event Update');
            }
          })
        },

        eventDrop: function(event) {
          var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
          var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
          var title = event.title;
          var id = event.id;
          var location = event.location;
          $.ajax({
            url: "updateEvent.php",
            type: "POST",
            data: {
              title: title,
              start: start,
              end: end,
              id: id,
              location: location
            },
            success: function() {
              calendar.fullCalendar('refetchEvents');
              alert("Event Updated");
            }
          });
        },

        eventClick: function(event) {
          var id = event.id;
          $.ajax({
            url: "load.php",
            type: "POST",
            data: {
              id: id,
              title: title,
              start: start,
              end: end,
              id: id,
              location: location
            },
            events: 'loadEvent.php',
          })

        },

      });
    });
  </script>
</head>

<body>
  <!-- Navbar -->
  <div class="container mt-2 mb-2">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <div class="container-fluid">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item fw-normal">
            <a class="nav-link" aria-current="page" href="user.php">Dashboard</a>
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
  </div>


  <div class="container mt-5 mb-5">
    <div class="container">
      <h2 align="center"><a href="#">ตารางการซ้อม / แข่ง นักกีฬาฟุตซอล</a></h2>
      <h2 align="center"><a href="#">มหาวิทยาลัยธนบุรี</a></h2>
      <br>
    </div>
    <hr>
    <div class="container">
      <div id="calendar"></div>
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