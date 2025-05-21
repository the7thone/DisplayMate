<?php
date_default_timezone_set('Asia/Kolkata');

// Function to get the table name for today
function getTableForToday()
{
    $day = strtolower(date('l')); // Get the full name of the day (e.g., Monday)
    return $day; // Table name will be the lowercase day name (e.g., 'monday')
}

// Function to fetch classes based on time
function getClasses($pdo, $table, $current_time)
{
    $sql_current = "SELECT * FROM $table WHERE start_time <= ? AND end_time >= ? ORDER BY start_time";
    $stmt_current = $pdo->prepare($sql_current);
    $stmt_current->execute([$current_time, $current_time]);
    return $stmt_current->fetchAll(PDO::FETCH_ASSOC);
}

// Function to fetch upcoming classes
function getUpcomingClasses($pdo, $table, $current_time)
{
    $sql_upcoming = "SELECT * FROM $table WHERE start_time > ? ORDER BY start_time";
    $stmt_upcoming = $pdo->prepare($sql_upcoming);
    $stmt_upcoming->execute([$current_time]);
    return $stmt_upcoming->fetchAll(PDO::FETCH_ASSOC);
}

// Function to fetch only the next upcoming class
function getNextUpcomingClass($pdo, $table, $current_time)
{
    $sql_upcoming = "SELECT * FROM $table WHERE start_time > ? ORDER BY start_time LIMIT 1";
    $stmt_upcoming = $pdo->prepare($sql_upcoming);
    $stmt_upcoming->execute([$current_time]);
    return $stmt_upcoming->fetch(PDO::FETCH_ASSOC); // Fetch a single record
}

// Function to render table rows
function renderTableRows($classes)
{
    if (empty($classes)) {
        echo '<tr><td colspan="7">No classes available.</td></tr>';
    } else {
        foreach ($classes as $class) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($class['teacher_name']) . '</td>';
            echo '<td>' . htmlspecialchars($class['subject']) . '</td>';
            echo '<td>' . htmlspecialchars($class['class_room']) . '</td>';
            echo '<td>' . htmlspecialchars($class['start_time']) . '</td>';
            echo '<td>' . htmlspecialchars($class['end_time']) . '</td>';
            echo '<td>' . htmlspecialchars($class['class_name']) . '</td>';
            // if (isset($class['id'])) {
            //     echo '<td><a href="update.php?id=' . $class['id'] . '">Edit</a></td>';
            // }
            echo '</tr>';
        }
    }
}

// Function to get schedule from json
function get_schedule()
{
    $filename = 'schedule.json';
    $json_data = file_get_contents($filename);
    if (file_exists($filename)) {
        return json_decode($json_data, true);
    }
    return [];
}

// Function to update schedule to json
function save_schedule($data)
{
    $filename = 'schedule.json';
    $json_data = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($filename, $json_data);
}


function fetch_holiday_by_id($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM holidays WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetch_exam_by_id($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM exams WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetch_activity_by_id($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM extra_curricular WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function fetch_event_by_id($pdo, $id)
{
    $stmt = $pdo->prepare('SELECT * FROM special_events WHERE id = :id');
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// Add a new holiday to the database
function add_holiday($pdo, $name, $date, $description)
{
    $sql = "INSERT INTO holiday (name, date, description) VALUES (:name, :date, :description)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name, 'date' => $date, 'description' => $description]);
}

// Delete a holiday from the database
function delete_holiday($pdo, $id)
{
    $sql = "DELETE FROM holiday WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

// Add a new exam to the database
function add_exam($pdo, $exam_name, $faculty, $exam_date, $start_time)
{
    $sql = "INSERT INTO exams (exam_name, faculty, exam_date, start_time) VALUES (:exam_name, :faculty, :exam_date, :start_time)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'exam_name' => $exam_name,
        'faculty' => $faculty,
        'exam_date' => $exam_date,
        'start_time' => $start_time
    ]);
}
// Delete an exam from the database
function delete_exam($pdo, $id)
{
    $sql = "DELETE FROM exams WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}
// Add a new extra-curricular activity to the database
function add_activity($pdo, $activity_name, $faculty_department, $activity_date, $start_time)
{
    $sql = "INSERT INTO extra_curricular (activity_name, faculty_department, activity_date, start_time) VALUES (:activity_name, :faculty_department, :activity_date, :start_time)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'activity_name' => $activity_name,
        'faculty_department' => $faculty_department,
        'activity_date' => $activity_date,
        'start_time' => $start_time
    ]);
}
// Delete an extra-curricular activity from the database
function delete_activity($pdo, $id)
{
    $sql = "DELETE FROM extra_curricular WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}
// Add a new special event to the database
function add_event($pdo, $event_name, $organizing_department, $event_date, $start_time)
{
    $sql = "INSERT INTO special_events (event_name, organizing_department, event_date, start_time) VALUES (:event_name, :organizing_department, :event_date, :start_time)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'event_name' => $event_name,
        'organizing_department' => $organizing_department,
        'event_date' => $event_date,
        'start_time' => $start_time
    ]);
}
// Delete a special event from the database
function delete_event($pdo, $id)
{
    $sql = "DELETE FROM special_events WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
}

function getExamData()
{
    $exam_name = isset($_POST['exam_name']) ? $_POST['exam_name'] : null;
    $faculty = isset($_POST['faculty']) ? $_POST['faculty'] : null;
    $exam_date = isset($_POST['exam_date']) ? $_POST['exam_date'] : null;
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
    return [$exam_name, $faculty, $exam_date, $start_time];
}

function getActivityData()
{
    $activity_name = isset($_POST['activity_name']) ? $_POST['activity_name'] : null;
    $faculty_department = isset($_POST['faculty_department']) ? $_POST['faculty_department'] : null;
    $activity_date = isset($_POST['activity_date']) ? $_POST['activity_date'] : null;
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
    return [$activity_name, $faculty_department, $activity_date, $start_time];
}

function getEventData()
{
    $event_name = isset($_POST['event_name']) ? $_POST['event_name'] : null;
    $organizing_department = isset($_POST['organizing_department']) ? $_POST['organizing_department'] : null;
    $event_date = isset($_POST['event_date']) ? $_POST['event_date'] : null;
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
    return [$event_name, $organizing_department, $event_date, $start_time];
}


// Function to get holiday form data
function getHolidayData()
{
    $name = isset($_POST['holiday_name']) ? $_POST['holiday_name'] : null;
    $date = isset($_POST['holiday_date']) ? $_POST['holiday_date'] : null;
    $description = isset($_POST['holiday_description']) ? $_POST['holiday_description'] : null;
    return [$name, $date, $description];
}

// Handle the schedule form submission
function handle_schedule_form($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['schedule_day'])) {
        $day = $_POST['schedule_day'];
        $schedule = get_schedule();
        $schedule[$day] = [
            'is_holiday' => isset($_POST['is_holiday']),
            'has_exams' => isset($_POST['has_exams']),
            'has_extra_curricular' => isset($_POST['has_extra_curricular']),
            'special_events' => isset($_POST['special_events'])
        ];
        save_schedule($schedule);
        return $day;
    }
    return date('l');
}

