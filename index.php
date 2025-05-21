<?php
date_default_timezone_set('Asia/Kolkata');

// Include necessary files
require 'config.php';
require 'functions.php';

// Fetch the schedule data
$schedule = get_schedule();

// Determine today's date
$today = date('l');

// Check if today is a holiday
$is_holiday = $schedule[$today]['is_holiday'];

// Set the current time
$current_time = '09:15:00';
// $current_time = date('H:i:s');

// Fetch current and upcoming classes if today is not a holiday
if (!$is_holiday) {
  $today_table = getTableForToday();
  $current_classes = getClasses($pdo, $today_table, $current_time);
  $next_upcoming_class = getNextUpcomingClass($pdo, $today_table, $current_time);
  $upcoming_classes = getUpcomingClasses($pdo, $today_table, $current_time);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="10">
  <title>DisplayMate</title>
  <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-light">

  <?php include './_partials/navbar.php'; ?>

  <div class="container mt-5">
    <?php if ($is_holiday): ?>
      <div class="container d-flex justify-content-center align-items-center" style="min-height: 650px; min-width: auto;">
        <div class="card mb-4 shadow-lg rounded border-0">
          <div class="card-body text-center">
            <div class="d-flex justify-content-center mb-4">
              <i class="bi bi-calendar-check-fill text-primary" style="font-size: 4rem;"></i>
            </div>
            <h2 class="card-title mb-3 text-uppercase font-weight-bold">🎉 It's a Holiday Today!</h2>
            <p class="card-text mb-4 lead">You're free from classes and other activities. Enjoy your day off and make the
              most of it!</p>
            <a href="#" class="btn btn-primary btn-lg">Check Next Week's Schedule</a>
          </div>
        </div>
      </div>
    <?php else: ?>

      <h2 class="text-center py-3 mb-4 border-bottom display-3">Class Schedule for Today</h2>
      <?php if (!empty($current_classes)): ?>
        <div class="card mb-4 shadow">
          <div class="card-header bg-success text-white">
            <h3 class="mb-0">Current Classes</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                    <th>Class Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Class Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php renderTableRows($current_classes); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!empty($next_upcoming_class)): ?>
        <div class="card mb-4 shadow">
          <div class="card-header bg-info text-white">
            <h3 class="mb-0">Next Upcoming Class</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                    <th>Class Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Class Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo htmlspecialchars($next_upcoming_class['teacher_name']); ?></td>
                    <td><?php echo htmlspecialchars($next_upcoming_class['subject']); ?></td>
                    <td><?php echo htmlspecialchars($next_upcoming_class['class_room']); ?></td>
                    <td><?php echo htmlspecialchars($next_upcoming_class['start_time']); ?></td>
                    <td><?php echo htmlspecialchars($next_upcoming_class['end_time']); ?></td>
                    <td><?php echo htmlspecialchars($next_upcoming_class['class_name']); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <?php if (!empty($upcoming_classes)): ?>
        <div class="card mb-4 shadow">
          <div class="card-header bg-warning text-dark">
            <h3 class="mb-0">Upcoming Classes</h3>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Teacher Name</th>
                    <th>Subject</th>
                    <th>Class Room</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Class Name</th>
                  </tr>
                </thead>
                <tbody>
                  <?php renderTableRows($upcoming_classes); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <?php else: ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 500px; min-width: auto;">
          <div class="card mb-4 shadow rounded">
            <div class="card-body text-center">
              <div class="d-flex justify-content-center mb-3">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
              </div>
              <h5 class="card-title mb-2">All Done for Today!</h5>
              <p class="card-text">You have successfully completed all your classes for today. Enjoy some well-deserved
                downtime!</p>
              <div class="mt-4">
                <a href="#" class="btn btn-primary">View Tomorrow's Schedule</a>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php require "./_partials/footer.php" ?>
  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>