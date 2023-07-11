<?php 
	include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
?>
<style>
	.mainBgImg{
		background-color: #F4F4F4;
		text-align: center;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		-ms-background-size: cover;
	}
	.mainBgImg > .img{
		font-size: 13em;
		font-weight: bold;
		color: #FBAB45;
		line-height: 1;
		margin: 0 0 48px 0;
		padding: 120px 0 0 0;
	}
	.mainBgImg h3{
		color: #FBAB45;
	}
	.mainBgImg h2{
		font-size: 1em;
		color: #FBAB45;
		text-transform: capitalize;
		margin: 0 0 48px 0;
	}
	.faico {
		padding: 0 0 120px 0;
	}
	.more_w3ls {
    margin:3em 0 5em;
}
	.more_w3ls a{
		padding: 8px 70px;
		background:#FBAB45;
		text-decoration: none;
		color: #fff;
		font-size: 1em;
		text-transform: uppercase;
		transition:.5s ease-in;
		-webkit-transition:.5s ease-in;
		-moz-transition:.5s ease-in;
		-o-transition:.5s ease-in;
		-ms-transition:.5s ease-in;
	}
	.more_w3ls a:hover{
		background:#fff;
		color:#FBAB45;
	}
</style>
</div>
<div class="main" style="backgroud-image:">
	 	
		
		 <!-- //// -->
		 <div class="mainBgImg" >
			 <div class="img"><i class="fas fa-check-circle"></i></div>
 
			 <h3>Logged in successfully</h3>
			 <h2></h2>
			 
			 <div class="more_w3ls">
				 <a href="cart.php">Visit your shopping cart</a>
			 </div>
			 
			 <ul class="faico clear">
				 <li><a class="faicon-dribble" href="#"><i class="fab fa-dribbble"></i></a></li>
				 <li><a class="faicon-facebook" href="#"><i class="fab fa-facebook"></i></a></li>
				 <li><a class="faicon-google-plus" href="#"><i class="fab fa-google-plus-g"></i></a></li>
				 <li><a class="faicon-linkedin" href="#"><i class="fab fa-linkedin"></i></a></li>
				 <!-- <li><a class="faicon-twitter" href="#"><i class="fab fa-twitter"></i></a></li> -->
				 <!-- <li><a class="faicon-vk" href="#"><i class="fab fa-vk"></i></a></li> -->
			   </ul>
			 
		 </div>
		 <!-- ////// -->
	 </div>
	<div class="clear"></div>
 <?php 
	include 'inc/footer.php';
 ?>
