<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'Already Added To Wishlist!';
   }elseif($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already Added To Cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'Added To Wishlist!';
   }

}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->execute([$p_name, $user_id]);

   if($check_cart_numbers->rowCount() > 0){
      $message[] = 'Already Added To Cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'Added To Cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSSS/index.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>Go Organic, No Second Thoughts </span>
         <h3>Embrace Wellness with Organic Choices</h3>
         <p>Embrace Wellness with Organic Choices" reflects a commitment to healthier living through mindful eating. By choosing organic products, you're not only nourishing your body with wholesome, chemical-free ingredients but also supporting sustainable farming practices.</p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">Shop By Category</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="" width="100%" height="100%" >
         <h3>Fruits</h3>
         <p>Packed with essential vitamins, minerals, and antioxidants,a key part of a balanced diet that boosts overall health health to immune.</p>
         <a href="category.php?category=Fruits" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/cat-2.png" alt="" width="100%" height="100%" >
         <h3>Meat & Seafood</h3>
         <p>High-quality protein from meat contributes to muscle growth, tissue repair, and provides vital nutrients like iron, zinc, and B vitamins, which are essential for sustained energy.</p>
         <a href="category.php?category=Meat_Seafood" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/cat-3.png" alt="" width="100%" height="100%" >
         <h3>Vegetables</h3>
         <p>Rich in fiber, nutrients, and plant-based compounds, vegetables help support digestion, maintain weight, and protect against chronic diseases  stronger immune system.</p>
         <a href="category.php?category=Vegetables" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/eggss.webp" alt="" width="100%" height="100%" >
         <h3>Dairy & Eggs</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Dairy & Eggs" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/breadss.webp" alt="" width="100%" height="100%" >
         <h3>Bakery</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Bakery" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/daalian.webp" alt="" width="100%" height="100%" >
         <h3>Pantry Staples</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Pantry Staples" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/snacks.webp" alt="" width="100%" height="100%" >
         <h3>Snacks & Beverages</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Snacks_Beverages" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/frozen.webp" alt="" width="100%" height="100%" >
         <h3>Frozen Foods</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Frozen Foods" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/water.jpeg" alt="" width="100%" height="100%" >
         <h3>Health & Wellness</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Health_Wellness" class="btn">Shop</a>
      </div>

      <div class="box">
         <img src="images/towel.webp" alt="" width="100%" height="100%" >
         <h3>Household Essentials</h3>
         <p>Loaded with omega-3 fatty acids and lean protein, fish supports heart health, brain function, and promotes a healthy immune system.</p>
         <a href="category.php?category=Household Essentials" class="btn">Shop</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
      $select_products->execute();
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price"><b>Rs: <span><?= $fetch_products['price']; ?></span>/- per kg</b></div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No Products Added Yet!</p>';
   }
   ?>

   </div>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>