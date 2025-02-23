<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="CSSS/index.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/bag.png" alt="">
         <h3>why choose us?</h3>
         <p>At our grocery store, we prioritize freshness, quality, and convenience. Our carefully curated products are sourced from trusted suppliers to ensure you get only the best.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/trolley.png" alt="">
         <h3>what we provide?</h3>
         <p>We provide a diverse range of fresh, high-quality grocery essentials, from organic fruits and vegetables to premium meats and pantry staples. Our goal is to offer products that support your healthy lifestyle and simplify your shopping experience.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">clients Reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Fantastic selection and always fresh! I love how easy it is to find everything I need in one place, and the delivery service is super reliable. Definitely my go-to grocery store!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>John M.</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
         <p>Great quality and really reasonable prices. I appreciate the organic options and how everything arrives in perfect condition. The customer service is top-notch too!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-full-alt"></i>
         </div>
         <h3>Sarah L.</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Amazing variety and great quality! The meat and seafood options are particularly good, and I always know I’m getting fresh products. The website is easy to use, which is a bonus.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>David K.</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>I’ve been ordering my groceries here for months, and I’m impressed every time. The fruits and vegetables are always so fresh, and it saves me so much time. Highly recommended!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-full-alt"></i>
         </div>
         <h3>Emily R.</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>Reliable service with a fantastic selection. I love the customer care, and I’m always pleased with my orders. It’s made grocery shopping so much simpler and enjoyable!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Michael H.</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Super convenient, and the delivery is always quick. I love that they have so many healthy and organic options. This grocery store has become a staple for our family!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-full-alt"></i>
         </div>
         <h3>Olivia T.</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>