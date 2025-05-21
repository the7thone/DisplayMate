<?php
session_start();
require 'config.php';
require 'functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['schedule_day'])) {
        handle_schedule_form($pdo);
    } elseif (isset($_POST['holiday_action'])) {
        handle_holiday_crud($pdo);
    } elseif (isset($_POST['exam_action'])) {
        handle_exam_crud($pdo);
    } elseif (isset($_POST['activity_action'])) {
        handle_activity_crud($pdo);
    } elseif (isset($_POST['event_action'])) {
        handle_event_crud($pdo);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$schedule = get_schedule();
$current_day = date('l');
$holidays = fetchRecords($pdo, 'holiday');
$exams = fetchRecords($pdo, 'exams');
$activities = fetchRecords($pdo, 'extra_curricular');
$events = fetchRecords($pdo, 'special_events');

$day_schedule = $schedule[$current_day];

// Initialize variables for edit forms
$editHoliday = null;
$editExam = null;
$editActivity = null;
$editEvent = null;

if (isset($_GET['table']) && $_GET['table'] === 'holiday' && isset($_GET['id'])) {
    $editHoliday = fetch_holiday_by_id($pdo, $_GET['id']);
}
if (isset($_GET['table']) && $_GET['table'] === 'exams' && isset($_GET['id'])) {
    $editExam = fetch_exam_by_id($pdo, $_GET['id']);
}
if (isset($_GET['table']) && $_GET['table'] === 'extra_curricular' && isset($_GET['id'])) {
    $editActivity = fetch_activity_by_id($pdo, $_GET['id']);
}
if (isset($_GET['table']) && $_GET['table'] === 'special_events' && isset($_GET['id'])) {
    $editEvent = fetch_event_by_id($pdo, $_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Schedule Dashboard</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">

</head>

<body class="bg-light">
    <?php include './_partials/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="mb-4">School Schedule Dashboard</h1>

        <!-- Schedule Form Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><?= htmlspecialchars($current_day) ?></h2>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <input type="hidden" name="schedule_day" value="<?= htmlspecialchars($current_day) ?>">

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_holiday" name="is_holiday"
                                <?= $day_schedule['is_holiday'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="is_holiday">Is Holiday</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="has_exams" name="has_exams"
                                <?= $day_schedule['has_exams'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="has_exams">Has Exams</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="has_extra_curricular"
                                name="has_extra_curricular" <?= $day_schedule['has_extra_curricular'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="has_extra_curricular">Has Extra-Curricular
                                Activities</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="special_events" name="special_events"
                                <?= $day_schedule['special_events'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="special_events">Special Events</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>


        <!-- Holiday CRUD Forms Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><?= $editHoliday ? 'Edit Holiday' : 'Add Holiday' ?></h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="holiday_action" value="<?= $editHoliday ? 'update' : 'create' ?>">
                    <?php if ($editHoliday): ?>
                        <input type="hidden" name="holiday_id" value="<?= htmlspecialchars($editHoliday['id']) ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="holiday_name" class="form-label">Holiday Name:</label>
                        <input type="text" id="holiday_name" name="holiday_name" class="form-control"
                            value="<?= $editHoliday ? htmlspecialchars($editHoliday['holiday_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="holiday_date" class="form-label">Date:</label>
                        <input type="date" id="holiday_date" name="holiday_date" class="form-control"
                            value="<?= $editHoliday ? htmlspecialchars($editHoliday['date']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="holiday_description" class="form-label">Description:</label>
                        <input type="text" id="holiday_description" name="holiday_description" class="form-control"
                            value="<?= $editHoliday ? htmlspecialchars($editHoliday['description']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-<?= $editHoliday ? 'warning' : 'success' ?> w-100">
                        <?= $editHoliday ? 'Update Holiday' : 'Add Holiday' ?>
                    </button>
                </form>
            </div>
        </div>


        <!-- Holidays List Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Holidays List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover rounded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($holidays as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['date']) ?></td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td>
                                    <a href="edit.php?table=holiday&id=<?= htmlspecialchars($row['id']) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="holiday_id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <input type="hidden" name="holiday_action" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this holiday?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Exam CRUD Forms Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><?= $editExam ? 'Edit Exam' : 'Add Exam' ?></h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="exam_action" value="<?= $editExam ? 'update' : 'create' ?>">
                    <?php if ($editExam): ?>
                        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($editExam['id']) ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="exam_name" class="form-label">Exam Name:</label>
                        <input type="text" id="exam_name" name="exam_name" class="form-control"
                            value="<?= $editExam ? htmlspecialchars($editExam['exam_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label">Faculty:</label>
                        <input type="text" id="faculty" name="faculty" class="form-control"
                            value="<?= $editExam ? htmlspecialchars($editExam['faculty']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="exam_date" class="form-label">Exam Date:</label>
                        <input type="date" id="exam_date" name="exam_date" class="form-control"
                            value="<?= $editExam ? htmlspecialchars($editExam['exam_date']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" class="form-control"
                            value="<?= $editExam ? htmlspecialchars($editExam['start_time']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-<?= $editExam ? 'warning' : 'success' ?> w-100">
                        <?= $editExam ? 'Update Exam' : 'Add Exam' ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Exams List Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Exams List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover rounded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Exam Name</th>
                            <th>Faculty</th>
                            <th>Exam Date</th>
                            <th>Start Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($exams as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['exam_name']) ?></td>
                                <td><?= htmlspecialchars($row['faculty']) ?></td>
                                <td><?= htmlspecialchars($row['exam_date']) ?></td>
                                <td><?= htmlspecialchars($row['start_time']) ?></td>
                                <td>
                                    <a href="edit.php?table=exams&id=<?= htmlspecialchars($row['id']) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="exam_id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <input type="hidden" name="exam_action" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this exam?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Extra-Curricular CRUD Forms Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><?= $editActivity ? 'Edit Activity' : 'Add Activity' ?></h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="activity_action" value="<?= $editActivity ? 'update' : 'create' ?>">
                    <?php if ($editActivity): ?>
                        <input type="hidden" name="activity_id" value="<?= htmlspecialchars($editActivity['id']) ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="activity_name" class="form-label">Activity Name:</label>
                        <input type="text" id="activity_name" name="activity_name" class="form-control"
                            value="<?= $editActivity ? htmlspecialchars($editActivity['activity_name']) : '' ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="faculty_department" class="form-label">Faculty Department:</label>
                        <input type="text" id="faculty_department" name="faculty_department" class="form-control"
                            value="<?= $editActivity ? htmlspecialchars($editActivity['faculty_department']) : '' ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="activity_date" class="form-label">Activity Date:</label>
                        <input type="date" id="activity_date" name="activity_date" class="form-control"
                            value="<?= $editActivity ? htmlspecialchars($editActivity['activity_date']) : '' ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" class="form-control"
                            value="<?= $editActivity ? htmlspecialchars($editActivity['start_time']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-<?= $editActivity ? 'warning' : 'success' ?> w-100">
                        <?= $editActivity ? 'Update Activity' : 'Add Activity' ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Extra-Curricular Activities List Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Extra-Curricular Activities List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover rounded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Activity Name</th>
                            <th>Faculty Department</th>
                            <th>Activity Date</th>
                            <th>Start Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activities as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['activity_name']) ?></td>
                                <td><?= htmlspecialchars($row['faculty_department']) ?></td>
                                <td><?= htmlspecialchars($row['activity_date']) ?></td>
                                <td><?= htmlspecialchars($row['start_time']) ?></td>
                                <td>
                                    <a href="edit.php?table=extra_curricular&id=<?= htmlspecialchars($row['id']) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="activity_id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <input type="hidden" name="activity_action" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this activity?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Special Events CRUD Forms Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><?= $editEvent ? 'Edit Event' : 'Add Event' ?></h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <input type="hidden" name="event_action" value="<?= $editEvent ? 'update' : 'create' ?>">
                    <?php if ($editEvent): ?>
                        <input type="hidden" name="event_id" value="<?= htmlspecialchars($editEvent['id']) ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="event_name" class="form-label">Event Name:</label>
                        <input type="text" id="event_name" name="event_name" class="form-control"
                            value="<?= $editEvent ? htmlspecialchars($editEvent['event_name']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizing_department" class="form-label">Organizing Department:</label>
                        <input type="text" id="organizing_department" name="organizing_department" class="form-control"
                            value="<?= $editEvent ? htmlspecialchars($editEvent['organizing_department']) : '' ?>"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="event_date" class="form-label">Event Date:</label>
                        <input type="date" id="event_date" name="event_date" class="form-control"
                            value="<?= $editEvent ? htmlspecialchars($editEvent['event_date']) : '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" class="form-control"
                            value="<?= $editEvent ? htmlspecialchars($editEvent['start_time']) : '' ?>" required>
                    </div>
                    <button type="submit" class="btn btn-<?= $editEvent ? 'warning' : 'success' ?> w-100">
                        <?= $editEvent ? 'Update Event' : 'Add Event' ?>
                    </button>
                </form>
            </div>
        </div>

        <!-- Special Events List Card -->
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Special Events List</h2>
            </div>
            <div class="card-body">
                <table class="table table-striped table-hover rounded">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Event Name</th>
                            <th>Organizing Department</th>
                            <th>Event Date</th>
                            <th>Start Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['event_name']) ?></td>
                                <td><?= htmlspecialchars($row['organizing_department']) ?></td>
                                <td><?= htmlspecialchars($row['event_date']) ?></td>
                                <td><?= htmlspecialchars($row['start_time']) ?></td>
                                <td>
                                    <a href="edit.php?table=special_events&id=<?= htmlspecialchars($row['id']) ?>"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="event_id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <input type="hidden" name="event_action" value="delete">
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this event?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Additional Functions Card -->
        <div class="card text-center my-4 shadow">
            <div class="card-header bg-primary text-white">
                Additional Functions
            </div>
            <div class="card-body d-flex justify-content-center align-items-center gap-3">
                <a href="update.php" class="btn btn-secondary btn-lg">Update Class Data</a>
                <a href="logout.php" class="btn btn-danger btn-lg">Logout</a>
            </div>
        </div>


    </div>
    <?php include './_partials/footer.php'; ?>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>