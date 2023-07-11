<?php
  include 'inc/header.php';
?>

	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Store</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Cửa hàng</a></li>
    </ul>
  </div>
</div>
  
  <!-- main body -->
  <div class="main">
    <div class="wrapper row2">
      <div class="hoc container clear">
        <header class="heading" style=" font-family: Verdana, Geneva, sans-serif;
                                        font-size:22px;
                                        color:#F1832A;
                                        padding:15px 20px;
                                        border:1px solid;
                                        border-radius:3px;">Sản phẩm nổi bật</header>
          
          <ul class="nospace group team">
            <?php
              $product_noibat = $product -> getproduct_noibat();
              if($product_noibat){
                while ($result = $product_noibat->fetch_assoc()){
            ?>
            <li class="grid_1_of_4 images_1_of_4"  style="text-align: center; list-style-type: none;">
              <figure  style="display: inline-table; height: 400px;"><a class="imgover" href="details.php?proid=<?php echo $result['productId'] ?>"><img src="adbanhang/uploads/<?php echo $result['image'] ?>" alt="" style="height: 270px;"></a>
                <figcaption>
                  <h5 style="font-family: 'Monda', sans-serif; height: 60px;"><?php echo $result['productName'] ?></h5>
                  <p><span class="price"><?php echo $fm->format_currency($result['price'])." VND" ?></span></p>
                </figcaption>
              </figure>
            </li>
            <?php
              }}
            ?>
          </ul>

          <br>

          <header class="heading" style=" font-family: Verdana, Geneva, sans-serif;
                                        font-size:22px;
                                        color:#F1832A;
                                        padding:15px 20px;
                                        border:1px solid;
                                        border-radius:3px;">Sản phẩm mới</header>

          <ul class="nospace group team">
            <?php
              $product_new = $product -> getproduct_new();
              if($product_new){
                while ($result_new = $product_new->fetch_assoc()){
            ?>  
            <li class="grid_1_of_4 images_1_of_4" style="text-align: center; list-style-type: none;">
              <figure style="display: inline-table; height: 400px;"><a class="imgover" href="details.php?proid=<?php echo $result_new['productId'] ?>"><img src="adbanhang/uploads/<?php echo $result_new['image'] ?>" alt="" style=" height: 270px;"></a>
                <figcaption>
                  <h5 style=" font-family: 'Monda', sans-serif; height: 60px;" ><?php echo $result_new['productName'] ?></h5>
                  <p><span class="price" style="margin-left: 0px;"><?php echo $fm->format_currency($result_new['price'])." VND" ?></span></p> 
                </figcaption>
              </figure>
            </li>
            <?php
              }}
            ?>
          </ul>
          <!-- ################################################################################################ -->
        <nav class="pagination">
          <ul>

            <!-- <li><a href="#">&laquo; Previous</a></li> -->

          <?php
          if(isset($_GET['trang'])){
            $trang = $_GET['trang'];
          }else{
            $trang = 1;
          }
          $product_all = $product->getproduct_all(); //Lấy biến
          $product_count = mysqli_num_rows($product_all); //Khai báo biến tổng
          $product_button = ceil($product_count/8); //Biến nút = tổng/số sp trên 1 trang hiển thị
          $i = 1;
          for($i=1;$i<=$product_button;$i++){
            ?>
            <li><a class="phantrang" <?php if($i==$trang){ echo 'style="background:orange; color:#FFF;"';} ?> style="margin:0 10px;" href="store.php?trang=<?php echo $i ?>"><?php echo $i ?></a></li> 
          <?php
          }
          ?>
            <!-- <li><a href="#">Next &raquo;</a></li> -->

          </ul>
        </nav>
      <!-- ################################################################################################ -->

      </div>
      
    </div>


      
  </div>

<?php
  include 'inc/footer.php';
?>