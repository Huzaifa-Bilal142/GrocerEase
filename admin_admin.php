<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSSS/admin.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">Admin Accounts</h1>

   <div class="box-container">

      <?php
         // Only select users with 'user_type' as 'admin'
         $select_admins = $conn->prepare("SELECT * FROM `users` WHERE user_type = 'admin'");
         $select_admins->execute();
         while ($fetch_admins = $select_admins->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="box" style="<?php if ($fetch_admins['id'] == $user_id) { echo 'display:none'; } ?>">
         <p> User Id : <span><?= $fetch_admins['id']; ?></span></p>
         <p> Username : <span><?= $fetch_admins['name']; ?></span></p>
         <p> Email : <span><?= $fetch_admins['email']; ?></span></p>
         <p> User Type : <span style="color:<?php if ($fetch_admins['user_type'] == 'user') { echo 'orange'; } ?>"><?= $fetch_admins['user_type']; ?></span></p>
         <a href="admin_admin.php?delete=<?= $fetch_admins['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
      }
      ?>
   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>
