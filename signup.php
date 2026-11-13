<?php
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["password"] !== $_POST["confirm"]) {
        $message = "Passwords do not match.";
    } else {
        $message = "Signup form received for " . htmlspecialchars($_POST["name"]);
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
        <div class="alert alert-info"><?php echo $message; ?></div>
      <?php endif; ?>
      <form method="post" action="signup.php">
        <div class="mb-3">
          <label for="name" class="form-label">Full name</label>
          <input type="text" class="form-control" id="name" name="name" required>
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