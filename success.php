
<?php
include  "inc/header.php";
// include  "inc/slider.php";
?>
<?php
// if(!isset($_GET['orderid']) && $_GET['orderid']=='order'){
//     $customer_id=Session::get('customer_id');
//     $insertOrder = $ct->insertOrder($customer_id);
//     $delCart = $ct->del_all_data_cart();
//     header('location:success.php');				

// }
// if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
// 	$quantity= $_POST['quantity'];
// 	$AddtoCart =$ct->add_to_cart($quantity,$id);
// }
?>
<style>

.success_note{
    text-align: center;
    font-size: large;
    padding: 5px;
}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
            <center><h2>Success Order</h2></center>
            <?php
            $customer_id=Session::get('customer_id');
            $get_amount = $ct->getAmountPrice($customer_id);
            if($get_amount){
                $amount = 0;
                while($result=$get_amount->fetch_assoc()){
                    $price=$result['price'];
                    $amount += $price;
                }
            }
            ?>
            <p class="success_note">Total price you have bought from my website:<?php
            $vat= $amount*0.1;
            $total=$vat+$amount;
            echo $total.' VND';
            ?>  </p>
            <p class="success_note"><a  href="orderdetails.php">Order details</a></p>
 		</div>
 	</div>
</div>
 </form>	
<?php
include  "inc/footer.php";
?>