<?php
date_default_timezone_set('Asia/Kolkata');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title>About Us - DisplayMate</title>
</head>

<body class="bg-light">

  <?php include './_partials/navbar.php'; ?>

  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center mb-4">About DisplayMate</h2>

        <div class="card border-0 shadow-lg">
          <div class="card-header bg-info text-white">
            <h3 class="card-title mb-0">Information</h3>
          </div>
          <div class="card-body">
            <p class="lead">DisplayMate is a web-based application designed to streamline the management and display of
              class schedules, ensuring that students and faculty are always up-to-date with the latest information.</p>
          </div>
        </div>

        <div class="card border-0 shadow-lg mt-4">
          <div class="card-header bg-success text-white">
            <h3 class="card-title mb-0">Our Mission</h3>
          </div>
          <div class="card-body">
            <p>Our mission is to provide an intuitive platform that helps educational institutions manage their
              schedules efficiently. We aim to reduce the chaos associated with schedule changes and provide a seamless
              experience for all users.</p>
          </div>
        </div>

        <div class="card border-0 shadow-lg mt-4">
          <div class="card-header bg-warning text-dark">
            <h3 class="card-title mb-0">Features</h3>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Dynamic Class Schedule:</strong> Real-time updates to ensure everyone
                is informed about the current and upcoming classes.</li>
              <li class="list-group-item"><strong>Holiday Notifications:</strong> Automatic recognition of holidays,
                ensuring no one is caught off guard.</li>
              <li class="list-group-item"><strong>Teacher and Classroom Management:</strong> Easily manage and assign
                teachers to classrooms.</li>
            </ul>
          </div>
        </div>

        <div class="card border-0 shadow-lg mt-4">
          <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">Team</h3>
          </div>
          <div class="card-body">
            <p>DisplayMate was developed by a passionate team of educators and developers who understand the challenges
              faced by institutions when managing class schedules.</p>
          </div>
        </div>

        <div class="card border-0 shadow-lg mt-4">
          <div class="card-header bg-danger text-white">
            <h3 class="card-title mb-0">Contact Us</h3>
          </div>
          <div class="card-body">
            <p>If you have any questions, feedback, or suggestions, feel free to reach out to us:</p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Email: <a href="mailto:support@displaymate.com">support@displaymate.com</a>
              </li>
              <li class="list-group-item">Phone: +91-1234567890</li>
              <li class="list-group-item">Address: 1234 Education Street, Knowledge City, India</li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </div>
  <?php include './_partials/footer.php'; ?>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>