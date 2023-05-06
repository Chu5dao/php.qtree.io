    <?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $cs = new Customer();

    if (!isset($_GET['customerid']) && $_GET['customerid'] == NULL){
        echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $id = $_GET['customerid'];
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thông tin khách hàng đặt đơn</h2>
               <div class="block copyblock">

                <?php
                    $show_customer = $cs->show_customer($id);
                    if($show_customer){
                        while ($result = $show_customer->fetch_assoc()){
                ?>
                 <form acction="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Tên: </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['name'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Địa chỉ: </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['dia_chi'] ?>" class="medium" />
                            </td>
                        </tr>
                        
                        <tr>
                            <td>Phone: </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['phone'] ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>E-mail: </td>
                            <td>
                                <input type="text" readonly="readonly" value="<?php echo $result['email'] ?>" class="medium" />
                            </td>
                        </tr>

                    </table>
                    </form>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>