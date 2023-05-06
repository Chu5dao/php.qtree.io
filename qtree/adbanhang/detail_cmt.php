<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new Customer();
    if (!isset($_GET['cmt_id']) && $_GET['cmt_id'] == NULL){
        echo "<script>window.location = 'listcmt.php'</script>";
    }else{
        $id = $_GET['cmt_id'];
    }

?>

<?php
	$cs = new Customer();
    if(isset($_GET['shiftid'])){
     	$product_id = $_GET['shiftid'];
     	$date_cmt = $_GET['date_cmt'];
     	$ten_cmt = $_GET['ten_cmt'];
     	$shifted = $cs->shifted($product_id,$date_cmt,$ten_cmt);
    }

?>
<?php
	$cs = new Customer();
    if(isset($_GET['delid'])){
     	$product_id = $_GET['delid'];
     	$date_cmt = $_GET['date_cmt'];
     	$ten_cmt = $_GET['ten_cmt'];
     	$del_shifted = $cs->del_shifted($product_id,$date_cmt,$ten_cmt);
    }

?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Chi tiết comment</h2>
                <div class="block">
             	<?php 
                if(isset($shifted)){
                	echo $shifted;
                }

                ?>  
                <?php 
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                
                ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>


							<th>Nội dung</th>
							<th>Hành động</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$cs = new Customer();
						$fm = new Format();
						$get_ad_cmt = $cs->get_adcmt($id);
						if($get_ad_cmt){
							while($result = $get_ad_cmt->fetch_assoc()){
						 ?>
						<tr class="odd gradeX">


							<td><?php echo $result['cmt'] ?></td>
                            <td><a href="listcmt.php">Thoát</a></td>

						</tr>
						<?php
						}} 
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
