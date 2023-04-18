<?php
require_once "pdo.php";


if (isset($_POST['fullname']) && isset($_POST['username']) &&
    isset($_POST['password']) && isset($_POST['email'])&& 
    isset($_POST['phone_number']) && isset($_POST['date_of_birth']) && 
    isset($_POST['unversity']) && isset($_POST['field_of_study'])
    ){

    /*
        Validate email address format
    */
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email address';
        exit;
    }
    /*
        Check for duplicate email address
    */
    $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
    $temp = $pdo->prepare($sql);
    $temp->execute(array(
        ':email'=> $_POST['email']
    ));
    $count = $temp->fetchColumn();

    if ($count > 0) {
        echo 'Email address already in use';
        header('location:signup.php');
        return;
    }
    /*
        inserting data to the database
    */   
    $sql = "Insert into user (fullname ,username, email  , password , phone_number , date_of_birth , unversity , field_of_study ) values
        ( :fullname , :username, :email  , :password , :phone_number , :date_of_birth , :unversity , :field_of_study )";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute(array(
        ':fullname' => $_POST['fullname'],
        ':username' => $_POST['username'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':phone_number' => $_POST['phone_number'],
        ':date_of_birth' => $_POST['email'],
        ':unversity' => $_POST['unversity'],
        ':field_of_study' => $_POST['field_of_study']
    ));
        header('Location: login.php');
        return;

    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <link href="sign-up.css" rel="stylesheet" crossorigin="anonymous" />
    <title>Sign-up</title>
  </head>
  <body class="signUp">
    <!-- Navigation -->
    <!-- 
  <nav>
    <a href="/HomePage.html"><img src="/Images/aastu-online-learning-high-resolution-color-logo.png" alt=""></a>

    <div class="navigation">
      <ul>
        <li><a href="/HomePage.html">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Courses</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="/SignUp.html">Register</a></li>
      </ul>
    </div>
  </nav> -->

    <!-- Registration Form -->

    <div class="container">
      <div class="title">Registration</div>
      <form action="#" method="POST">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full name</span>
            <input type="text" placeholder="Enter your name" name="fullname"required />
          </div>
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="username" required />
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name = "email" placeholder="Enter your email" required />
          </div>
          <div class="input-box">
            <span class="details">Phone number</span>
            <input type="text" name ="phone_number" placeholder="Enter your phone number" required />
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" placeholder="Enter your password" required />
          </div>
          <div class="input-box">
            <span class="details">Comfirm Password</span>
            <input type="password" placeholder="Enter your password" required />
          </div>
          <div class="input-box">
            <span class="details">Country</span>
            <input type="text" name="country" placeholder="Enter your country" required />
          </div>
          <div class="input-box">
            <span class="details">Date of Birth</span>
            <input
              type="date"
              placeholder="Enter your Date of Birth" name = "date_of_birth"
              required
            />
          </div>
          <div class="input-box">
            <span class="details">University</span>
            <input type="text" name = "unversity" placeholder="Enter your university" />
          </div>
          <div class="input-box">
            <span class="details">Field of Study</span>
            <input
              type="text"
              placeholder="Enter your field of study" name = "field_of_study"
              required
            />
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Register" />
          <input type="reset" value="Clear" />
        </div>
      </form>
      <div class="home">
        <a href="/index.html">Home</a>
      </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>
