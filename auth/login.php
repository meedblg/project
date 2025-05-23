
 <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('../includes/db.php');  // Connect to the database

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email exists in the database
    $check_user = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($check_user);

    if ($result->num_rows > 0) {
        // If user found, get their data
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Redirect to dashboard or home page
            header("Location: ../index/index.php");  // Redirect to the dashboard page
            exit();  // Make sure to stop the rest of the script after redirection
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Email not registered.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="../css/login.css">
    <title>Login | Lisya</title>
</head>

<body>

    <div class="container">
        <div class="forms-container">
            <div class="signin">
                <form method="POST" action="login.php" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                    <div class="input-field">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required>
                    </div>
                    <div class="input-field">
                       <i class="fas fa-lock"></i>
                       <input type="password" name="password" id="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required>
                         <i class="fas fa-eye toggle-password" id="toggleIcon" onclick="togglePassword()"></i>
                     </div>

                    <a href="#" class="forgot">Forgot password?</a>
                    <input type="submit" name="login" class="btn solid" value="login"/>
                    <div class="extra-links">
                        <p class="signup">Don't have an account yet? <a href="singup.php">Sign up</a></p>
                    </div>
                </form>
                
            </div>
        </div>
    </div>

    



    <script>
function togglePassword() {
  var passwordField = document.getElementById("password");
  var icon = document.getElementById("toggleIcon");

  if (passwordField.type === "password") {
    passwordField.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

</script>

</body>
</html>
