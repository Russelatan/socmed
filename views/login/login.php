<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/login.css?v=1.0.1">
    <link rel="stylesheet" href="../../assets/styles.css">
</head>
<body>
    <h1>Login Area</h1>
    <form action="" class="login-form">
        <input type="hidden" name="action" value="login">
        <input type="text" class="input" placeholder="Enter Username or Email" name="username" required>
        <input type="password" class="input" placeholder="Password" name="password" required>
        <button class="login-bbtn" type="submit"> Login </button>
        <p>Forgot Password? <a href="#">Reset Password</a></p>
        <p>Do you have an Account? <a href="../signup/signup.php">Create Account</a></p>
            
    </form>

</body>
<script src="../../javascript/login_signup/login_signup.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>