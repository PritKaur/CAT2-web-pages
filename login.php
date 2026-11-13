<?php
require 'db.php';
$message = "";
$type = "info";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $conn->prepare("SELECT full_name, password_hash FROM users WHERE username = ?");
    $stmt->bind_param("s", $_POST["username"]);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        $message = "Welcome, " . htmlspecialchars($user["full_name"]) . ".";
        $type = "success";
    } else {
        $message = "Wrong username or password.";
        $type = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <main class="container d-flex align-items-center justify-content-center min-vh-100">
    <div class="card shadow-sm p-4" style="max-width: 380px; width: 100%;">
      <h1 class="h4 mb-3 text-center">Log in</h1>
      <?php if ($message): ?>
        <div class="alert alert-<?php echo $type; ?>"><?php echo $message; ?></div>
      <?php endif; ?>
      <form method="post" action="login.php">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Log in</button>
      </form>
      <p class="text-center mt-3 mb-0">No account? <a href="signup.php">Sign up</a></p>
    </div>
  </main>
</body>
</html>