// Handle holiday CRUD operations
function handle_holiday_crud($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['holiday_action'])) {
        switch ($_POST['holiday_action']) {
            case 'create':
                list($name, $date, $description) = getHolidayData();
                if ($date !== null && $description !== null) {
                    add_holiday($pdo, $name, $date, $description);
                } else {
                    // Handle missing data case
                }
                break;
            case 'delete':
                $id = isset($_POST['holiday_id']) ? $_POST['holiday_id'] : null;
                if ($id !== null) {
                    delete_holiday($pdo, $id);
                } else {
                    // Handle missing ID case
                }
                break;
            default:
                // Handle unknown action case
                break;
        }
    }
}

function handle_exam_crud($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['exam_action'])) {
        switch ($_POST['exam_action']) {
            case 'create':
                list($exam_name, $faculty, $exam_date, $start_time) = getExamData();
                if ($exam_name !== null && $faculty !== null && $exam_date !== null && $start_time !== null) {
                    add_exam($pdo, $exam_name, $faculty, $exam_date, $start_time);
                } else {
                    // Handle missing data case
                }
                break;
            case 'delete':
                $id = isset($_POST['exam_id']) ? $_POST['exam_id'] : null;
                if ($id !== null) {
                    delete_exam($pdo, $id);
                } else {
                    // Handle missing ID case
                }
                break;
            default:
                // Handle unknown action case
                break;
        }
    }
}

function handle_activity_crud($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activity_action'])) {
        switch ($_POST['activity_action']) {
            case 'create':
                list($activity_name, $faculty_department, $activity_date, $start_time) = getActivityData();
                if ($activity_name !== null && $faculty_department !== null && $activity_date !== null && $start_time !== null) {
                    add_activity($pdo, $activity_name, $faculty_department, $activity_date, $start_time);
                } else {
                    // Handle missing data case
                }
                break;
            case 'delete':
                $id = isset($_POST['activity_id']) ? $_POST['activity_id'] : null;
                if ($id !== null) {
                    delete_activity($pdo, $id);
                } else {
                    // Handle missing ID case
                }
                break;
            default:
                // Handle unknown action case
                break;
        }
    }
}

function handle_event_crud($pdo)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['event_action'])) {
        switch ($_POST['event_action']) {
            case 'create':
                list($event_name, $organizing_department, $event_date, $start_time) = getEventData();
                if ($event_name !== null && $organizing_department !== null && $event_date !== null && $start_time !== null) {
                    add_event($pdo, $event_name, $organizing_department, $event_date, $start_time);
                } else {
                    // Handle missing data case
                }
                break;
            case 'delete':
                $id = isset($_POST['event_id']) ? $_POST['event_id'] : null;
                if ($id !== null) {
                    delete_event($pdo, $id);
                } else {
                    // Handle missing ID case
                }
                break;
            default:
                // Handle unknown action case
                break;
        }
    }
}


function fetchRecords($pdo, $table = null, $customQuery = null)
{
    // Determine the SQL query to execute
    if ($customQuery !== null) {
        $sql = $customQuery;
    } else {
        // Construct the base SQL query for fetching records from a table
        $sql = "SELECT * FROM $table";
    }

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Execute the statement and fetch the results
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

