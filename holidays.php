<?php
require 'config.php';

try {
  $currentDate = date('Y-m-d');

  // Fetch current holiday
  $stmt = $pdo->prepare("SELECT * FROM holiday WHERE date = :currentDate");
  $stmt->execute(['currentDate' => $currentDate]);
  $currentHoliday = $stmt->fetch(PDO::FETCH_ASSOC);

  // Fetch upcoming holidays
  $stmt = $pdo->prepare("SELECT * FROM holiday WHERE date > :currentDate ORDER BY date ASC LIMIT 6");
  $stmt->execute(['currentDate' => $currentDate]);
  $upcomingHolidays = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Database error: " . $e->getMessage();
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Holiday Overview</title>
  <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body class="bg-light">
  <?php include './_partials/navbar.php'; ?>
  <div class="container mt-5">
    <h1 class="text-center py-3 mb-4 border-bottom display-3">Holiday Overview</h1>


    <!-- Current Holiday Card -->
    <div class="card mb-4 shadow <?php echo $currentHoliday ? 'border-success' : 'border-danger'; ?>">
      <div
        class="card-header text-center <?php echo $currentHoliday ? 'bg-success text-white' : 'bg-danger text-white'; ?>">
        <h4 class="card-title mb-0">Current Holiday</h4>
      </div>
      <div class="card-body <?php echo $currentHoliday ? 'bg-light text-dark' : 'bg-danger-subtle text-white'; ?>">
        <?php if ($currentHoliday): ?>
          <div class="mb-4">
            <h5 class="card-title">Date</h5>
            <p class="card-text"><?php echo htmlspecialchars($currentHoliday['date']); ?></p>
          </div>
          <div class="mb-4">
            <h5 class="card-title">Description</h5>
            <p class="card-text"><?php echo htmlspecialchars($currentHoliday['description']); ?></p>
          </div>
        <?php else: ?>
          <p class="text-center">No holiday today.</p>
        <?php endif; ?>
      </div>
    </div>

    <div class="d-flex">
      <!-- Upcoming Holidays Cards -->
      <?php if ($upcomingHolidays): ?>
        <?php foreach ($upcomingHolidays as $holiday): ?>
          <div class="card mb-4 shadow border-warning">
            <div class="card-header text-center bg-warning text-dark">
              <h4 class="card-title mb-0">Upcoming Holiday</h4>
            </div>
            <div class="card-body bg-light text-dark">
              <div class="mb-4">
                <h5 class="card-title">Date</h5>
                <p class="card-text"><?php echo htmlspecialchars($holiday['date']); ?></p>
              </div>
              <div class="mb-4">
                <h5 class="card-title">Description</h5>
                <p class="card-text"><?php echo htmlspecialchars($holiday['description']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="card mb-4 shadow border-secondary">
          <div class="card-body text-center bg-secondary text-white">
            <p>No upcoming holidays.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
    <!-- Go Home Button -->
    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-primary btn-lg px-5 py-3"
        style="background: linear-gradient(45deg, #007bff, #0056b3); border-radius: 50px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); transition: transform 0.2s;">
        Go Home
      </a>
    </div>

    <!-- Additional CSS for hover effect -->
    <style>
      .btn-primary:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #0056b3, #003f7f);
      }
    </style>
  </div>

  <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <?php include './_partials/footer.php'; ?>
</body>

</html>