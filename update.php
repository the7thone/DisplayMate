<?php
session_start();
require 'config.php'; // Ensure this file initializes $pdo correctly

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Define the allowed tables (weekdays)
$allowedTables = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

// Initialize variables
$table = '';
$data = [];

// Fetch data from the selected table
if (isset($_GET['table']) && in_array($_GET['table'], $allowedTables)) {
    $table = $_GET['table'];

    // Handle update
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $id = $_POST['id'];
        $teacherName = $_POST['teacher_name'];
        $subject = $_POST['subject'];
        $classRoom = $_POST['class_room'];
        $startTime = $_POST['start_time'];
        $endTime = $_POST['end_time'];
        $className = $_POST['class_name'];

        // Prepare the update query
        $stmt = $pdo->prepare("
            UPDATE $table 
            SET teacher_name = :teacher_name, 
                subject = :subject, 
                class_room = :class_room, 
                start_time = :start_time, 
                end_time = :end_time, 
                class_name = :class_name 
            WHERE id = :id
        ");

        // Execute the query with the provided values
        $stmt->execute([
            'teacher_name' => $teacherName,
            'subject' => $subject,
            'class_room' => $classRoom,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'class_name' => $className,
            'id' => $id
        ]);
    }

    // Handle delete
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
        $id = $_POST['id'];

        // Prepare the delete query
        $stmt = $pdo->prepare("DELETE FROM $table WHERE id = :id");

        // Execute the query with the provided id
        $stmt->execute(['id' => $id]);
    }

    // Handle add
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
        $teacherName = $_POST['new_teacher_name'];
        $subject = $_POST['new_subject'];
        $classRoom = $_POST['new_class_room'];
        $startTime = $_POST['new_start_time'];
        $endTime = $_POST['new_end_time'];
        $className = $_POST['new_class_name'];

        // Prepare the insert query
        $stmt = $pdo->prepare("
            INSERT INTO $table (teacher_name, subject, class_room, start_time, end_time, class_name) 
            VALUES (:teacher_name, :subject, :class_room, :start_time, :end_time, :class_name)
        ");

        // Execute the query with the provided values
        $stmt->execute([
            'teacher_name' => $teacherName,
            'subject' => $subject,
            'class_room' => $classRoom,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'class_name' => $className
        ]);
    }

    // Fetch table data
    $stmt = $pdo->query("SELECT * FROM $table");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <title>Update</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <script>
        function confirmAction(action) {
            if (action === 'delete') {
                return confirm('Are you sure you want to delete this record?');
            } else if (action === 'update') {
                return confirm('Are you sure you want to update this record?');
            } else if (action === 'add') {
                return confirm('Are you sure you want to add this new record?');
            }
            return false;
        }
    </script>
</head>

<body class="bg-light">
    <?php include './_partials/navbar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">CRUD Application</h1>

        <!-- Form to select the table -->
        <form method="GET" action="" class="mb-4">
            <div class="form-group">
                <label for="table">Choose a table:</label>
                <select name="table" id="table" class="form-control" onchange="this.form.submit()">
                    <option value="">Select</option>
                    <?php foreach ($allowedTables as $tableName): ?>
                        <option value="<?php echo htmlspecialchars($tableName); ?>" <?php if ($table === $tableName)
                               echo 'selected'; ?>>
                            <?php echo htmlspecialchars(ucfirst($tableName)); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if (!empty($data)): ?>
            <!-- Display table data -->
            <h2 class="mb-4">Data from <?php echo htmlspecialchars(ucfirst($table)); ?></h2>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-dark text-white">
                    <?php echo htmlspecialchars(ucfirst($table)); ?> Schedule
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Teacher Name</th>
                                    <th>Subject</th>
                                    <th>Class Room</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Class Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <form method="POST" action="" onsubmit="return confirmAction('update')">
                                            <td>
                                                <?php echo htmlspecialchars($row['id']); ?>
                                                <input type="hidden" name="id"
                                                    value="<?php echo htmlspecialchars($row['id']); ?>">
                                            </td>
                                            <td><input type="text" name="teacher_name" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['teacher_name']); ?>"></td>
                                            <td><input type="text" name="subject" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['subject']); ?>"></td>
                                            <td><input type="text" name="class_room" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['class_room']); ?>"></td>
                                            <td><input type="text" name="start_time" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['start_time']); ?>"></td>
                                            <td><input type="text" name="end_time" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['end_time']); ?>"></td>
                                            <td><input type="text" name="class_name" class="form-control"
                                                    value="<?php echo htmlspecialchars($row['class_name']); ?>"></td>
                                            <td>
                                                <div class="d-flex justify-content-between gap-2">
                                                    <button type="submit" name="update"
                                                        class="btn btn-primary btn-sm">Update</button>
                                                    <button type="submit" name="delete" class="btn btn-danger btn-sm"
                                                        onclick="return confirmAction('delete')">Delete</button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($table)): ?>
            <!-- Form to add new record -->
            <h2 class="mb-4">Add New Record to <?php echo htmlspecialchars(ucfirst($table)); ?></h2>
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <form method="POST" action="" onsubmit="return confirmAction('add')">
                        <div class="row">
                            <!-- First Column -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group mb-3">
                                    <label for="new_teacher_name">Teacher Name:</label>
                                    <input type="text" name="new_teacher_name" id="new_teacher_name" class="form-control"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_subject">Subject:</label>
                                    <input type="text" name="new_subject" id="new_subject" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_class_room">Class Room:</label>
                                    <input type="text" name="new_class_room" id="new_class_room" class="form-control"
                                        required>
                                </div>
                            </div>

                            <!-- Second Column -->
                            <div class="col-md-6 mb-3">
                                <div class="form-group mb-3">
                                    <label for="new_start_time">Start Time:</label>
                                    <input type="text" name="new_start_time" id="new_start_time" class="form-control"
                                        required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_end_time">End Time:</label>
                                    <input type="text" name="new_end_time" id="new_end_time" class="form-control" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="new_class_name">Class Name:</label>
                                    <input type="text" name="new_class_name" id="new_class_name" class="form-control"
                                        required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="add" class="btn btn-success btn-block">Add Record</button>
                    </form>
                </div>
            </div>

        <?php endif; ?>

        <a href="dashboard.php" class="btn btn-secondary mt-4">Back to Dashboard</a>
    </div>
    <?php include './_partials/footer.php'; ?>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>