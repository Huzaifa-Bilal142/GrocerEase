<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   $select_message->execute([$name, $email, $number, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'already sent message!';
   }else{

      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(?,?,?,?,?)");
      $insert_message->execute([$user_id, $name, $email, $number, $msg]);

      $message[] = 'sent message successfully!';

   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSSS/index.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<<section class="contact container py-5">
   <h1 class="title text-center mb-4">get in touch</h1>

   <form action="" method="POST" class="row justify-content-center">
      <div class="col-md-6 mb-3">
         <input type="text" name="name" class="form-control box" required placeholder="Enter Your Name">
      </div>
      <div class="col-md-6 mb-3">
         <input type="email" name="email" class="form-control box" required placeholder="Enter Your Email">
      </div>
      <div class="col-md-6 mb-3">
         <input type="number" name="number" min="0" class="form-control box" required placeholder="Enter Your Number">
      </div>
      <div class="col-md-12 mb-3">
         <textarea name="msg" class="form-control box" required placeholder="Enter Your Message" cols="30" rows="5"></textarea>
      </div>
      <div class="col-12 text-center">
         <input type="submit" value="send message" class="btn btn-primary mt-3" name="send">
      </div>
   </form>
</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>