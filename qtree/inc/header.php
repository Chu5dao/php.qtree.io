<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
  include_once 'lib/database.php';
  include_once 'helpers/format.php';

  spl_autoload_register(function($className){
    include_once "classes/".$className.".php";
  });
    $db = new Database();
    $fm = new Format();
    $ct = new Cart();
    $us = new User();
    $cat = new Category();
    $cs = new Customer();
    $product = new Product();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Q-Tree</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="layout/styles/layoutt.css" rel="stylesheet" type="text/css" media="all">

    <link rel="stylesheet" type="text/css" href="layout/styles/css/stylee.css">
    <link rel="stylesheet" type="text/css" href="layout/styles/css/menu.css">

    


  </head>
<body id="top">
  <div class="top-mid" style="background-color: #FFFFFF;">
    <div class="bgded overlay" style="background-image:url('images/demo/backgrounds/bg2.jpg');"> 
    
      <div class="wrapper row0">
        <div id="topbar" class="hoc clear">
          <div class="fl_left"> 

            <ul class="nospace">
              <li><i class="fas fa-phone rgtspace-5"></i> +84 (0)56 373 1506</li>
              <li><i class="far fa-envelope rgtspace-5"></i> 0650070039@sv.hcmunre.edu.com</li>
            </ul>

          </div>
          <div class="fl_right"> 
            <ul class="nospace">
              <li><a href="index.php"><i class="fas fa-home"></i></a></li>
              <!--  <li><a href="#" title="Help Centre"><i class="far fa-life-ring"></i></a></li> -->
              <li><a href="./adbanhang/index.php" title="Login Admin"><i class="fas fa-sign-in-alt"></i></a></li>
              <li id="searchform">
                <div>
                  <form action="search.php" method="post">
                    <fieldset>
                      <legend>Quick Search:</legend>
                      <input type="text" name="tukhoa" placeholder="Nhập từ khóa tìm kiếm&hellip;">
                      <button type="submit" name="search_product"><i class="fas fa-search"></i></button>
                    </fieldset>
                  </form>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="wrapper row1">
        <header id="header" class="hoc clear">
          <div id="logo" class="fl_left"> 
            <h1><a href="index.php">q-tree</a></h1>
          </div>
          <nav id="mainav" class="fl_right"> 
            <ul class="clear">
              <li class=""><a href="index.php">Trang chủ</a></li>
              <li><a class="active" href="store.php">Cửa Hàng</a>
                <ul>
                  <?php
                  $getall_category = $cat-> show_category_fontend();
                    if($getall_category){
                      while ($result_allcat = $getall_category->fetch_assoc()) {
                  ?>
                  <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName']?></a></li>
                  <?php
                    }}
                  ?>
                </ul>
              </li>
              

              <li><a href="contact.php">Liên hệ</a></li>
              <?php
                $customer_id = Session::get('customer_id');
                $check_order = $ct->check_order($customer_id);
                if($check_order==true){
                  echo '<li><a href="order_details.php">Lịch sử đặt hàng</a></li>';
                }else{
                  echo '';
                }
              ?>
              <?php
                $login_check = Session::get('customer_login'); 
                if($login_check){
                  echo '<li><a href="wishlist.php">Yêu thích</a> </li>';
                }
              ?>
              <?php
              $login_check = Session::get('customer_login');
                if($login_check == false){
                  echo '';
                }else{
                  echo '<li><a href="profile.php">Hồ Sơ</a></li>';
                }
              ?>
              <?php
                if(isset($_GET['customer_ID'])){
                  $delCart = $ct->del_all_data_cart();
                  Session::destroy();
                }
              ?>
              <li class="login">
                <?php
                $login_check = Session::get('customer_login');
                if($login_check == false){
                  echo '<a href="login.php">Login</a></li>';
                }else{
                  echo '<a href="?customer_ID='.Session::get("customer_id").'">Logout</a></li>';
                }
                ?>
              
              <li class="shopping_cart">
                <div class="cart">
                  <a href="cart.php" title="Xem giỏ hàng của bạn" rel="nofollow">
                    <span class="fas fa-shopping-cart" style="color: #FBAB45;"></span>
                    <span class="no_product" style="color: #FBAB45;">
                      <?php
                      $check_cart = $ct->check_cart();
                        if($check_cart){
                        $sum = Session::get("sum");
                        $amo = Session::get("amo");
                          echo $sum.' đ '.'('.$amo.')';
                        }else{
                        echo 'Giỏ hàng (0)';
                      }
                      ?>
                    </span>
                  </a>
                </div>
              </li>
            </ul>
          </nav>
        </header>
      </div>
