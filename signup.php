<?php
require 'db.php';
$message = "";
$type = "info";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $full_name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);

    if ($_POST["password"] !== $_POST["confirm"]) {
        $message = "Passwords do not match.";
        $type = "danger";
    } else {
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        try {
            $stmt = $conn->prepare("INSERT INTO users (username, full_name, email, password_hash) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $full_name, $email, $hash);
            $stmt->execute();
            $message = "Account created for " . htmlspecialchars($username) . ".";
            $type = "success";
        } catch (mysqli_sql_exception $e) {
            $message = "That username or email is already registered.";
            $type = "danger";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm p-4" style="max-width: 380px; width: 100%;">
      <h1 class="h4 mb-3 text-center">Create an account</h1>
      <?php if ($message): ?>
        <div class="alert alert-<?php echo $type; ?>"><?php echo $message; ?></div>
      <?php endif; ?>
      <form method="post" action="signup.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="full_name" class="form-label">Full name</label>
          <input type="text" class="form-control" id="full_name" name="full_name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
          <label for="confirm" class="form-label">Confirm password</label>
          <input type="password" class="form-control" id="confirm" name="confirm" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Sign up</button>
      </form>
      <p class="text-center mt-3 mb-0">Already registered? <a href="login.php">Log in</a></p>
    </div>
  </main>
</body>
</html>