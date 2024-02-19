<?php
include  "inc/header.php";
// include  "inc/slider.php";

?>
<?php
if(isset($_GET['cartid'])){
    $cartid=$_GET['cartid'];
	$delcart= $ct->delete_cart($cartid);
}

$update_quantity_cart = ""; // Khởi tạo biến
$subtotal = 0; // Khởi tạo biến subtotal
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
	$quantity= $_POST['quantity'];
	$cartId= $_POST['cartId'];
	$update_quantity_cart =$ct->update_quantity_cart($quantity,$cartId);
	if($quantity==0){
		$delcart=$ct->delete_cart($cartId);
	}


}
?>
<?php
if(isset($_GET['id'])){
    $idValue = $_GET['id'];
    header("location: your_new_page.php?id=$idValue");
    exit();
}

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
					if($update_quantity_cart){
						echo $update_quantity_cart;
					}
					
					?>

						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){	
								$qty=0;							
								while($result = $get_product_cart->fetch_assoc()){
							?>
							<tr>
								
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<form action="cart.php" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php
								$total = $result['quantity'] * $result['price'];
								echo $total;
								?></td>
								<td><a onclick="return confirm('Are you want to delete?');" href="?cartid=<?php echo $result['cartId']; ?>">Xóa</a></td>
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
					   <table style ="float:right;text-align:left;" width="40%">
						<tr>
							<th>Sub total: </th>
							<th><?php 
							
							echo $subtotal;
							Session::set('sum',$subtotal);
							Session::set('qty',$qty);

							 ?></th>

						</tr>						
						<tr>
							<th>VAT: </th>
							<th>10% </th>

						</tr>
						<tr>
							<th>Grand Total: </th>
							<th><?php $vat = $subtotal*0.1 + $subtotal;
									echo $vat;
							?></th>

						</tr>

					   </table>
					   <?php
					   }else{
						echo "Your cart is empty! Please shopping now";
					   }
					   ?>
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
include  "inc/footer.php";
?>
