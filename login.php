<?php

@include 'config.php';

session_start();

if (isset($_POST['submit'])) {
    // Email validation: check if the email is valid
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Invalid email format!';
    } else {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pass = md5($_POST['pass']); // Please change this to password_hash in the future
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);

        // Query to check if email and password match
        $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $pass]);
        $rowCount = $stmt->rowCount();

        if ($rowCount > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_id'] = $row['id'];
                header('location:admin_page.php');
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_id'] = $row['id'];
                header('location:home.php');
            } else {
                $message[] = 'No user found!';
            }
        } else {
            $message[] = 'Incorrect email or password!';
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>
<!-- bootstrap js link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js">

   <!--bootstrap css link -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <!-- <link rel="stylesheet" href="CSSS/parts.css"> -->
   <style>
    * {
      margin: 0;
      padding: 0;
      cursor: pointer;
      position: relative;
    }
    .d-flex{
      margin-left: 300px;
    }
    body {
      background-image:url(Images/login\ img.jpg);
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      font-family:Verdana, Tahoma, sans-serif;
      min-height: 100vh;
    }
    .grid {
      display: grid;
      grid-template-areas:
        "logo logo logo navbar navbar navbar"
        "catg catg catg catg catg catg"
        "main main main main main main"
        "footer footer footer footer footer footer";
      grid-gap: 0px;
    }
    .login-box {
      position: relative;
      top: 350px;
      left: 50%;
      width: 26.667vw;
      padding: 2.667vw;
      transform: translate(-50%, -50%);
      background:darkorange;
      box-shadow: 0 1vw 1.667vw darkorange;
      box-sizing: border-box;
    }

    .login-box h2 {
      margin: 0 0 2vw;
      padding: 0;
      color: #fff;
      text-align: center;
      letter-spacing: 0.167vw;
      text-transform: uppercase;
    }

    .login-box .user-box input {
      position: relative;
      width: 100%;
      padding: 0.667vw 0vw;
      font-size: 1.067vw;
      color: #fff;
      margin-bottom: 1vw;
      border: none;
      border-bottom: 0.067vw solid #fff;
      outline: none;
      background: transparent;
    }

    .login-box .user-box label {
      position: relative;
      left: 0vw;
      top: -4vw;
      padding: 0.667vw 0vw;
      font-size: 1.067vw;
      color: #fff;
      pointer-events: none;
      transition: 0.5s;
    }

    .login-box .user-box input:focus~label,
    .login-box .user-box input:valid~label {
      top: -5.667vw;
      left: 0vw;
      color:whitesmoke;
      font-size: 1vw;
    }

    #submit {
      padding: 0.667vw 1.333vw;
      color: whitesmoke;
      font-size: 1.067vw;
      font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      text-decoration: none;
      overflow: hidden;
      transition: 0.5s;
      border:2px solid orange;
      background: transparent;
      margin: auto;
      cursor: pointer;
    }

    #submit:hover {
      background: #fff5e6;
      color: darkorange;
      border-radius: 0.333vw;
      box-shadow: 0 0 0.333vw rgb(86, 134, 182) , 00 1.667vw rgb(86, 134, 182),
        0 0 3.333vw rgb(86, 134, 182) , 6.667vw rgb(86, 134, 182);
    }

    .button-form {
      display: flex;
      flex-direction: row;
      margin-top: 3px;
    }

    #register {
      font-size: 20px;
      text-decoration: none;
      color:whitesmoke;
      margin-top: 15px;
      margin-left: 40px;
      font-family:Arial, Helvetica, sans-serif;
    }

    #register a {
      margin-left: 10px;
      color: white;
      text-decoration: none;
      font-family:Arial, Helvetica, sans-serif;
    }
    #register a:hover {
      color: darkgoldenrod;
      font-family:Arial, Helvetica, sans-serif;
    }

    .display {
      color: red;
      font-size: 1.133vw;
      font-family:Arial, Helvetica, sans-serif;
      text-align: center;
      margin-bottom: 1vw;
    }
/* Media Queries for responsiveness */
@media screen and (max-width: 768px) {
  .login-box {
    width: 80vw; /* Make the login box wider on smaller screens */
    padding: 5vw;
    top: 300px; /* Adjust positioning */
  }

  .login-box h2 {
    font-size: 6vw;
    letter-spacing: 0.5vw;
  }

  .login-box .user-box input {
    font-size: 4vw;
  }

  .login-box .user-box label {
    font-size: 3.5vw;
  }

  #submit {
    font-size: 4vw;
    padding: 2vw 5vw;
  }

  #register {
    font-size: 4vw;
    margin-left: 0;
  }

  #register a {
    font-size: 4vw;
  }

  #display {
    font-size: 4vw;
  }
}

@media screen and (max-width: 480px) {
  .login-box {
    width: 90vw;
    top: 350px;
    padding: 8vw;
  }

  .login-box h2 {
    font-size: 8vw;
  }

  .login-box .user-box input {
    font-size: 5vw;
  }

  .login-box .user-box label {
    font-size: 4.5vw;
  }

  #submit {
    font-size: 5vw;
    padding: 3vw 6vw;
  }

  #register {
    font-size: 8vw;
  }

  #register a {
    font-size: 10vw;
  }

  #display {
    font-size: 5vw;
  }
}

  </style>
</head>

<body>
  <div class="login">    
    <div id="main" style="margin-top: 3vw">
      <div class="login-box">
      <?php
        if (isset($message)) {
          foreach ($message as $message) {
            echo '<div class="display alert-danger">
                    <span>'.$message.'</span>
                    <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                  </div>';
          }
        }
      ?>
        <h2 style="color: whitesmoke">Login</h2>
        <form method="post" action="">
          <div class="user-box">
            <input type="text" name="email" required="">
            <label>Email</label>
          </div>
          <div class="user-box">
            <input type="password" name="pass" required="">
            <label>Password</label>
          </div>
          <div class="button-form">
            <button id="submit" type="submit" name="submit"><b>Login</b></button>
          </div>
          <div id="register">
            <p>Don't have an account?<a href="register.php"><u>Register</u></a></p>
          </div>
        </form>
      </div>
    </div>
</body>
</html>





