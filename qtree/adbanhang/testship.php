<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$cs = new Customer();
    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$del_shifted = $cs->del_lh($id);
    }

?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Kiểm tra phí SHIP</h2>
                <div class="block" style="position: relative;" >
                	
				<?php include 'inc/map.php'?>

	<script type="text/javascript">
    	<?php
  		// include_once 'helpers/format.php';
    // 	$fm = new Format();
    	?>

	   $(document).ready(function(){ 
     	 //khai báo biến submit form lấy đối tượng nút submit
    	var submit = $("button[name='nutguitt']");

     	 //khi nút submit được click
	      $("#tinhphi").click(function()
	      {

	        var nhap = $("input[name='khoangcach']").val(); //lấy giá trị trong input user      
	        var price_main	 = $("#price_main").val(); 
	        var kc_fix = nhap.replace('m','');
	 		var kc_fix_1 = parseInt(kc_fix);

	        var price_ship_1 = '<span class="error">Không hỗ trợ SHIP với đoạn đường >10.000m.</span>';
	        var	tong_chi_phi_1 = "";
	 		
			console.log(kc_fix_1);
			console.log(price_ship);
			console.log()

			if(kc_fix_1 > 10000){
				price_ship = price_ship_1;
				$('#kc').html(price_ship)
	        	$('#tong_chi_phi').html(tong_chi_phi_1);
			}else{
				var price_ship = 0;
		 		if (kc_fix_1 < 2000){
			 		price_ship = 0;
				}else if(kc_fix_1 < 5000){
					price_ship = 25000;
				}else if(kc_fix_1 < 10000){
					price_ship = 35000;
				}
				$('#kc').html(price_ship + " VNĐ");

				$('#tien_ship_save').val(price_ship);
				$('#kc2').val(kc_fix_1);

				var price_total = Number(price_ship) + Number(price_main);
	        	$('#tong_chi_phi').html(price_total  + " VNĐ");
	        	$('#tong_chi_phi2').val(price_total);

	        	
			}


	      
	 		});
    	});
	</script>

	<table style="text-align:left; color: #373737; top: 0px; box-shadow:0px 0px 20px rgba(0 0 0 / 10%);">
										
		<tr>
			<th>Phí giao hàng :
			<br><a id="tinhphi"  style='color: #000; display: inline; background-color: rgb(239, 239, 239); cursor: pointer;' type='submit' name='nutguitt'>Tính phí giao hàng</a> </th>
			<td id="kc" name="kc"> </td>
			
		</tr>
		
   </table>

   	<div class="sdb_holder" style="position: absolute; left: 50%; top: 0px; padding: 20px;">
        <h3>Thông tin cửa hàng</h3>
        <address style="color: #474747">
        Địa chỉ: 205 - 207 Trần Hưng Đạo B, Quận 5, TP.Hồ Chí Minh.<br>
        Chi nhánh: 151A Lý Thường Kiệt, Phường 6, Tân Bình, TP.Hồ Chí Minh<br>
        Phone: +84 (0)56 373 1506<br>
        Email: <a href="#">0650070039@sv.hcmunre.edu.com</a><br>
        Follow on: <a href="">Facebook</a>, <a href="">Google+</a>
        </address>
      </div>
               
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
