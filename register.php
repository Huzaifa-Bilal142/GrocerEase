<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert->execute([$name, $email, $pass]);

         if($insert){
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }

      }
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>GrocerEase - register</title>
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
      box-sizing: border-box;
    }
    .d-flex{
      margin-left: 300px;
    }
    body {
      background-image: url(Images/login\ img.jpg);
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
      background: darkorange;
      box-shadow: 0 1vw 1.667vw darkorange;
    }
/* .message{
  text-align: center;
  text-transform: capitalize;
  margin: 0 auto;
  margin-bottom: 2rem;
  width: 30%;
  padding: .5rem 1.5rem;
  border-radius: 3px;
  display: flex;
  justify-content: space-between;
  color: red;
  background: transparent;
}
.message i{
  cursor: pointer;
} */
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
      margin-top: 0;
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
      font-size: 15px;
      text-decoration: none;
      color:whitesmoke;
      margin-top: 10px;
      margin-left: 30px;
      font-family:Arial, Helvetica, sans-serif;
    }

    #register a {
      margin-left: 5px;
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
    font-size: 5vw;
  }

  #register a {
    font-size: 5vw;
  }

  #display {
    font-size: 5vw;
  }
}
  </style>
</head>

<body>
  <div class="register">
    <div id="main" style="margin-top: 4vw">
      <div class="login-box">
      <?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

        <h2 style="color: whitesmoke">Register</h2>
        <form method="post">      
           <!-- action not used since php written in same file -->
          <div class="user-box">
            <input type="text" name="name" id="name" required="" />
            <label>Username</label>
          </div>
          <div class="user-box">
            <input type="email" name="email" id="email" required="" />
            <label>Email</label>
          </div>
          <div class="user-box">
            <input type="password" name="pass" id="pass" required="" />
            <label>Password</label>
          </div>
          <div class="user-box">
            <input type="password" name="cpass" id="cpass" required="" />
            <label>Confirm Password</label>
          </div>
             <div class="button-form ">
             <button id="submit" name="submit" type="submit">Register</button>
             </div>
             <div id="register">
             <p>Already have an Account?<a href="login.php"><u>Login</u></a></p>
             </div>
        </form>
      </div>
    </div>
    </div>
</body>
</html>
