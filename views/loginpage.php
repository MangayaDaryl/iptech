<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    /* Reset Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body Styles */
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f9f9f9;
      font-family: Arial, sans-serif;
    }

    /* Form Container */
    .login-container {
      background-color: #ffffff;
      padding: 30px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
    }

    /* Title Styles */
    .login-container h1 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    /* Input Styles */
    .login-container input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 14px;
    }

    /* Forgot Password Link */
    .login-container .forgot-password {
      font-size: 12px;
      color: #555;
      text-decoration: none;
      margin-bottom: 20px;
      display: inline-block;
    }

    /* Forgot Password Hover Effect */
    .login-container .forgot-password:hover {
      text-decoration: underline;
    }

    /* Button Styles */
    .login-container button {
      width: 100%;
      padding: 10px;
      background-color: black;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 14px;
      cursor: pointer;
    }

    /* Button Hover Effect */
    .login-container button:hover {
      background-color: #333;
    }

    /* Create Account Link */
    .login-container .create-account {
      font-size: 14px;
      color: black;
      margin-top: 20px;
      text-decoration: none;
      display: inline-block;
    }

    /* Create Account Hover Effect */
    .login-container .create-account:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h1>Login</h1>
    <!-- Display error message if set -->
    <?php if (isset($_SESSION['error'])): ?>
      <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="login_process.php" method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <a href="#" class="forgot-password">Forgot your password?</a>
      <button type="submit">SIGN IN</button>
    </form>
    <a href="signup.php" class="create-account">Create account</a>
  </div>
</body>
</html>