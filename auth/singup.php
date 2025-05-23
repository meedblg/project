<?php
include('../includes/db.php');

$error = ''; // نحطوها باش نعرضو الخطأ في HTML

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($check_email);

        if ($result->num_rows > 0) {
            $error = "Email already registered.";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                header("Location: login.php");
                exit();  
            } else {
                $error = "Error: " . $conn->error;
            }
        }
    }
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <link rel="stylesheet" href="../css/login.css" />
  <title>Sign Up | Lisya</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin">
        <form method="POST" action="singup.php" class="sign-in-form" onsubmit="return validatePasswords();">
          <h2 class="title">Sign up</h2>

          <!-- حقل اسم المستخدم -->
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="username" placeholder="Username" required />
          </div>

          <!-- حقل البريد الإلكتروني -->
          <div class="input-field">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required />
          </div>

          <!-- حقل كلمة المرور -->
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required />
            <i class="fas fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
          </div>

          <!-- حقل تأكيد كلمة المرور -->
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" required />
            <i class="fas fa-eye toggle-password" onclick="togglePassword('confirm_password', this)"></i>
          </div>

          <!-- رسالة الخطأ -->
          <div class="error-message-container">
            <p class="error-message" id="password-error"></p>
          </div>

          <div class="terms">
            <label>
              <input type="checkbox" required />
              I accept the <a href="#">terms & policy</a>
            </label>
          </div>

          <input type="submit" name="register" class="btn solid" value="Sign Up" />

          <div class="extra-links">
            <p class="signup">Already have an account? <a href="login.php">Sign in</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // توظيف وظيفة إظهار كلمة المرور
    function togglePassword(fieldId, icon) {
      const input = document.getElementById(fieldId);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }

    // التحقق من تطابق كلمة المرور
    function validatePasswords() {
      const pass = document.getElementById("password");
      const confirm = document.getElementById("confirm_password");
      const errorMessage = document.getElementById("password-error");

      // إزالة أي رسالة خطأ قديمة
      errorMessage.textContent = '';

      // إذا كانت كلمات المرور غير متطابقة
      if (pass.value !== confirm.value) {
        errorMessage.textContent = 'Passwords do not match.';
        confirm.focus();

        // مسح الحقول
        pass.value = '';
        confirm.value = '';

        // تعيين الكيرسور على حقل كلمة المرور الأول
        pass.focus();
        
        return false;
      }
      return true;
    }
  </script>
</body>
</html>
