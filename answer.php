<?php
    session_start();
    require_once "pdo.php";
    
    
    $token = $_SESSION['token'];

    $stmt = $pdo->prepare('SELECT * FROM User WHERE token = ?');
    $stmt->execute([$token]);
    $user = $stmt->fetch();
    
    $stmt = $pdo->prepare('SELECT question FROM questions WHERE question_id = ?');
    $stmt->execute(
        [$_GET['id']]
    );

    $que = $stmt->fetch();
    $x = $que['question'];
    echo "<h2> $x </h2>";

    if(isset($_POST['answer'])){
        $sql = "Insert into answers (user_id , ques_id ,answer) 
        values
        (:user_id , :ques_id , :answer)";
    
        $stmt = $pdo->prepare($sql);
    
        $stmt->execute(array(
            ':user_id' => $user['id'],
            ':ques_id' => $_GET['id'],
            ':answer' => $_POST['answer']
    ));

    header('Location: questions.php');
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
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
      integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT"
      crossorigin="anonymous"
    />
    <link href="main.css" rel="stylesheet" />

    <title>Ask Questions</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-md navbar-light border-bottom p-0 ps-5">
      <div class="container">
        <a class="navbar-brand" href="#">
          <span class="text-success fw-bold fs-3">Afri-Ask</span>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="container justify-content-end">
            <ul class="navbar-nav container justify-content-end">
              <li class="nav-item nav-dark">
                <a class="nav-link" href="index.html">
                  <svg
                    class="text-success"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 96 960 960"
                    fill="currentColor"
                  >
                    <path
                      d="M220 876h150V626h220v250h150V486L480 291 220 486v390Zm-60 60V456l320-240 320 240v480H530V686H430v250H160Zm320-353Z"
                    />
                  </svg>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="questions.html">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    height="20"
                    viewBox="0 96 960 960"
                    width="20"
                    fill="currentColor"
                  >
                    <path
                      d="M180 1044q-24 0-42-18t-18-42V384q0-24 18-42t42-18h405l-60 60H180v600h600V636l60-60v408q0 24-18 42t-42 18H180Zm300-360Zm182-352 43 42-285 284v86h85l286-286 42 42-303 304H360V634l302-302Zm171 168L662 332l100-100q17-17 42.311-17T847 233l84 85q17 18 17 42.472T930 402l-97 98Z"
                    />
                  </svg>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <div class="popup-container">
                    <img
                      src="src/profile2.png"
                      alt="Profile picture"
                      id="profile-picture"
                      class="profile rounded-circle"
                    />
                    <div class="popup" id="popup">
                      <p class="fw-bold">Name Username</p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="Homepage.html">
                  <svg xmlns="http://www.w3.org/2000/svg" height="48" 
                  viewBox="0 96 960 960" 
                  width="48"
                  fill="currentColor">
                    <path d="M180 936q-24 0-42-18t-18-42V276q0-24 18-42t42-18h291v60H180v600h291v60H180Zm486-185-43-43 102-102H375v-60h348L621 444l43-43 176 176-174 174Z"/></svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="container justify-content-center">
      <h2>Question?</h2>
      <form method="POST" action="">
        <br />
        <textarea name="answer" id="question" cols="90" rows="10"></textarea>
        <br />
        <button class="btn btn-outline-success" name="submitbtn">Submit</button>
      </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
      crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    -->
  </body>
</html>
