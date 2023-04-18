<?php
    require_once "pdo.php";

    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Collect form data
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Verify user credentials
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email and password = :password" );
        $stmt->execute(array(
            ':email'=>$email,
            ':password'=>$password
        ));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Generate token
            $token = bin2hex(random_bytes(16));
    
            // Update user's token in the database
            $stmt = $pdo->prepare('UPDATE user SET token = ? WHERE id = ?');
            $stmt->execute([$token, $user['id']]);
    
            // Set token in session
            session_start();
            $_SESSION['token'] = $token;
    
            // Redirect to dashboard
            header('Location: dashboard.php');
            exit;
        } else {
            // Invalid credentials
            echo 'Invalid email or password';

        }
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>AASTU Online Courses | Login</title>

    <!-- <script src="https://kit.fontawesome.com/ab588cccfb.js" crossorigin="anonymous"></script> -->
    <link rel="icon" type="image/x-icon" href="/Images/Final Logo.jpg" />
    <link rel="stylesheet" href="login.css" />
    <script defer src="/register.js"></script>

  </head>

  <body class="signUp">
    <div class="container">
      <div class="title">
        <h1>Login</h1>
      </div>
      <form action="#" id="log-form" method="POST">
        <div class="inp-control">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" />
          <div class="error"></div>
        </div>
        <div class="inp-control">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" />
          <div class="error"></div>
        </div>
        <div class="button">
          <input type="submit" value="Login" id="login" />
          <input onclick="location.reload()" type="reset" value="Clear" />
        </div>
      </form>
      <div class="home">
        <a href="dashboard.php">Home</a>
        <a href="signup.php">Sign Up</a>
      </div>
    </div>
    <!-- <script>
      const form = document.getElementById("log-form");
      const username = document.getElementById("username");
      const password = document.getElementById("password");

      form.addEventListener("submit", (e) => {
        e.preventDefault();

        validateInputs();
      });

      const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");

        errorDisplay.innerText = message;
        inputControl.classList.add("error");
        inputControl.classList.remove("success");
      };

      const setSuccess = (element) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector(".error");

        errorDisplay.innerText = "";
        inputControl.classList.add("success");
        inputControl.classList.remove("error");
      };

      const validateInputs = () => {
        const usernameValue = username.value.trim();
        const passwordValue = password.value.trim();
        if (usernameValue === "") {
          setError(username, "Please enter a valid username.");
        } else {
          setSuccess(username);
        }

        if (passwordValue === "") {
          setError(password, "Please enter a password.");
        } else if (passwordValue.length < 8) {
          setError(password, "Email must be atleast 8 characters long");
        } else {
          setSuccess(password);

          document.getElementById("login").onclick = function () {
            location.href = "/Course.html";
          };
        }
      };
    </script> -->
  </body>
</html>
