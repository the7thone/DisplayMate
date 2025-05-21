<?php
require 'functions.php';
require 'config.php';


$schedule = get_schedule();
$currentDay = date('l');
$currentDate = date('Y-m-d');

// Check if the current day is in the schedule data
if (array_key_exists($currentDay, $schedule)) {
    $today = $schedule[$currentDay];
} else {
    $today = array(); // Handle cases where the current day is not in the data
}

// Fetch all records from a table
$exams = fetchRecords($pdo, 'exams');
$extra_curricular = fetchRecords($pdo, 'extra_curricular');
$special_events = fetchRecords($pdo, 'special_events');
$holidays = fetchRecords($pdo, 'holiday', "SELECT * FROM holiday WHERE date = '$currentDate'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Update</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <?php include './_partials/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center py-3 mb-4 border-bottom display-3">Daily Update - <?php echo htmlspecialchars($currentDay); ?></h1>

        <?php if (isset($today['is_holiday']) && $today['is_holiday']): ?>
            <div class="card mb-4 shadow">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Holiday</h5>
                </div>
                <div class="card-body">
                    <h5 class="card-subtitle mb-2"><?= htmlspecialchars($holidays[0]['name']); ?></h5>
                    <p class="card-text"><?= htmlspecialchars($holidays[0]['description']); ?></p>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="container mt-4">
        <?php if (!empty($exams)): ?>
            <div class="card mb-4 shadow">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">Upcoming Exam Schedule</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Faculty</th>
                                <th>Date</th>
                                <th>Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($exams as $exam): ?>
                                <tr>
                                    <td><?= htmlspecialchars($exam['exam_name']); ?></td>
                                    <td><?= htmlspecialchars($exam['faculty']); ?></td>
                                    <td><?= htmlspecialchars($exam['exam_date']); ?></td>
                                    <td><?= htmlspecialchars($exam['start_time']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($extra_curricular)): ?>
            <div class="card mb-4 shadow">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Upcoming Extra-Curricular Activities</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Activity Name</th>
                                <th>Faculty/Department</th>
                                <th>Date</th>
                                <th>Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($extra_curricular as $activity): ?>
                                <tr>
                                    <td><?= htmlspecialchars($activity['activity_name']); ?></td>
                                    <td><?= htmlspecialchars($activity['faculty_department']); ?></td>
                                    <td><?= htmlspecialchars($activity['activity_date']); ?></td>
                                    <td><?= htmlspecialchars($activity['start_time']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($special_events)): ?>
            <div class="card mb-4 shadow">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">Upcoming Special Events</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Organizing Department</th>
                                <th>Date</th>
                                <th>Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($special_events as $event): ?>
                                <tr>
                                    <td><?= htmlspecialchars($event['event_name']); ?></td>
                                    <td><?= htmlspecialchars($event['organizing_department']); ?></td>
                                    <td><?= htmlspecialchars($event['event_date']); ?></td>
                                    <td><?= htmlspecialchars($event['start_time']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php include './_partials/footer.php'; ?>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>