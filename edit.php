<?php
require 'config.php';

$table = $_GET['table'] ?? null;
$id = $_GET['id'] ?? null;

if (!$table || !$id) {
    die("Invalid request.");
}

// Define table-specific configurations
$tableConfigs = [
    'holiday' => [
        'fields' => ['date', 'description'],
        'labels' => ['Date', 'Description'],
    ],
    'exams' => [
        'fields' => ['exam_name', 'faculty', 'exam_date', 'start_time'],
        'labels' => ['Exam Name', 'Faculty', 'Exam Date', 'Start Time'],
    ],
    'extra_curricular' => [
        'fields' => ['activity_name', 'faculty_department', 'activity_date', 'start_time'],
        'labels' => ['Activity Name', 'Faculty Department', 'Activity Date', 'Start Time'],
    ],
    'special_events' => [
        'fields' => ['event_name', 'organizing_department', 'event_date', 'start_time'],
        'labels' => ['Event Name', 'Organizing Department', 'Event Date', 'Start Time'],
    ],
];

if (!isset($tableConfigs[$table])) {
    die("Unknown table.");
}

$fields = $tableConfigs[$table]['fields'];
$labels = $tableConfigs[$table]['labels'];

// Handle form submission for update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $sql = "UPDATE $table SET ";
    $params = [];

    foreach ($fields as $field) {
        $sql .= "$field = :$field, ";
        $params[$field] = $_POST[$field] ?? null;
    }
    $sql = rtrim($sql, ', ') . " WHERE id = :id";
    $params['id'] = $_POST['id'];

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    header("Location: dashboard.php");
    exit();
}

// Fetch record details for editing
$sql = "SELECT * FROM $table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$record = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$record) {
    die("Record not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <?php include './_partials/navbar.php'; ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Bootstrap Card -->
                <div class="card">
                    <div class="card-header">
                        Edit Record
                    </div>
                    <div class="card-body">
                        <!-- Update Form -->
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($record['id']) ?>">

                            <?php foreach ($fields as $index => $field): ?>
                                <div class="mb-3">
                                    <label for="<?= $field ?>" class="form-label"><?= $labels[$index] ?>:</label>
                                    <input
                                        type="<?= strpos($field, '_date') !== false ? 'date' : (strpos($field, '_time') !== false ? 'time' : 'text') ?>"
                                        id="<?= $field ?>" name="<?= $field ?>"
                                        value="<?= htmlspecialchars($record[$field]) ?>" class="form-control" required>
                                </div>
                            <?php endforeach; ?>

                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                            <a href="dashboard.php" class="btn btn-secondary">Back to List</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include './_partials/footer.php'; ?>
    <!-- Include Bootstrap JS -->
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>