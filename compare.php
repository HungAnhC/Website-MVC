<?php
include  "inc/header.php";
// include  "inc/slider.php";

?>
<?php
if(isset($_GET['proid'])){
    $customer_id=Session::get('customer_id');
    $proid=$_GET['proid'];
	$delcompare= $product->delete_compare($proid,$customer_id);
}

// $update_quantity_cart = ""; // Khởi tạo biến
// $subtotal = 0; // Khởi tạo biến subtotal
// if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['submit'])){
// 	$quantity= $_POST['quantity'];
// 	$cartId= $_POST['cartId'];
// 	$update_quantity_cart =$ct->update_quantity_cart($quantity,$cartId);
// 	if($quantity==0){
// 		$delcart=$ct->delete_cart($cartId);
// 	}


// }
?>
<?php
// if(isset($_GET['id'])){
//     $idValue = $_GET['id'];
//     header("location: your_new_page.php?id=$idValue");
//     exit();
// }

?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare product</h2>
					<!-- <?php
					if($update_quantity_cart){
						echo $update_quantity_cart;
					}
					
					?> -->

						<table class="tblone">
							<tr>
								<th width="10%">ID Compare</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>


							</tr>
							<?php
                            
                            $customer_id=Session::get('customer_id');
                            						
							$get_compare = $product->get_compare($customer_id);
							if($get_compare){	
                                $i=0;
								while($result = $get_compare->fetch_assoc()){
                                    $i++;
							?>
							<tr>
                                <td><?php echo $i; ?></td>
								
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image']; ?>" alt=""/></td>
								<td><?php echo $result['price']; ?></td>
								<td>
									<a  href="details.php?proid=<?php echo $result['productId']; ?>">View</a>||
									<a  href="?proid=<?php echo $result['productId']; ?>">Remove</a>

								</td>
							</tr>
							<?php

							}
							}
							
							?>
							
					   </table>
					  

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>

					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
include  "inc/footer.php";
?>
