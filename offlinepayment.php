
<?php
include  "inc/header.php";
// include  "inc/slider.php";
?>
<?php
if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
    $customer_id = Session::get('customer_id');
    $insertOrder = $ct->insertOrder($customer_id);
    $delCart = $ct->del_all_data_cart();
    header('location:success.php');				

}
// if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
// 	$quantity= $_POST['quantity'];
// 	$AddtoCart =$ct->add_to_cart($quantity,$id);
// }
?>
<style>
.box_left{
    width: 50%;
    float: left;
    border: 1px solid #666;
    padding: 10px;
}
.box_right{
    width: 45%;
    float: right;
    border: 1px solid #666;
    padding: 10px;

}
.submit_order{
    border-radius: 5%;
    padding: 15px 60px;
    background: red;
    color: white;
    font-size: x-large;
    cursor:pointer;

}
</style>
<form action="" method="POST">
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="heading">
    		<h3>Offline payment</h3>
    		</div>
    		<div class="clear"></div>
            <div class="box_left">
            <div class="cartpage">
			    	<!-- <h2>Your Cart</h2> -->
					<!-- <?php
					if($update_quantity_cart){
						echo $update_quantity_cart;
					}
					
					?> -->

						<table class="tblone">
							<tr>
								<th width="5%">ID</th>
								<th width="15%">Product Name</th>								
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								
							</tr>
							<?php
							$subtotal = 0;
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){	
								$qty=0;	
                                $i=0;						
								while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
							?>
							<tr>
                                <td><?php echo $i; ?></td>							
								<td><?php echo $result['productName'] ?></td>								
								<td><?php echo $result['price'].' '.'VND'; ?></td>
								
                                <td><?php echo $result['quantity']; ?></td>							
								</td>
								<td><?php
								$total = $result['quantity'] * $result['price'];
								echo $total.' '.'VND';
								?></td>
								
							</tr>
							<?php
								$subtotal += $total;
								$qty=$qty + $result['quantity'];
							}
							}
							
							?>
							
					   </table>
					   <?php
								$check_cart=$ct->check_cart();
								if($check_cart){


								?>
					   <table style =" width='100%';text-align: left; ">
						<tr>
							<th>Sub total: </th>
							<th><?php 
							
							echo $subtotal .' '.'VND';
							Session::set('sum',$subtotal);
							Session::set('qty',$qty);

							 ?></th>

						</tr>						
						<tr>
							<th>VAT: </th>
							<th>10% (<?php echo $subtotal*0.1.' '.'VND';?>)</th>

						</tr>
						<tr>
							<th>Grand Total: </th>
							<th><?php $vat = $subtotal*0.1 + $subtotal;
									echo $vat.' '.'VND';
							?></th>

						</tr>


					   </table>
					   <?php
					   }else{
						echo "Your cart is empty! Please shopping now";
					   }
					   ?>
					</div>
            </div>
            <div class="box_right">
            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $cs->show_customers($id);
                if($get_customers){
                    while($result = $get_customers->fetch_assoc()){


                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?php echo $result['name']; ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td>:</td>
                    <td><?php echo $result['city']; ?></td>

                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $result['phone']; ?></td>

                </tr>
                <tr>
                    <td>Country</td>
                    <td>:</td>
                    <td><?php echo $result['country']; ?></td>

                </tr>
                <tr>
                    <td>Zipcode</td>
                    <td>:</td>
                    <td><?php echo $result['zipcode']; ?></td>

                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $result['email']; ?></td>

                </tr>
                <tr>
                    <td>Address</td>
                    <td>:</td>
                    <td><?php echo $result['address']; ?></td>

                </tr>
                <tr>

                    <td colspan="3"><a href = "editprofile.php">Update Profile</a></td>

                </tr>

                <?php
                                    }
                                }
                ?>
            </table>
            </div>

    	
 		</div>
 	</div>
    <center> <a href="?orderid=order" class ="submit_order">Order now</a> </center><br>
</div>
 </form>	
<?php
include  "inc/footer.php";
?>