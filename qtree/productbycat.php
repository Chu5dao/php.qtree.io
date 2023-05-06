<?php
  include 'inc/header.php';
?>
<?php
    $cat = new Category();
    if (!isset($_GET['catid']) && $_GET('catid') == NULL){
        echo "<script>window.location = '404.php';</script>";
    }else{
        $id = $_GET['catid'];
    }

    // if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($catName, $id);
    // }
?>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Products</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Cửa hàng</a></li>
      <?php
        $name_cat = $cat->get_name_by_cat($id);
        if($name_cat){
          while($result_name = $name_cat->fetch_assoc()){
        ?>
      <li><a href="#"><?php echo $result_name['catName']?></a></li>
      <?php
        }}
        ?>
    </ul>
  </div>
</div>
  
  <!-- main body -->
  <div class="main">
    <div class="wrapper row2">
      <div class="hoc container clear">
        <?php
        $name_cat = $cat->get_name_by_cat($id);
        if($name_cat){
          while($result_name = $name_cat->fetch_assoc()){
        ?>
        <header class="heading" style="font-family: Verdana, Geneva, sans-serif; 
                                        font-size:22px;
                                        color:#F1832A;
                                        padding:15px 20px;
                                        border:1px solid;
                                        border-radius:3px;">Danh mục sản phẩm: <?php echo $result_name['catName']?></header>
        <?php
        }}
        ?>
          
          <ul class="nospace group team">
            <?php
              $productbycat = $cat -> get_product_by_cat($id);
              if($productbycat){
                while ($result = $productbycat->fetch_assoc()){
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
              }
              }else{
                echo '<span class="error"> Danh mục này hiện tại sản phẩm đã hết!!!</span>';
              }
            ?>
          </ul>

          <br>

          

      </div>
    </div>

          
      <!-- ################################################################################################ -->
        <!-- <nav class="pagination">
          <ul>
            <li><a href="#">&laquo; Previous</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><strong>&hellip;</strong></li>
            <li><a href="#">6</a></li>
            <li class="current"><strong>7</strong></li>
            <li><a href="#">8</a></li>
            <li><a href="#">9</a></li>
            <li><strong>&hellip;</strong></li>
            <li><a href="#">14</a></li>
            <li><a href="#">15</a></li>
            <li><a href="#">Next &raquo;</a></li>
          </ul>
        </nav> -->
      <!-- ################################################################################################ -->
  </div>
<?php
  include 'inc/footer.php';
?>