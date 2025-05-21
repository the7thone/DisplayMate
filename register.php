<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match.";
    } else {
        // Check if the user already exists
        $sql = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user_exists = $stmt->fetchColumn();

        if ($user_exists) {
            $error_message = "Username already exists.";
        } else {
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$username, $hashed_password])) {
                $success_message = "Registration successful! Redirecting to login in ";
            } else {
                $error_message = "Error registering user.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
    <script>
        function handleRedirect(message) {
            let countdown = 5;
            const alertElement = document.getElementById('success-alert');
            alertElement.textContent = `${message} ${countdown} seconds...`;

            const interval = setInterval(() => {
                countdown--;
                alertElement.textContent = `${message} ${countdown} seconds...`;
                if (countdown === 0) {
                    clearInterval(interval);
                    window.location.href = "login.php";
                }
            }, 1000);
        }

        function togglePasswordVisibility(id) {
            const passwordField = document.getElementById(id);
            const toggleButton = document.getElementById(id + "-toggle");
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleButton.textContent = 'Hide';
            } else {
                passwordField.type = 'password';
                toggleButton.textContent = 'Show';
            }
        }
    </script>
</head>

<body class="bg-light">
    <?php include './_partials/navbar.php'; ?>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card mx-5 w-100" style="max-width: 350px;">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="card-title mb-0">Register</h4>
            </div>
            <div class="card-body">
                <?php if (isset($success_message)): ?>
                    <div id="success-alert" class="alert alert-success" role="alert">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                    <script>
                        handleRedirect("<?php echo htmlspecialchars($success_message); ?>");
                    </script>
                <?php endif; ?>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" required>
                            <button type="button" id="password-toggle" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('password')">Show</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                                required>
                            <button type="button" id="confirm_password-toggle" class="btn btn-outline-secondary"
                                onclick="togglePasswordVisibility('confirm_password')">Show</button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <a href="index.php" class="btn btn-link">Go Home</a>
            </div>
        </div>
    </div>
    <?php include './_partials/footer.php'; ?>
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>